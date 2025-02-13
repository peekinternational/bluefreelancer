@extends('layouts.app')
@section('content')
    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/pages/showcase/banner-1.jpeg') }});">
        <div class="py-5 my-4">
            <div class="container">
                <h1 class="h2 font-weight-bold">{{ __('OutsourcingOk') }} <span
                        class="text-white">{{ __('Showcase') }}</span></h1>
                <p class="h6 font-weight-normal text-white mb-0">{{ __('CompletionCreativeOwnIdeas') }}
                </p>
            </div>
        </div>
    </div>

    <div class="container text-right py-5">
        <a href="/showcases" class="btn btn-secondary mr-1">{{ __('ShowcaseHome') }}</a>
        <a href="{{ route('showcase.create') }}" class="btn btn-secondary">{{ __('ShowcaseReg') }}</a>
    </div>

    <section class="container pb-5">
        <div class="d-flex justify-content-between border-bottom pb-2 mb-4">
            <h4 class="font-weight-bold text-warning-alt2 d-lg-none">{{ __('RegisterShowcase') }}</h4>
            <h4 class="font-weight-bold text-warning-alt2 d-none d-lg-block">{{ __('Step1File') }}</h4>
            <h4 class="font-weight-bold text-warning-alt2 d-none d-lg-block">{{ __('Step2File') }}</h4>
        </div>

        <form action="{{ route('showcase.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group image-uploader-wrap mb-4">
                        <div class="font-size-sm font-weight-bold mb-2">{{ __('Step1ofFile') }}</div>
                        <input type="file" name="image" id="imageUploader">
                        <label class="image-uploader" for="imageUploader">
                            <div class="image-uploader-overlay" id="imageOverlay">
                                <img src="#" alt="Img" id="imgOutput">
                            </div>
                            <div class="image-uploader-content text-center">
                                <i class="fa fa-upload text-warning-alt mb-4"></i>
                                <p class="font-size-ms font-weight-bold text-warning-alt mb-2">
                                    {{ __('UploadAttachments') }}</p>
                                <p class="font-size-ms font-weight-bold text-dark">{{ __('ClickHereTouploadImage') }}</p>
                            </div>
                        </label>
                    </div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="d-lg-flex justify-content-between d-none">
                        <div class="w-50 pr-lg-4">
                            <h6 class="font-size-sm font-weight-bold">{{ __('UploadFileFormates') }}</h6>
                            <p class="font-size-xs">
                                {{ __('PGFMinimumImagesize') }}
                            </p>
                        </div>

                        <div class="w-50 pl-lg-4">
                            <h6 class="font-size-sm font-weight-bold">{{ __('UploadFileFormates') }}</h6>
                            <p class="font-size-xs">
                                {{ __('PGFMinimumImagesize') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="selectShowcase"
                            class="font-size-sm font-weight-bold">{{ __('Step1of2File') }}</label>
                        <select id="selectShowcase" name="cate" class="custom-select">
                            <option value="" selected>Select Showcase Category | 쇼케이스 카테고리 선택</option>
                            <option value="Logo">Logo</option>
                            <option value="Websites">Websites</option>
                            <option value="Mobile App">Mobile App</option>
                            <option value="Graphic Design">Graphic Design</option>
                            <option value="Illustration">Illustration</option>
                            <option value="3D Model">3D Model</option>
                        </select>
                        @error('cate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="titleShowcase" class="font-size-sm font-weight-bold">{{ __('ProductTitle') }}</label>
                        <input type="text" class="form-control" name="title" id="titleShowcase">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="detailsShowcase"
                            class="font-size-sm font-weight-bold">{{ __('ProductDetails') }}</label>
                        <textarea class="form-control" name="description" id="detailsShowcase" cols="30"
                            rows="9"></textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="currencyShowcase"
                                    class="font-size-sm font-weight-bold">{{ __('ShowcaseItemsAmount') }}</label>
                                <select id="currencyShowcase" name="currency" class="custom-select">
                                    <option value="USD" selected>USD</option>
                                    <option value="KRW">KRW</option>
                                </select>
                                @error('currency')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="amountShowcase"
                                    class="font-size-sm font-weight-bold d-none d-lg-block">&nbsp;</label>
                                <input type="text" class="form-control" name="amt" id="amountShowcase">
                                @error('amt')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-8">
                    <p class="font-size-xs">
                        {{ __('CopyRightIntellectualPropertyRights') }}
                    </p>
                </div>
                <div class="col-md-4 text-right">
                    <input type="submit" class="btn btn-secondary font-size-sm" value="{{ __('RegisterShowcase') }}">
                </div>
            </div>
        </form>
    </section>
@endsection
