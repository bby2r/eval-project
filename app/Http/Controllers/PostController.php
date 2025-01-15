<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use App\Models\PostStat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('posts.index', ['posts' => Post::with('user')->paginate(20)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $data = $request->validate([
            'title' => 'required',
            'message' => 'required',
        ]);
        $data['user_id'] = 31;
        $post = Post::create($data);
        event(new PostCreated($post));
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load('comments');
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function stats($filters) : View {
        $stats = PostStat::with('user', 'post')
            ->filterUsers($filters['users'])
            ->filterPosts($filters['posts'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('posts.stats', [
            'stats' => $stats,
            'users_viewed' => PostStat::groupPosts()
                ->filterUsers($filters['users'])
                ->filterPosts($filters['posts'])
                ->get(),
            'posts_viewed' => PostStat::groupUsers()
                ->filterUsers($filters['users'])
                ->filterPosts($filters['posts'])->get(),
            'post_titles' => Post::select(['id', 'title'])->get(),
            'user_names' => User::select(['id', 'name'])->get(),
        ]);
    }

    public function statsWithFilters(Request $request) : View {
//        dd($request->postFilters);
        $filters = [
            'posts' => [],
            'users' => []
        ];
        if($request->postFilters) {
            $filters['posts'] = $request->postFilters;
        }

        if($request->userFilters) {
            $filters['users'] = $request->userFilters;
        }

        return $this->stats($filters);
    }
}

