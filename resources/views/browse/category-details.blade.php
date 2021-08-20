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

    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">Browse Category Details</h1>
    </div>

    <section class="container py-5">
        <div class="card card-bordered card-body rounded-xl py-5 mb-4">
            <h2 class="h5 font-weight-bold mb-4">Browse by Category Details</h2>

            <form action="/browse/category-details/{{ request()->route('id') }}" method="get">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="col-md-10 form-control" type="text" name="search_sub_category_by_title"
                        placeholder="Search Sub Category by Title or Name">
                    <input type="submit" value="Filter" class="ml-4 col-md-1 btn btn-info btn-sm">
                    <a href="/browse/category-details/{{ request()->route('id') }}" class="ml-4 col-md-1 btn btn-secondary btn-sm">Clear Filter</a>
                </div>
            </form>

            <hr class="mb-5">

            <ul class="list-unstyled">
                @if ($sub_categories->count())
                    @foreach ($sub_categories as $item)
                        <li>
                            <h5 class="font-size-lg font-weight-bold mb-4">
                                <a class="text-info" href="#">{{ $item->title }}</a>
                            </h5>
                            <div class="row mb-3">
                                <ul class="list-unstyled">
                                    @if (App\Models\SubCategory::getSkillsbySubcateInProj($item->id))
                                        @foreach (Illuminate\Support\Str::of(App\Models\SubCategory::getSkillsbySubcateInProj($item->id)->skills)->explode(',') as $skill)
                                            <li class="list-inline-item font-size-sm text-info mx-2">
                                                <a href="/project-listing?search_project_by_skills={{ $skill }}">
                                                    {{ App\Models\User::skillTitle($skill)->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="text-danger list-inline-item font-size-sm mx-2">Ops No Project Skills
                                            Found</li>
                                    @endif
                                    {{-- @foreach (App\Models\SubCategory::getSkillsbySubcateInProj($item->id) as $skills)
                                            @if ($skills)
                                                @foreach (Illuminate\Support\Str::of($skills)->explode(',') as $skill)
                                                    <li class="list-inline-item font-size-sm text-info mx-2">
                                                        {{ App\Models\User::skillTitle($skill) }}
                                                    </li>
                                                @endforeach
                                            @else
                                                sadas
                                                <li>Ops No Project Found with this Category Skills!</li>
                                            @endif
                                        @endforeach --}}
                                    {{-- @endif --}}
                                </ul>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </section>
@endsection
