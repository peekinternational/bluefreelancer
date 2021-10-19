@extends('layouts.app')
@section('content')
<div class="bg-secondary py-4">
    <div class="container pt-2 pb-3">
        <div class="d-flex flex-column flex-md-row align-items-center">
            <a href="/project-listing"
                class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">{{ __('browseProject') }}</a>
            <a href="/contest-listing"
                class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('browseContest') }}</a>
            <a href="/browse/category"
                class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('browseCategories') }}</a>
            <a href="/showcases"
                class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('showcase') }}</a>
            <a href="/post-contest" class="btn btn-block btn-primary w-md-auto ml-auto">{{ __('startContest') }}</a>
        </div>
    </div>
</div>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('browseCategories') }}</h1>
    </div>

    <section class="container py-5">
        <div class="card card-bordered card-body rounded-xl py-5 mb-4">
            <h2 class="h5 font-weight-bold mb-4">{{ __('BrowsebyCategory') }}</h2>
            <form action="/browse/category" method="get">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="col-md-10 form-control" type="text" name="search_category_by_title"
                        placeholder="{{ __('SearchCategoryByTitle') }}">
                    <input type="submit" value="{{ __('Filter') }}" class="ml-4 col-md-1 btn btn-info btn-sm">
                    <a href="/browse/category" class="ml-4 col-md-1 btn btn-secondary btn-sm">{{ __('ClearFilter') }}</a>
                </div>
            </form>
            <hr class="mb-5">

            <div class="col-md-10 mx-auto">
                <div class="row">
                    @if ($categories->count())
                        @foreach ($categories as $item)
                            <div class="col-md-4 mb-4">
                                <div class="card card-hover shadow text-center py-4 h-100 rounded-xl">
                                    <div class="card-body">
                                        <img class="mb-3"
                                            src="http://127.0.0.1:8080/uploads/category/images/{{ $item->img }}"
                                            width="124" alt="Category thumbnail">
                                        <h5 class="card-title font-size-sm mb-0">
                                            <a class="stretched-link"
                                                href="/browse/category-details/{{ Illuminate\Support\Facades\Crypt::encryptString($item->id) }}">{{ $item->title }}</a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection
