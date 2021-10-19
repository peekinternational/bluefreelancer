@extends('layouts.app')
@section('content')
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/pages/showcase/banner-1.jpeg') }});">
        <div class="py-5 my-4">
            <div class="container">
                <h1 class="h2 font-weight-bold">{{ __('OutsourcingOk') }} <span
                        class="text-white">{{ __('Showcase') }}</span></h1>
                <p class="h6 font-weight-normal text-white mb-0">{{ __('CompletionCreativeOwnIdeas') }}
                </p>

                <div class="col-md-8 mx-auto">
                    <div class="bg-white border rounded-lg shadow p-2">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text border-0 bg-transparent">
                                    <i class="fa fa-search font-size-lg"></i>
                                </div>
                            </div>
                            <input class="form-control border-0" type="text">
                            <button class="btn btn-primary">{{ __('Search') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-right py-5">
        <a href="{{ route('showcase.my-showcase') }}" class="btn btn-secondary mr-1">{{ __('MyShowcase') }}</a>
        <a href="{{ route('showcase.create') }}" class="btn btn-secondary">{{ __('ShowcaseReg') }}</a>
    </div>

    <section class="container pb-5">
        <div class="card card-body rounded-xl mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ !request()->category ? 'active' : '' }}" href="/showcases">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->category == 'Logo' ? 'active' : '' }}"
                        href="/showcases?category=Logo">Logo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->category == 'Website' ? 'active' : '' }}"
                        href="/showcases?category=Website">Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->category == 'Mobile Apps' ? 'active' : '' }}"
                        href="/showcases?category=Mobile Apps">Mobile Apps</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->category == 'Graphic Design' ? 'active' : '' }}"
                        href="/showcases?category=Graphic Design">Graphic Design</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->category == 'Illustration' ? 'active' : '' }}"
                        href="/showcases?category=Illustration">Illustration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->category == '3D Model' ? 'active' : '' }}"
                        href="/showcases?category=3D Model">3D Model</a>
                </li>
            </ul>
        </div>

        <div class="row">
            @if ($showcases->count())
                @foreach ($showcases as $item)
                    <div class="col-md-3">
                        <div class="card card-overlay shadow rounded-xl mb-4">
                            <div class="card-img-top position-relative overflow-hidden">
                                <img style="width: 100%;height: 15rem;"
                                    src="{{ url('uploads/showcases/' . $item->img) }}" alt="Showcase thumbnail">
                                <a class="overlay-hidden d-flex justify-content-center align-items-center"
                                    data-id="{{ $item->id }}" data-user="{{ auth()->id() }}"
                                    id="showcase_detail_btn">
                                    <span href="#" class="btn btn-sm btn-primary">{{ __('ViewDetails') }}</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title mb-0">{{ $item->title }}</h5>
                                <p class="card-text">{{ __('freelancer') }}</p>
                                <hr>
                                <div class="d-flex justify-content-between font-size-sm">
                                    <span>{{ $item->currency == 'USD' ? '$' : '₩' }} {{ $item->amt }}</span>
                                    <span>
                                        <i class="fa fa-heart mr-1"></i>
                                        {{ $item->showcaseLikes->count() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{ $showcases->links('vendor.pagination.custom') }}
        </div>
    </section>

    {{-- Showcase Details Modal --}}
    <div class="modal fade" id="quikViewModal" tabindex="-1" aria-labelledby="quikViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body rounded-left overflow-hidden p-0">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="overflow-auto" style="height: 359px;">
                                <img class="img-fluid" id="showcase_image_detail" src="#" alt="Showcase thumbnail">
                            </div>
                        </div>

                        <div class="col-md-5 overflow-hidden">
                            <div class="modal-header border-0 mb-3">
                                <h5 class="modal-title ml-n4">
                                    <img src="{{ url('assets/img/logo/logo.png') }}" width="225" alt="Logo">
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="overflow-auto pr-3" style="height: 280px;">
                                <h5 class="modal-title font-weight-bold" id="showcase_title_detail"></h5>
                                <span id="showcase_category_detail"></span>
                                <p class="font-size-sm" id="showcase_user_detail"></p>

                                <a href="#" class="btn btn-sm btn-block btn-primary mb-3">Go Somewhere</a>

                                <div class="d-flex align-items-center font-size-sm mb-3">
                                    <a herf="#" class="btn border mr-3" id="showcase_liked_btn" data-id=""
                                        style="display: none;">
                                        <i class="fa fa-heart text-danger"></i>
                                    </a>
                                    <a herf="#" class="btn border mr-3" id="showcase_unliked_btn" data-id=""
                                        style="display: none;" style="display: none;">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <span id="showcase_likes_count"></span>&nbsp;{{ __('Likes') }}
                                </div>

                                <p class="font-size-sm" id="showcase_description_detail"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
