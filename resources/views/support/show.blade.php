@extends('layouts.app')
@section('content')
    <!-- Title -->
    <div class="bg-primary text-center py-5"
        style="background-image: url({{ url('assets/img/pages/support/card-bg.svg') }});">
        <div class="container py-4">
            <h1 class="h2 font-weight-bold text-white mb-4">How may we help you?</h1>

            <div class="col-md-8 mx-auto">
                <div class="bg-white border rounded-lg shadow p-2">
                    <form action="{{ route('support.show', request()->route('category')) }}" method="get">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text border-0 bg-transparent">
                                    <i class="fa fa-search font-size-lg"></i>
                                </div>
                            </div>
                            <input class="form-control border-0" name="filter" type="text"
                                placeholder="Please search your questions...">
                            <input type="submit" class="btn btn-primary" value="Search Help">
                            {{-- <button >Search Help</button> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-5 my-3 my-md-4">
        <div class="row flex-md-row-reverse">
            <div class="col-md-3 mb-4">
                <div class="card card-bordered card-body rounded-xl mb-4">
                    <h5 class="font-weight-bold">Support Topics</h5>
                    <hr>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="/support/show/General" class="nav-link">General</a>
                        </li>
                        <li class="nav-item">
                            <a href="/support/show/Project" class="nav-link">Project</a>
                        </li>
                        <li class="nav-item">
                            <a href="/support/show/Contest" class="nav-link">Contest</a>
                        </li>
                        <li class="nav-item">
                            <a href="/support/show/Payment" class="nav-link">Payment</a>
                        </li>
                        <li class="nav-item">
                            <a href="/support/show/Membership" class="nav-link">Membership</a>
                        </li>
                        <li class="nav-item">
                            <a href="/support/show/Profile" class="nav-link">Profile</a>
                        </li>
                    </ul>
                </div>

                {{-- <div class="card card-bordered card-body rounded-xl">
                    <h5 class="font-weight-bold">Related Articles</h5>
                    <hr>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum dolor sit amet consectetur.</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum dolor sit amet consectetur.</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum dolor sit amet consectetur.</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum dolor sit amet consectetur.</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Lorem ipsum dolor sit amet consectetur.</a>
                        </li>
                    </ul>
                </div> --}}
            </div>

            <div class="col-md-9 mb-4">
                @if ($faqs->count())
                    @foreach ($faqs as $item)
                        <div class="card card-bordered rounded-xl p-lg-3 mb-4">
                            <div class="card-body">
                                <div class="articles-inner thumbnail p-ml-lg m-ml-none m-mr-none">
                                    <span class="badge badge-ribbon"></span>
                                    <h4 class="h5 font-weight-bold mb-4">{{ $item->category }}</h4>
                                    <img src="{{ url('assets/img/logo/logo.png') }}" width="225" alt="Bluefreelancer">
                                    <hr>
                                    <h4 class="mb-3">{{ $item->title }}</h4>
                                    <p class="card-text">
                                        {!! $item->description !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <span class="text-danger">Not Found 404!</span>
                @endif
            </div>
        </div>
    </div>
@endsection
