@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Post Views Statistics</h1>

        <form action="{{ route('posts.stats') }}" class="mb-4">
            <div class="row">
                <div class="form-group col-4">
                    <label for="posts-filter">Filter by Posts</label>
                    <select class="form-control" name="postFilters[]" id="posts-filter" multiple>
                        @foreach($post_titles as $post_title)
                            <option value="{{$post_title->id}}">{{$post_title->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label class="" for="users-filter">Filter by Users</label>
                    <select class="form-control" name="userFilters[]" id="users-filter" multiple>
                        @foreach($user_names as $user_name)
                            <option value="{{$user_name->id}}">{{$user_name->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-4">
                    <label class="" for="dates">Filter by Date</label>
                    <select class="form-control" name="dateFilters[]" id="dates" multiple>
                        @foreach($dates as $date)
                            <option value="{{$date->date}}">{{$date->date}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a class="btn btn-primary" href="{{ route('posts.stats') }}">Clear Filters</a>
        </form>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#post-views" role="tab" aria-controls="profile" aria-selected="true">Generals Stats</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">View Logs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Each Post Views</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Each User Views</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="post-views" role="tabpanel" aria-labelledby="post-views-tab">
                <div class="card my-3">
                    <div class="card-header">
                        <h5 class="card-title">Views</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Post Views</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($post_views as $view)
                                <tr>
                                    <td>{{ $view->date }}</td>
                                    <td>
                                        {{ $view->views }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
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
