@extends('layouts.app')
@section('content')
    <div class="card card-bordered rounded-xl m-4">
        <div class="card-body">
            <form action="{{ route('bid.update', $bid->id) }}" method="post" id="bidForm">
                @csrf
                <input type="hidden" value="{{ $bid->project_id }}" name="project_id">
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <h5 class="card-title mb-3">Bid:</h5>

                        <div class="row mb-2">
                            <label class="col-md-6" for="bidPrice">Paid to you:</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            {{ $project->currency == 'USD' ? '$' : '₩' }}
                                        </div>
                                    </div>
                                    <input type="number" class="form-control" id="bidPrice" placeholder="0"
                                        onkeyup="bidPriceFun()" name="budget" required value="{{ $bid->budget }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            {{ $project->currency == 'USD' ? 'USD' : 'KRW' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-6" for="bidPrice">Your Bid:</label>
                            <div class="col-md-6">
                                <div class="input-group align-items-center">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-transparent border-0">
                                            {{ $project->currency == 'USD' ? '$' : '₩' }}
                                        </div>
                                    </div>
                                    <span id="bidPriceAmt">{{ $bid->budget }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <label class="col-md-6" for="proposal">Proposal:</label>
                            <div class="col-md-6 input-group">
                                <textarea class="form-control" name="proposal" id="proposal" cols="30" rows="10"
                                    placeholder="Write You Project Proposal Description"
                                    required>{{ $bid->proposal }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mb-3">
                        <div class="row justify-content-between mb-2">
                            <div class="col-md-6">
                                <h5 class="card-title mb-3">Deliver In:</h5>

                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="3" name="days" required
                                        value="{{ $bid->day }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Days</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="d-flex justify-content-center border rounded-lg py-4"
                                    style="border-width: .25rem !important;">
                                    <span class="h2 text-heading mb-0" data-annual="0"
                                        data-monthly="0">{{ auth()->user()->bids }}</span>
                                    <span class="align-self-end">
                                        /&nbsp;300
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between mb-2">
                            <div class="col-md-6">
                                <h5 class="card-title mb-3">Milstone:
                                    <a href="javascript:void(0)" onclick="addMilestoneRow()"><i
                                            class="fa fa-plus-circle"></i></a>
                                </h5>
                            </div>
                        </div>
                        <div class="row container">
                            <h6>Total Milestone Amount:
                                {{ $project->currency == 'USD' ? '$' : '₩' }}
                                <b><span id="milestoneAmt"></span></b>
                            </h6>
                        </div>
                        <div class="row container">
                            <span class="text-danger" id="milestoneError"></span>
                        </div>
                        <div class="row justify-content-between mb-2" id="milestoneInputBlock">
                            @foreach ($bid->milestones as $item)
                                <input type="hidden" name="milestoneId[]" value="{{ $item->id }}">
                                <div class="row col-md-12 mb-2">
                                    <div class="col-md-6">
                                        <input type="text" placeholder="Project Milestone" name="milestone_name[]" id=""
                                            class="form-control" value="{{ $item->name }}">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" class="form-control bidAmtItems" name="milestone_amt[]"
                                            value="{{ $item->amount }}" id="milestone_amt" min="3" placeholder="For"
                                            onchange="addMilestoneAmt()">
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-block w-md-auto" value="Update Bid">
            </form>
        </div>
    </div>
@endsection
