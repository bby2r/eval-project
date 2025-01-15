<?php

namespace App\Http\Controllers;

use App\Events\CommentCreated;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request['user_id'] = 31;
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'post_id' => 'required',
            'body' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with(['fail' => $validator->errors()->all()[0]]);
        }

        $comment = Comment::create($validator->validated());
        event(new CommentCreated($comment));
        return redirect()->back()->with('success', 'Comment added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
