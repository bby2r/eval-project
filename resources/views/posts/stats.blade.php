@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Post Views Statistics</h1>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Views</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Posts Views</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">User Views</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="card-title">Views</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">User Name</th>
                                <th scope="col">Post Title</th>
                                <th scope="col">When</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stats as $entry)
                                <tr>
                                    <td>{{ $entry->user->name }}</td>
                                    <td>
                                        <a href="{{route('posts.show', ['post' => $entry->post])}}">
                                            {{ $entry->post->title }}
                                        </a>
                                    </td>
                                    <td>{{ $entry->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $stats->links() }}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="card-title">Post Views Statistics</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Post Title</th>
                                <th scope="col">Users Viewed</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts_viewed as $view)
                                <tr>
                                    <td>{{ $view->date }}</td>
                                    <td>
                                        <a href="{{route('posts.show', ['post' => $view->post])}}">
                                            {{ $view->post->title }}
                                        </a>
                                    </td>
                                    <td>{{ $view->views }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="card-title">User Views Statistics</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Posts Viewed</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users_viewed as $view)
                                <tr>
                                    <td>{{ $view->date }}</td>
                                    <th scope="row">{{ $view->user->name }}</th>
                                    <td>{{ $view->views }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection