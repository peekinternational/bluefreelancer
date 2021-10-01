@extends('layouts.app')
@section('content')
<div class="bg-secondary py-4">
    <div class="container pt-2 pb-3">
        <div class="d-flex flex-column flex-md-row align-items-center">
            <a href="/project-listing" class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">Browse
                Projects</a>
            <a href="/contest-listing" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                Contests</a>
            <a href="/browse/category" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Browse
                Categories</a>
            <a href="/showcases" class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">Showcase</a>
            <a href="/post-contest" class="btn btn-block btn-primary w-md-auto ml-auto">Start a Contest</a>
        </div>
    </div>
</div>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">Upload contest file source files</h1>
    </div>

    <div class="bg-gray-500 py-4 mb-3">
        <div class="container">
            <div class="d-sm-flex justify-content-between align-items-center mb-3 mb-sm-2">
                <h4 class="font-weight-bold text-white mb-3 mb-sm-0">{{ $contest->title }}</h4>
                <span class="badge bg-warning-alt2 font-size-lg text-white p-2">End of Contest
                </span>
            </div>
            <div class="font-size-lg text-right font-weight-bold text-white order-sm-1 py-2">
                {{ $contest->currency == 'USD' ? '$' : '₩' }}
                {{ $contest->contestEntryCompleted->amount }}
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="card card-bordered rounded-xl mb-4">
                    <div class="card-header py-4">
                        <h2 class="h5 font-weight-bold mb-0 text-center">
                            @if ($contest->user_id == auth()->id())
                                Download original documents and manuals
                            @else
                                Send original documents and documents (upload)
                            @endif
                        </h2>
                    </div>
                    <div class="card-body">
                        @if ($contest->user_id == auth()->id())
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>The right to an award is in accordance with the
                                agreement, and upon receipt of the original file from the winner in accordance with the
                                contract signed for the transfer of rights, the winner's right is automatically attributed
                                to the client.</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>The client must confirm the final receipt
                                within one week of the selection of the final winner. If the original copy of the winning
                                work has been delivered normally but no such action has been taken, the receipt will be
                                automatically acknowledged one week after the winner is selected.</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>All designs and ideas that are not selected by
                                clients other than winners are copyrighted by the freelancer who supports them.</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>Clients are not allowed to use freelance
                                designs and ideas that have not been selected by the client.</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>Winners who do not have the right to transfer
                                in the contract are entitled to the award and the client must use the winner's permission.
                            </p>
                            <h6 class="font-weight-bold">Download the files:</h6>
                            @php
                                $handoverFiles = App\Models\ContestHandover::where('contest_id', $contest->contest_id)->get();
                            @endphp
                            @if ($handoverFiles->count())
                                @foreach ($handoverFiles as $item)
                                    <a href="{{ url('uploads/contest/handover/' . $item->file) }}"
                                        download>{{ $item->file }}</a>
                                @endforeach
                            @else
                                <span class="text-danger">Ops!, 404 not found.</span>
                            @endif
                            <hr>
                            <p class="font-weight-bold"><i class="fa fa-exclamation-circle font-size-xs pr-2"></i> Maybe you
                                receive more than one files so before evaluate the file/files you have to ensure form contest
                                winner.</p>
                        @else
                            <p><i class="fa fa-circle font-size-xs pr-2"></i> When sending the original file of the contest
                                winner to the client who selected the winner, you must send the original file along with the
                                manuscript as attachment <b>(.zip)</b>. Otherwise, the prize payment may be suspended.</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i> The rights to
                                the award are subject to the contract, and upon submission of the original file in
                                accordance
                                with the contract signed, the assignment of the rights in accordance with the contract will
                                automatically be transferred to the client (Terms of Use Articles 25 and 26 (1)))</p>
                            <h4 class="text-warning text-center py-2">Winners are required to send (upload) a <b>zip
                                    file</b>
                                containing the original and description file of the winner.</h4>
                            <hr>
                            <form action="{{ route('contest-handover.store', $contest->contest_id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="handover_file" id="">
                                <input type="submit" value="Send Zip File" class="btn btn-primary">
                                @error('handover_file')
                                    <br>
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <br>
                                <small>(2MB or more can not be uploaded)</small>
                            </form>
                            <hr>
                            <p class="font-weight-bold"><i class="fa fa-exclamation-circle font-size-xs pr-2"></i> If you
                                send
                                the file more than once, you will need to confirm the download to your client and send the
                                next
                                file.</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="card card-bordered rounded-xl mb-4" style="width: 100%">
                        <div class="card-header py-4">
                            <h2 class="h5 font-weight-bold mb-0">Contest Winner Information</h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <img class="avatar-bordered rounded-circle shadow-lg"
                                    src="{{ $contest->contestEntryCompleted->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $contest->contestEntryCompleted->user->id . '/images/' . $contest->contestEntryCompleted->user->img) }}"
                                    width="84" alt="User thumbnail">
                                <div class="pl-3">
                                    <p class="card-text mb-2">
                                        <strong>{{ $contest->contestEntryCompleted->user->username }}</strong>
                                    </p>
                                    <div class="font-size-sm mb-2"><strong>Member
                                            Since:</strong>
                                        {{ $contest->contestEntryCompleted->user->created_at->format('M d, Y') }} </div>
                                    <div class="font-size-sm mb-2"><strong>Location:</strong>
                                        {{ $contest->contestEntryCompleted->user->country }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card card-bordered rounded-xl mb-4" style="width: 100%">
                        <div class="card-header py-4">
                            <h6 class="font-weight-bold mb-0">Contest winner original file and instruction sequence</h6>
                        </div>
                        <div class="card-body">
                            <p><i class="fa fa-check-circle pr-2"></i>Confirmation of transfer of intellectual property
                                right if it is a right transfer contract</p>
                            <p><i class="fa fa-check-circle pr-2"></i>Winner original files and documentation check</p>
                            <p><i class="fa fa-check-circle pr-2"></i>Confirm the winner's original file</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
