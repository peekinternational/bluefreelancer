@extends('layouts.app')
@section('content')
    <x-head-links></x-head-links>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('UploadContestFileSourceFiles') }}</h1>
    </div>

    <div class="bg-gray-500 py-4 mb-3">
        <div class="container">
            <div class="d-sm-flex justify-content-between align-items-center mb-3 mb-sm-2">
                <h4 class="font-weight-bold text-white mb-3 mb-sm-0">{{ $contest->title }}</h4>
                <span class="badge bg-warning-alt2 font-size-lg text-white p-2">{{ __('EndContest') }}
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
                                {{ __('DownOrgDoc') }}
                            @else
                                {{ __('SendOrgDocUpload') }}
                            @endif
                        </h2>
                    </div>
                    <div class="card-body">
                        @if ($contest->user_id == auth()->id())
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>{{ __('ContractSignedTransferRights') }}</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>{{ __('ClientConfirmWinner') }}</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>{{ __('AllDesignsAndIdeas') }}</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>{{ __('FreelanceDesignsIdeas') }}</p>
                            <p><i class="fa fa-circle font-size-xs pr-2"></i>{{ __('WinnersWhoDoNotRight') }}
                            </p>
                            <h6 class="font-weight-bold">{{ __('Downloadthefiles') }}:</h6>
                            @php
                                $handoverFiles = App\Models\ContestHandover::where('contest_id', $contest->contest_id)->get();
                            @endphp
                            @if ($handoverFiles->count())
                                @foreach ($handoverFiles as $item)
                                    <a href="{{ url('uploads/contest/handover/' . $item->file) }}"
                                        download>{{ $item->file }}</a>
                                @endforeach
                            @else
                                <span class="text-danger">{{ __('notFound') }}</span>
                            @endif
                            <hr>
                            <p class="font-weight-bold"><i class="fa fa-exclamation-circle font-size-xs pr-2"></i>
                                {{ __('EnsureFromContestWinner') }}</p>
                        @else
                            <p><i class="fa fa-circle font-size-xs pr-2"></i> {{ __('ArticleAccordance') }}</p>
                            {{-- <p><i class="fa fa-circle font-size-xs pr-2"></i> The rights to
                                the award are subject to the contract, and upon submission of the original file in
                                accordance
                                with the contract signed, the assignment of the rights in accordance with the contract will
                                automatically be transferred to the client (Terms of Use Articles 25 and 26 (1)))</p> --}}
                            <h4 class="text-warning text-center py-2">{{ __('WinnerOrginalDescription') }}</h4>
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
                                <small>({{ __('fileWarning') }})</small>
                            </form>
                            <hr>
                            <p class="font-weight-bold"><i class="fa fa-exclamation-circle font-size-xs pr-2"></i>
                                {{ __('ConfirmDownload') }}</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="card card-bordered rounded-xl mb-4" style="width: 100%">
                        <div class="card-header py-4">
                            <h2 class="h5 font-weight-bold mb-0">{{ __('ContestWinnerInfo') }}</h2>
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
                                    <div class="font-size-sm mb-2"><strong>{{ __('MemberSince') }}:</strong>
                                        {{ $contest->contestEntryCompleted->user->created_at->format('M d, Y') }} </div>
                                    <div class="font-size-sm mb-2"><strong>{{ __('location') }}:</strong>
                                        {{ $contest->contestEntryCompleted->user->country }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card card-bordered rounded-xl mb-4" style="width: 100%">
                        <div class="card-header py-4">
                            <h6 class="font-weight-bold mb-0">{{ __('InstructionSequence') }}</h6>
                        </div>
                        <div class="card-body">
                            <p><i class="fa fa-check-circle pr-2"></i>{{ __('ConfirmatinIntellectualProp') }}</p>
                            <p><i class="fa fa-check-circle pr-2"></i>{{ __('DocCheck') }}</p>
                            <p><i class="fa fa-check-circle pr-2"></i>{{ __('ConfirmWinner') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
