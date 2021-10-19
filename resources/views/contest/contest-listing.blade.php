@extends('layouts.app')
@section('content')
    <!-- Page Content -->
    <x-head-links></x-head-links>

    <!-- Title -->
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('contestList') }}</h1>
    </div>

    <section class="container py-5">
        <div class="card card-bordered rounded-xl mb-4">
            <div class="card-header py-4">
                <h2 class="h5 font-weight-bold mb-0">{{ __('RecentlyCompletedContests') }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    @if ($contest_completed->count())
                        @foreach ($contest_completed as $item)
                            <div class="col-md-3">
                                <div class="card border-0 shadow rounded-xl overlay-hidden">
                                    <img src="{{ url('uploads/contest/entry/' . $item->contestEntryCompleted->file) }}"
                                        alt="Contest thumbnail" height="200" class="card-img-top">
                                    <a href="{{ route('post-contest') }}"
                                        class="btn btn-primary btn-sm rounded-0">{{ __('PostContestLikeThis') }}</a>
                                    <div class="d-flex align-items-center p-3">
                                        <i class="fa fa-trophy h4 text-warning-alt mb-0 mr-2"></i>
                                        <div class="card-text">{{ __('winner') }}
                                            {{ App\Models\User::find($item->contestEntryCompleted->user_id)->username }}
                                        </div>
                                    </div>
                                    <div class="card-footer px-3">
                                        <div class="mr-2">
                                            <span class="badge bg-success-alt text-white mr-2">100%</span>
                                            <span class="ratings">
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                                <i class="fa fa-star active"></i>
                                            </span>
                                        </div>
                                        <div class="font-size-sm">
                                            {{ $item->currency == 'USD' ? '$' : '₩' }}
                                            {{ $item->contestEntryCompleted->amount }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="text-danger">{{ __('notFound') }}</span>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section class="container py-5">
        <div class="card card-bordered card-body rounded-xl py-5 mb-4">
            <h2 class="h5 font-weight-bold mb-4">{{ __('browseContest') }}</h2>

            <form action="{{ route('contest-listing') }}" method="get" id="contestSearchForm">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" name="search_contest_by_title"
                        placeholder="{{ __('RegisterCont') }}"
                        value="{{ request()->search_contest_by_title ? request()->search_contest_by_title : '' }}">
                </div>
                <hr>
                <h2 class="h5 font-weight-bold pt-3 mb-4">{{ __('ExpertiesSkills') }}</h2>
                <div class="form-group pb-3">
                    <select class="custom-select" data-toggle="select" id="search_contest_skills" multiple>
                        {{-- Coming Option From Ajax.js (AJAX CALL) --}}
                        @if (request()->search_contest_by_skills)
                            <ul class="list-inline">
                                @foreach (Illuminate\Support\Str::of(request()->search_contest_by_skills)->explode(',') as $skill)
                                    <option selected="selected" value="{{ $skill }}">
                                        {{ App\Models\User::skillTitle($skill)->title }}
                                    </option>
                                @endforeach
                            </ul>
                        @endif
                    </select>
                    <input type="hidden" name="search_contest_by_skills" id="selected_search_contest_skills" required>
                </div>
                <input type="submit" value="{{ __('Filter') }}" class="btn mb-2 btn-info btn-sm">
                <a href="{{ route('contest-listing') }}"
                    class="btn mb-2 btn-secondary btn-sm">{{ __('ClearFilter') }}</a>
            </form>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th scope="col">{{ __('ContestTitle') }}</th>
                            <th class="text-center" scope="col">{{ __('entries') }}</th>
                            <th class="text-center" scope="col">{{ __('started') }}</th>
                            <th class="text-center" scope="col">{{ __('budget') }}</th>
                            <th class="text-center" scope="col">{{ __('AvailableInterview') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($contests->count())
                            @foreach ($contests as $item)
                                <tr>
                                    <td class="py-4">
                                        <div class="media">
                                            <i class="fa fa-trophy h1 text-warning-alt mr-3"></i>
                                            <div class="media-body">
                                                <h5 class="h6 font-weight-bold">
                                                    <a class="link-heading"
                                                        href="{{ route('contest-details', $item->contest_id) }}">{{ $item->title }}</a>
                                                </h5>
                                                <p class="font-size-sm">{!! Illuminate\Support\Str::of($item->description)->limit(255) !!}</p>
                                                <ul class="list-inline">
                                                    @foreach (Illuminate\Support\Str::of($item->skills)->explode(',') as $skill)
                                                        <li class="list-inline-item font-size-sm text-info mx-2">
                                                            {{ App\Models\User::skillTitle($skill)->title }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <span class="badge badge-info">{{ __('featured') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center font-size-sm py-4">{{ $item->contestEntries->count() }}</td>
                                    <td class="text-center font-size-sm py-4">
                                        <i class="fa fa-clock-o text-warning-alt mr-1"></i>
                                        {{ $item->created_at->format('M d, y') }}
                                    </td>
                                    <td class="text-center font-size-sm py-4">
                                        <div class="hover-visible">
                                            {{ $item->currency == 'USD' ? '$' : '₩' }}
                                            {{ $item->budget }}
                                            <div class="hover-visible-content">
                                                <span class="badge badge-info">{{ __('Guaranteed') }}</span>
                                                <div class="py-1"></div>
                                                <a class="badge badge-info"
                                                    href="{{ route('post-contest') }}">{{ __('PostContestLikeThis') }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4">
                                        <div class="d-flex justify-content-center font-size-sm text-info mb-3">
                                            <i class="fa fa-play-circle mx-1"></i>
                                            <i class="fa fa-commenting-o mx-1"></i>
                                            <i class="fa fa-mobile-phone mx-1"></i>
                                            <i class="fa fa-envelope-open-o mx-1"></i>
                                            <i class="fa fa-desktop mx-1"></i>
                                            <i class="fa fa-print mx-1"></i>
                                        </div>
                                        @if ($item->user_id == auth()->id())
                                            <a href="{{ route('contest-details', $item->contest_id) }}"
                                                class=" btn btn-success active">{{ __('myContest') }}</a>
                                        @else
                                            @if ($item->status == 1)
                                                <a href="{{ route('contest-details', $item->contest_id) }}"
                                                    class=" btn btn-info active">{{ __('Participate') }}</a>
                                            @elseif($item->status == 2)
                                                <a href="#"
                                                    class=" disabled btn btn-warning active">{{ __('contestClosed') }}</a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><span class="text text-danger">{{ __('notFound') }}</span></tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <hr class="mb-5">
            {{ $contests->links('vendor.pagination.custom') }}

        </div>
    </section>
@endsection
