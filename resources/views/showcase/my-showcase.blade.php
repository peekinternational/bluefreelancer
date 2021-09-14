@extends('layouts.app')
@section('content')
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/pages/showcase/banner-1.jpeg') }});">
        <div class="py-5 my-4">
            <div class="container">
                <h1 class="h2 font-weight-bold">Bluefreelancer <span class="text-white">Showcase</span></h1>
                <p class="h6 font-weight-normal text-white mb-4">Completion of business · Creative design · Your own ideas
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
                            <button class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-right py-5">
        <a href="/showcases" class="btn btn-secondary mr-1">Showcase Home</a>
        <a href="{{ route('showcase.create') }}" class="btn btn-secondary">Showcase Registration</a>
    </div>

    <section class="container pb-5">
        <div class="col-md-12 mx-auto">
            <h2 class="h4 font-weight-bold mb-3">My Showcase</h2>
            <div class="card rounded-xl mb-4 p-3">

                <ul class="nav nav-fill nav-pills font-weight-bold mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-registered-tab" data-toggle="pill" href="#pills-registered"
                            role="tab" aria-controls="pills-registered" aria-selected="true">Registered</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-approved-tab" data-toggle="pill" href="#pills-approved"
                            role="tab" aria-controls="pills-approved" aria-selected="false">Approving</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-rejected-tab" data-toggle="pill" href="#pills-rejected"
                            role="tab" aria-controls="pills-rejected" aria-selected="false">Rejected</a>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade py-5 show active" id="pills-registered" role="tabpanel"
                        aria-labelledby="pills-registered-tab">
                        <div class="text-center">
                            <div class="row">
                                @if ($regShowcases->count())
                                    @foreach ($regShowcases as $item)
                                        <div class="col-md-3">
                                            <div class="card card-overlay shadow rounded-xl mb-4">
                                                <div class="card-img-top position-relative overflow-hidden">
                                                    <img style="width: 100%;height: 15rem;"
                                                        src="{{ url('uploads/showcases/' . $item->img) }}"
                                                        alt="Showcase thumbnail">
                                                    <a class="overlay-hidden d-flex justify-content-center align-items-center"
                                                        href="#quikViewModal" data-toggle="modal">
                                                        <span href="#" class="btn btn-sm btn-primary">View
                                                            Details</span>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title mb-0">{{ $item->title }}</h5>
                                                    <p class="card-text">Freelancer</p>
                                                    <hr>
                                                    <div class="d-flex justify-content-between font-size-sm">
                                                        <span>{{ $item->currency == 'USD' ? '$' : '₩' }}
                                                            {{ $item->amt }}</span>
                                                        <span>
                                                            <i class="fa fa-heart mr-1"></i>
                                                            {{ $item->showcaseLikes->count() }}
                                                        </span>
                                                    </div>
                                                    <ul class="list-inline float-left m-0">
                                                        <li class="list-inline-item text-white">
                                                            <a href="showcase/edit/{{ $item->id }}"><i
                                                                    class="fa fa-pencil"></i></a>
                                                        </li>
                                                        <li class="list-inline-item">
                                                            <a href="/showcase/delete/{{ $item->id }}"
                                                                onclick="return confirm('are you sure?')"><i
                                                                    class="fa fa-trash text-danger"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <h4 class="font-weight-bold mb-3" style="width:100%">There is no registered showcase.</h4>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade py-5" id="pills-approved" role="tabpanel"
                        aria-labelledby="pills-approved-tab">
                        <div class="row">
                            @if ($approveShowcases->count())
                                @foreach ($approveShowcases as $item)
                                    <div class="col-md-3">
                                        <div class="card card-overlay shadow rounded-xl mb-4">
                                            <div class="card-img-top position-relative overflow-hidden">
                                                <img style="width: 100%;height: 15rem;"
                                                    src="{{ url('uploads/showcases/' . $item->img) }}"
                                                    alt="Showcase thumbnail">
                                                <a class="overlay-hidden d-flex justify-content-center align-items-center"
                                                    href="#quikViewModal" data-toggle="modal">
                                                    <span href="#" class="btn btn-sm btn-primary">View
                                                        Details</span>

                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title mb-0">{{ $item->title }}</h5>
                                                <p class="card-text">Freelancer</p>
                                                <hr>
                                                <div class="d-flex justify-content-between font-size-sm">
                                                    <span>{{ $item->currency == 'USD' ? '$' : '₩' }}
                                                        {{ $item->amt }}</span>
                                                    {{-- <span>
                                                        <i class="fa fa-heart mr-1"></i>
                                                        {{ $item->showcaseLikes->count() }}
                                                    </span> --}}
                                                </div>
                                                <ul class="list-inline float-left m-0">
                                                    <li class="list-inline-item text-white">
                                                        <a href="showcase/edit/{{ $item->id }}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="/showcase/delete/{{ $item->id }}"
                                                            onclick="return confirm('are you sure?')"><i
                                                                class="fa fa-trash text-danger"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5 my-5" style="width:100%">
                                    <i class="fa fa-smile-o h2 mb-3"></i>
                                    <h4 class="font-weight-bold">There are currently no approved products in the showcase.
                                    </h4>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade py-5" id="pills-rejected" role="tabpanel"
                        aria-labelledby="pills-rejected-tab">
                        <div class="row">
                            @if ($rejectedShowcases->count())
                                @foreach ($rejectedShowcases as $item)
                                    <div class="col-md-3">
                                        <div class="card card-overlay shadow rounded-xl mb-4">
                                            <div class="card-img-top position-relative overflow-hidden">
                                                <img style="width: 100%;height: 15rem;"
                                                    src="{{ url('uploads/showcases/' . $item->img) }}"
                                                    alt="Showcase thumbnail">
                                                <a class="overlay-hidden d-flex justify-content-center align-items-center"
                                                    href="#quikViewModal" data-toggle="modal">
                                                    <span href="#" class="btn btn-sm btn-primary">View
                                                        Details</span>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title mb-0">{{ $item->title }}</h5>
                                                <p class="card-text">Freelancer</p>
                                                <hr>
                                                <div class="d-flex justify-content-between font-size-sm">
                                                    <span>{{ $item->currency == 'USD' ? '$' : '₩' }}
                                                        {{ $item->amt }}</span>
                                                    {{-- <span>
                                                        <i class="fa fa-heart mr-1"></i>
                                                        {{ $item->showcaseLikes->count() }}
                                                    </span> --}}
                                                </div>
                                                <ul class="list-inline float-left m-0">
                                                    <li class="list-inline-item text-white">
                                                        <a href="showcase/edit/{{ $item->id }}"><i
                                                                class="fa fa-pencil"></i></a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="/showcase/delete/{{ $item->id }}"
                                                            onclick="return confirm('are you sure?')"><i
                                                                class="fa fa-trash text-danger"></i></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-5 my-5" style="width:100%">
                                    <i class="fa fa-hand-spock-o h2 mb-3"></i>
                                    <h4 class="font-weight-bold">There are currently no rejected showcase items.</h4>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
