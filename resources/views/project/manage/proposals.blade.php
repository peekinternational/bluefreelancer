@extends('layouts.app')
@section('content')
    <div class="bg-secondary py-4">
        <div class="container pt-2 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="./project-list.html" class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">Browse
                    Projects</a>
                <a href="./contest-list.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Contests</a>
                <a href="./browse-category.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                    Categories</a>
                <a href="./showcase.html" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Showcase</a>
                <a href="./contest-post.html" class="btn btn-block btn-primary w-md-auto ml-auto">Start a Contest</a>
            </div>
        </div>
    </div>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">My Project &amp; Contest</h1>
    </div>
    @if ($proposals->count())
        @foreach ($proposals as $item)
            <div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
                <div class="card-header">{{ $item->user->username }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->day }} Completed in days</h5>
                    <h5 class="card-title">{{ $item->budget }}</h5>
                    @if ($item->status == 1)
                        <form action="{{ route('my-project.send-request', request()->route('project_id')) }}"
                            method="post">
                            @csrf
                            <input type="submit" value="Send Request" class="btn btn-info btn-sm">
                            <input type="hidden" name="proposal_project_id" value="{{ request()->route('project_id') }}">
                            <input type="hidden" name="proposal_user_id" value="{{ $item->user->id }}">
                        </form>
                    @elseif($item->status == 2 || $item->status == 3)
                        <button class="disabled btn btn-success btn-sm">Approved</button>
                    @elseif($item->status == 0)
                        <button class="disabled btn btn-danger btn-sm">Rejected</button>
                    @endif

                </div>
            </div>
        @endforeach
    @endif



@endsection
