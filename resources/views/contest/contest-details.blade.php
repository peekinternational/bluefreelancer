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
        <h1 class="h5 font-weight-bold text-white">Contest Details · Open Forum · Applicant Status · Registration</h1>
    </div>

    <div class="bg-gray-500 pt-3">
        <div class="container">
            <div class="d-sm-flex justify-content-between align-items-center mb-3 mb-sm-2">
                <h4 class="font-weight-bold text-white mb-3 mb-sm-0">{{ $contest->title }}</h4>
                <span class="badge bg-warning-alt2 font-size-lg text-white p-2">Deadline Before
                    {{ $contest->created_at->addDays($contest->days)->format('M d, Y') }}
                </span>
            </div>
            <div class="d-sm-flex justify-content-between align-items-center">
                <div class="font-size-lg text-center font-weight-bold text-white order-sm-1 py-2">
                    PRIZE {{ $contest->currency == 'USD' ? '$' : '₩' }} {{ $contest->budget }}
                    <br>
                    @if ($contest->status == 1)
                        @if ($contest->user_id != auth()->id())
                            <a href="/contest/entry/{{ $contest->contest_id }}" class="btn btn-secondary">Participate in
                                Contest</a>
                        @endif
                    @elseif($contest->status == 2)
                        <span class="badge bg-info font-size-lg text-white p-2">Closed
                        </span>
                    @endif
                </div>
                <ul class="nav nav-pills nav-pills-bordered order-sm-0 mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description"
                            role="tab" aria-controls="pills-description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-entries-tab" data-toggle="pill" href="#pills-entries" role="tab"
                            aria-controls="pills-entries" aria-selected="false">Entries</a>
                    </li>
                    @if ($contest->user->id == auth()->id())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contest-edit', $contest->contest_id) }}">Edit
                                Contest</a>
                        </li>
                    @endif
                    @if ($contest->status == 2 && ($contest->user_id == auth()->id() || $contest_entry_winner->user_id == auth()->id()))
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('contest-handover', $contest->contest_id) }}">Handover</a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
    </div>

    <section class="container py-5">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-description" role="tabpanel"
                aria-labelledby="pills-description-tab">
                <div class="row">
                    <div class="col-lg-4 order-lg-1">
                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-header py-4">
                                <h2 class="h5 font-weight-bold mb-0">Client Information</h2>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <img class="avatar-bordered rounded-circle shadow-lg"
                                        src="{{ $contest->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $contest->user->id . '/images/' . $contest->user->img) }}"
                                        width="84" alt="User thumbnail">
                                    <div class="pl-3">
                                        <p class="card-text mb-2"><strong>{{ $contest->user->username }}</strong></p>
                                        <div class="font-size-sm mb-2"><strong>Member
                                                Since:</strong> {{ $contest->user->created_at->format('M d, Y') }}</div>
                                        <div class="font-size-sm mb-2"><strong>Location:</strong>
                                            {{ $contest->user->country }}</div>
                                        <div class="pt-1">
                                            <div class="icon text-info border-info mr-1">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <div class="icon mr-1">
                                                <i class="fa fa-asterisk"></i>
                                            </div>
                                            <div class="icon text-info border-info mr-1">
                                                <i class="fa fa-phone"></i>
                                            </div>
                                            @if ($contest->user->email_verified_at)
                                                <div class="icon text-info border-info mr-1">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            @else
                                                <div class="icon mr-1">
                                                    <i class="fa fa-envelope"></i>
                                                </div>
                                            @endif

                                            <div class="icon mr-1">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 order-lg-0">
                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-header py-4">
                                <h2 class="h5 font-weight-bold mb-0">Contents of Contest</h2>
                            </div>
                            <div class="card-body">
                                <p class="card-text">{!! $contest->description !!}</p>
                                <hr class="my-4">
                                <h5 class="font-weight-bold">File attached:</h5>
                                <div class="font-weight-bold font-size-sm pl-5"><i class="fa fa-file mr-2"></i>
                                    <a href="{{ url('uploads/contest/images/' . $contest->file) }}" download>
                                        {{ $contest->file }}
                                    </a>
                                </div>
                                <hr class="my-4">
                                <a href="{{ route('post-contest') }}" class="btn btn-secondary text-capitalize">Post
                                    contest like this</a>
                            </div>
                        </div>
                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-header py-4">
                                <h2 class="h5 font-weight-bold mb-0">Recommened Skills</h2>
                            </div>
                            <div class="card-body">
                                <div class="pt-1">
                                    <ul class="list-inline">
                                        @foreach (Illuminate\Support\Str::of($contest->skills)->explode(',') as $skill)
                                            <li
                                                class="list-inline-item badge font-size-ms font-weight-bold text-primary border shadow-sm py-2 px-3">
                                                {{ App\Models\User::skillTitle($skill)->title }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-entries" role="tabpanel" aria-labelledby="pills-entries-tab">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-header py-4">
                                <h2 class="h5 font-weight-bold mb-0">{{ $contest_entry->count() }} Total Entries</h2>
                            </div>
                            <div class="card-body">
                                <ul class="list-inline">
                                    @if ($contest_entry->count())
                                        @foreach ($contest_entry as $key => $item)
                                            <li class="list-inline-item">
                                                <div class="card card-overlay shadow"
                                                    style="width: 16rem;border-radius: 10px">
                                                    <div class="card-img-top position-relative overflow-hidden">
                                                        <img src="{{ url('uploads/contest/entry/' . $item->file) }}"
                                                            class="card-img-top" alt="..." height="160px">
                                                        <a class="overlay-hidden d-flex justify-content-center align-items-center"
                                                            href="#" data-id="{{ $item->id }}"
                                                            id="contest_entry_detail_btn">
                                                            <span class="btn btn-sm btn-primary">Viewer</span>
                                                        </a>
                                                        <span
                                                            class="badge badge-success font-size-sm py-2 d-block">{{ $contest->currency == 'USD' ? '$' : '₩' }}
                                                            {{ $item->amount }}
                                                            {{ $contest->currency == 'USD' ? 'USD' : 'KRW' }}</span>
                                                    </div>

                                                    <hr>
                                                    <div class="card-body">
                                                        <span>Applicant#{{ $key + 1 }}</span>
                                                        @if ($item->status == 1)
                                                            @if ($contest->user_id == auth()->id())
                                                                <div class="row">
                                                                    <form
                                                                        action="{{ route('contest-entry.accept', $item->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="submit" value="Accept"
                                                                            class="btn btn-primary btn-xs font-size-xs">
                                                                    </form>
                                                                    <input type="submit" value="Chatting"
                                                                        class="btn btn-info btn-xs font-size-xs">
                                                                </div>
                                                            @else
                                                                <span class="badge badge-danger">Waiting for
                                                                    Acceptance</span>
                                                            @endif
                                                        @elseif($item->status == 2)
                                                            <span class="badge badge-success">Winner</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-body">
                                <h2 class="h5 font-weight-bold text-warning-alt mb-4">Public Clarification Board</h2>
                                <p class="card-text">The contest public forum is a forum where you can exchange
                                    opinions
                                    with freelancers publicly for the exact concept of your clients.</p>
                                <p class="card-text">If the contest is canceled or the winner is not selected within
                                    14
                                    days, the winner of the first round will receive a 1 / n equal to the 50% bonus amount.
                                </p>
                                <p class="card-text">After consulting with freelancers in the forum, please make a
                                    decision
                                    to chat with the first passer. In addition, please refer to Article 12.12 and 27.6 of
                                    the Terms of Use.</p>
                                <hr class="my-4">
                                <div class="d-flex align-items-start">
                                    <img class="avatar-bordered rounded-circle shadow-lg"
                                        src="{{ auth()->user()->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . auth()->id() . '/images/' . auth()->user()->img) }}"
                                        width="84" alt="User thumbnail">
                                    <div class="pl-3">
                                        <form action="{{ route('contest_public_forum.store') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="contest_forum_contest_id"
                                                value="{{ request()->route('id') }}">
                                            <div class="form-group">
                                                <textarea name="contest_forum_message" id="" cols="30" rows="5"
                                                    class="form-control"></textarea>
                                            </div>
                                            <p class="card-text mb-2">
                                                <strong>
                                                    In addition to the winner, a second prize is required if the second and
                                                    third prize are presented.
                                                    <a href="#">Contact Us</a>
                                                </strong>
                                            </p>
                                            <input type="submit" class="btn btn-secondary" value="Send">
                                        </form>
                                    </div>
                                </div>

                                <ul class="list-unstyled mt-4">
                                    @if ($contest->ContestPublicForums->count())
                                        @foreach ($contest->ContestPublicForums as $item)
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img class="avatar-bordered rounded-circle shadow-lg"
                                                            src="{{ App\Models\User::find($item->user_id)->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $item->user_id . '/images/' . App\Models\User::find($item->user_id)->img) }}"
                                                            width="84" alt="User thumbnail">
                                                    </div>
                                                    <div class="col-md-10">
                                                        <div class="row px-3">
                                                            <h6 class="text-left" style="width:50%"><b
                                                                    class="text-primary">{{ App\Models\User::find($item->user_id)->username }}</b>
                                                            </h6>
                                                            <span class="text-right"
                                                                style="width:50%">{{ $item->created_at->format('M d, Y h:i A') }}</span>
                                                        </div>
                                                        <p class="bg-light px-4 py-2 my-2 rounded">
                                                            {{ $item->message }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <hr>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            {{-- <div class="card-footer justify-content-center">
                                <button class="btn btn-link text-warning-alt">Show more comments</button>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-header py-4">
                                <h2 class="h5 text-primary font-weight-bold mb-0">Similar Contests</h2>
                            </div>
                            <div class="card-body">
                                <div class="overflow-auto pr-3 mr-n2" style="height: 240px;">
                                    @if ($contest_similar->count())
                                        @foreach ($contest_similar as $item)
                                            <div class="d-flex justify-content-between pb-4 mb-4 border-bottom">
                                                <div class="pr-3">
                                                    <h6 class="text-primary">
                                                        <a href="{{ route('contest-details', $item->contest_id) }}">
                                                            <strong>
                                                                {{ $item->title }}
                                                            </strong>
                                                        </a>
                                                    </h6>
                                                    <p class="card-text">Client: <a href="#"
                                                            class="text-dark">{{ App\Models\User::find($item->user_id)->username }}</a>
                                                    </p>
                                                </div>
                                                <div class="align-self-end">
                                                    <p class="card-text mb-0">
                                                        <strong>{{ $item->currency == 'USD' ? '$' : '₩' }}
                                                            {{ $item->budget }}</strong>
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card card-bordered rounded-xl mb-4">
                            <div class="card-header py-4">
                                <h2 class="h5 text-success-alt font-weight-bold mb-0">Contest winners have been selected
                                </h2>
                            </div>
                            <div class="card-body pt-0">
                                <ul class="list-unstyled">
                                    @if ($contest_selected->count())
                                        @foreach ($contest_selected as $item)
                                            <li class="mt-4">
                                                <h6 class="text-primary">
                                                    <a class="text-success-alt"
                                                        href="{{ route('contest-details', $item->contest_id) }}"><strong>{{ $item->title }}</strong></a>
                                                </h6>
                                                <div class="d-flex align-items-center">
                                                    <p class="card-text flex-shrink-0 mb-0">Client: <a href="#"
                                                            class="text-dark">{{ $item->user->username }}</a></p>
                                                    <div class="border-top w-100 mx-2"></div>
                                                    <p class="card-text mb-0">
                                                        <strong>{{ $item->currency == 'USD' ? '$' : '₩' }}{{ $item->budget }}</strong>
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @else
                                        <li class="mt-4">
                                            <span class="text-danger">Ops! 404 not found</span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Contest Entry Details Modal --}}
            <div class="modal fade" id="contest_entry_detail_modal" tabindex="-1" aria-labelledby="quikViewModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body rounded-left overflow-hidden p-0">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="overflow-auto" style="height: auto;">
                                        <img class="img-fluid" id="contest_entry_image" src="#"
                                            alt="Contest entry thumbnail" width="100%">
                                    </div>
                                </div>

                                <div class="col-md-5 overflow-hidden">
                                    <div class="modal-header border-0 mb-3">
                                        <h5 class="modal-title ml-n4">
                                            <img src="{{ url('assets/img/logo/logo.png') }}" width="225" alt="Logo">
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <h5 class="font-weight-bold" id="contest_entry_userFullname"></h5>
                                    <span class="font-weight-bold" id="contest_entry_username"></span>
                                    <hr>
                                    <div class="overflow-auto pr-3" style="height: 280px;">
                                        <h6 class="modal-title font-weight-bold" id="contest_entry_title"></h6>

                                        {{-- <a href="#" class="btn btn-sm btn-block btn-primary mb-3">Go Somewhere</a> --}}

                                        <p class="font-size-sm" id="contest_entry_detail">

                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
