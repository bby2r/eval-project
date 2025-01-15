@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-4">{{ $post->title }}</h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Posted by: {{ $post->user->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $post->created_at->format('F j, Y, g:i a') }}</h6>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $post->message }}</p>
        </div>
    </div>

    <div class="my-5">
        <h3>Comments</h3>
        <div class="mt-4">
            @if($post->comments->isEmpty())
                <p>No comments yet.</p>
            @else
                <ul class="list-group">
                    @foreach($post->comments as $comment)
                        <li class="list-group-item">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                            <span class="text-muted float-right">{{ $comment->created_at->format('F j, Y, g:i a') }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <h4>About the author</h4>
    <x-user-component :user="$post->user"></x-user-component>

    <div class="my-4 px-5">
        <h3>Leave a Comment</h3>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="body">Comment</label>
                <textarea class="form-control" id="body" name="body" rows="3" required></textarea>
                <input type="hidden" name='post_id' value="{{$post->id}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit Comment</button>
        </form>
    </div>
    <div class="my-4">
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
    </div>
@endsection
