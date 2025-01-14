@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Posts</h1>
        <a class="btn btn-primary my-3" href="{{route('posts.create')}}">Create a post</a>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-3">
                    <div class="card mb-4 card-gap">
                        <div class="card-header">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Posted by: {{ $post->user->name }}</h6>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $post->message }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
