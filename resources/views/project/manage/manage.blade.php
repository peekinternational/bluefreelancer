@extends('layouts.app')
@section('content')
<!-- Page Content -->
<x-head-links></x-head-links>

<!-- Title -->
<div class="bg-secondary text-center bg-cover py-5"
    style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
    <h1 class="h5 font-weight-bold text-white">{{ __('ProjectStatus') }}</h1>
</div>

<section class="container py-5">
    <h2 class="font-weight-bold text-center pb-4"><span class="badge text-white bg-success-alt">{{ __('project')
            }}</span>
        {{ $project->title }} </h2>

    <div class="card border-0 bg-primary mb-5">
        <div class="card-header">
            <ul class="nav nav-wider nav-pills nav-pills-light justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link font-weight-bold "
                        href="{{ route('project.manage.proposals', request()->route('id')) }}">{{ __('ProposalTab')
                        }}</a>
                </li>
                <li class="nav-item mr-3" role="presentation">
                    <a class="nav-link font-weight-bold active" id="pills-management-tab"
                        href="{{ route('project.manage.milestone', request()->route('id')) }}">{{ __('MangementTab')
                        }}</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link font-weight-bold" id="pills-modify-tab"
                        href="{{ route('project.manage.modify', request()->route('id')) }}">{{ __('ModifyDelTab') }}</a>
                </li>
            </ul>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="tab-content" id="pills-tabContent">

        <div class="tab-pane fade show active" id="pills-management" role="tabpanel"
            aria-labelledby="pills-management-tab">
            <div class="row">
                <div class="col-lg-8">
                    <ul class="list-unstyled">
                        @if ($proposals->count())
                        @foreach ($proposals as $item)
                        @if ($item->status > 1)
                        <li class="mb-4">
                            <div class="card card-bordered card-body rounded-xl">
                                <div class="row mb-4">
                                    <div class="col-3 col-md-2">
                                        <img class="img-fluid"
                                            src="{{ $item->user->img == '' ? url('assets/img/pages/default.png') : url('uploads/users/' . $item->user->id . '/images/' . $item->user->img) }}"
                                            width="96">
                                    </div>
                                    <div class="col-10">
                                        <h4 class="font-size-lg text-primary pb-2">
                                            <a href="#">{{ $item->user->username }}</a>
                                        </h4>
                                        <div class="d-flex">
                                            <p class="pr-5 text-success">{{ __('Approved') }}</p>
                                            <p>{{ __('CompinDays') }}
                                                {{ $project->currency == 'USD' ? '$' : '₩' }}{{ $item->budget }}
                                                {{ $item->day }} {{ __('days') }}</p>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('milestone.deposit') }}" method="post" class="my-4">
                                    @csrf
                                    <input type="hidden" name="deposit_project_id" value="{{ request()->route('id') }}">
                                    <input type="hidden" name="deposit_user_id" value="{{ $item->user->id }}">
                                    <input type="hidden" name="deposit_bid_id" value="{{ $item->id }}">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="text" name="deposit_name" id="" class="form-control"
                                                placeholder="{{ __('DepositDescription') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="deposit_amount"
                                                placeholder="{{ __('DepositAmount') }}" class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <input type="submit" name="milestone-deposit" value="{{ __('Deposit') }}"
                                                class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>

                                <div class="card border-0 bg-primary mb-4">
                                    <div class="card-header">
                                        <ul class="nav nav-pills nav-pills-light">
                                            <li class="nav-item"><a class="nav-link active" href="#">{{
                                                    __('ProjectMilestone') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                @if ($item->milestones->count())
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">{{ __('AmountRequested') }}</th>
                                            <th scope="col">{{ __('Contents') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($total = 0)
                                        @foreach ($item->milestones as $milestone)
                                        @if ($milestone->status == 2 || $milestone->status == 1)
                                        @php($total += $milestone->amount)
                                        @endif
                                        <tr>
                                            <td>
                                                {{ $project->currency == 'USD' ? '$' : '₩' }}{{ $milestone->amount }}
                                            </td>
                                            <td>{{ $milestone->name }}</td>
                                            <td>
                                                @if ($milestone->status == 1)
                                                {{ __('RequestRelease') }}
                                                @elseif($milestone->status == 2)
                                                {{ __('Deposit') }}
                                                @elseif($milestone->status == 3)
                                                {{ __('RejectedByProjectOwner') }}
                                                @elseif($milestone->status == 4)
                                                {{ __('Paid') }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($milestone->status == 1)
                                                <form action="{{ route('milestone.depositOrReject', $milestone->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="project_id"
                                                        value="{{ request()->route('id') }}">
                                                    <input type="submit" class="btn btn-success bt-xs" name="deposit"
                                                        value="{{ __('Deposit') }}">
                                                    <input type="submit" class="btn btn-danger bt-xs" name="reject"
                                                        value="{{ __('Reject') }}">
                                                </form>
                                                @elseif($milestone->status == 2)
                                                <form action="{{ route('milestone.rrd', $milestone->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="project_id"
                                                        value="{{ request()->route('id') }}">
                                                    <input type="submit" class="btn btn-success bt-xs"
                                                        name="amount_release" value="{{ __('AmountRelease') }}">
                                                    <input type="submit" class="btn btn-danger bt-xs" name="dispute"
                                                        value="{{ __('Dispute') }}">
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p>
                                    <strong>{{ __('Total') }}:
                                        {{ $project->currency == 'USD' ? '$' : '₩' }}{{ $total }}</strong>
                                </p>
                                @else
                                <table>
                                    <tr>
                                        <td>
                                            <span class="text-danger">{{ __('notFound') }}</span>
                                        </td>
                                    </tr>
                                </table>

                                @endif
                            </div>
                        </li>
                        @endif
                        @endforeach
                        @endif
                    </ul>
                </div>

                <div class="col-lg-4">
                    <div class="card card-bordered card-body rounded-xl">
                        <h5 class="font-size-lg mb-4"><strong>{{ __('ManageandSecure') }}</strong></h5>
                        <h5 class="font-size-lg mb-3"><strong>{{ __('MilestoneAre') }} :</strong></h5>
                        <ul class="list-unstyled lh-3">
                            <li>
                                <div class="icon border-info mx-1">
                                    <i class="fa fa-check text-info"></i>
                                </div>
                                <span class="text-info"><strong>{{ __('SafeSecure') }}:</strong></span>
                                <span>{{ __('hildyourmilestone') }}</span>
                            </li>

                            <li>
                                <div class="icon border-info mx-1">
                                    <i class="fa fa-check text-info"></i>
                                </div>
                                <span class="text-info"><strong>{{ __('Refundable') }} :</strong></span>
                                <span>{{ __('dissatisfied') }}</span>
                            </li>

                            <li>
                                <div class="icon border-info mx-1">
                                    <i class="fa fa-check text-info"></i>
                                </div>
                                <span class="text-info"><strong>{{ __('Controlled') }}:</strong></span>
                                <span>{{ __('satisfied') }}</span>
                            </li>

                            <li>
                                <div class="icon border-danger mx-1">
                                    <i class="fa fa-check text-danger"></i>
                                </div>
                                <span class="text-info"><strong>{{ __('nodirectmoney') }}</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection