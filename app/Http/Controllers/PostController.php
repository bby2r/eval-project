<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Models\Post;
use App\Models\PostStat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function stats(Request $request) : View {
        $filters = [
            'users' => $request['userFilters'],
            'posts' => $request['postFilters'],
            'dates' => $request['dateFilters'],
        ];

        $stats = $this->applyFilters(PostStat::with('user', 'post'), $filters)
            ->orderBy('created_at', 'desc')
            ->paginate(20);


        return view('posts.stats', [
            'post_views' => $this->applyFilters(PostStat::postViews(), $filters)->get(),
            'stats' => $stats,
            'users_viewed' => $this->applyFilters(PostStat::groupPosts(), $filters)->get(),
            'posts_viewed' => $this->applyFilters(PostStat::groupUsers(), $filters)->get(),
            'post_titles' => Post::select(['id', 'title'])->get(),
            'user_names' => User::select(['id', 'name'])->get(),
            'dates' => PostStat::select(DB::raw('DATE(created_at) as date'))->distinct()->get(),
        ]);
    }
    public function applyFilters($query, $filters) {
        return $query
            ->filterUsers(array_key_exists('users', $filters) ? $filters['users'] : [])
            ->filterPosts(array_key_exists('posts', $filters) ? $filters['posts'] : [])
            ->filterDates(array_key_exists('dates', $filters) ? $filters['dates'] : []);
    }
}

