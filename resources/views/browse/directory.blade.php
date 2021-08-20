@extends('layouts.app')
@section('content')
    <!-- Page Content -->
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
        <h1 class="h5 font-weight-bold text-white">Global Freelancer List</h1>
    </div>

    <section class="container py-5">
        {{ $freelancers->links('vendor.pagination.custom') }}

        <div class="row">
            <div class="col-md-3">
                <div class="card card-bordered card-body rounded-xl mb-4">
                    <form action="/browse/directory" method="get" id="freelancerSearchForm">
                        <div class="input-group mb-3">
                            <input class="form-control" name="search_freelancer_by_name" type="text"
                                placeholder="Search By Username">
                            <div class="input-group-append">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <h2 class="h6 font-weight-bold pt-3 mb-3">My Skills</h2>

                        <div class="form-group mb-3">
                            <select class="custom-select" data-toggle="select" id="search_freelancer_skills" multiple>
                                {{-- Coming Option From Ajax.js (AJAX CALL) --}}
                            </select>
                            <input type="hidden" name="search_freelancer_skills" id="selected_search_freelancer_skills"
                                required>
                        </div>

                        <hr>

                        <h2 class="h6 font-weight-bold pt-3 mb-3">Country</h2>

                        <div class="form-group mb-3">
                            <input class="form-control" type="text" name="search_freelancer_by_country"
                                placeholder="Search by Country">
                        </div>
                        <input type="submit" value="Filter" class="btn mb-2 btn-info btn-sm">
                        <a href="/browse/directory" class="btn mb-2 btn-secondary btn-sm">Clear Filter</a>
                    </form>
                </div>
            </div>

            <div class="col-md-9">
                <ul class="list-unstyled">
                    @if ($freelancers->count())
                        @foreach ($freelancers as $item)
                            <li class="mb-4">
                                <div class="card card-bordered card-body rounded-xl mb-4">
                                    <div class="row">
                                        <div class="col-md-7 mb-4 mb-md-0">
                                            <div class="media">
                                                <img class="rounded-xl"
                                                    src="{{ $item->img ? url('uploads/users/' . $item->id . '/images/' . $item->img) : url('assets/img/pages/default.png') }}"
                                                    width="128" height="160" alt="User thumbnail">
                                                <div class="media-body ml-3">
                                                    <h5 class="card-title">
                                                        <a href="#">{{ $item->username }}</a>
                                                    </h5>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <span class="badge badge-warning mr-2">0.0</span>
                                                        <div class="ratings mr-3">
                                                            <i class="fa fa-star-o mr-1"></i>
                                                            <i class="fa fa-star-o mr-1"></i>
                                                            <i class="fa fa-star-o mr-1"></i>
                                                            <i class="fa fa-star-o mr-1"></i>
                                                            <i class="fa fa-star-o mr-1"></i>
                                                        </div>
                                                        <span class="font-size-sm">0 Reviews</span>
                                                    </div>
                                                    <p class="card-text">
                                                        {{ $item->prof_headline ? $item->prof_headline : 'No Professional Headline' }}
                                                    </p>
                                                    <p class="card-text">
                                                        {{ $item->description ? $item->description : 'No  Introduction/Description Found' }}
                                                    </p>
                                                    @if ($item->skills)
                                                        <ul class="list-inline">
                                                            @foreach (Illuminate\Support\Str::of($item->skills)->explode(',') as $skill)
                                                                <li
                                                                    class="badge badge-lg bg-success-alt text-white mr-1 mb-1 list-inline-item">
                                                                    {{ App\Models\User::skillTitle($skill)->title }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        No Skills Found
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="text-md-right">
                                                <div
                                                    class="d-flex justify-content-center justify-content-md-end font-size-sm text-info mb-3">
                                                    <i class="fa fa-play-circle mx-1"></i>
                                                    <i class="fa fa-commenting-o mx-1"></i>
                                                    <i class="fa fa-mobile-phone mx-1"></i>
                                                    <i class="fa fa-envelope-open-o mx-1"></i>
                                                    <i class="fa fa-desktop mx-1"></i>
                                                    <i class="fa fa-print mx-1"></i>
                                                </div>

                                                <a href="/profile?outsourcer={{ Illuminate\Support\Facades\Crypt::encryptString($item->id) }}"
                                                    class="btn btn-secondary w-100 w-md-auto">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        <span class="text-danger">Ops! 404, No Freelancer Found</span>
                    @endif
                </ul>


                {{ $freelancers->links('vendor.pagination.custom') }}
            </div>
        </div>
    </section>
@endsection
