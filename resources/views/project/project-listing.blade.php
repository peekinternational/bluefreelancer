@extends('layouts.app')
@section('content')
    <div class="bg-secondary text-center bg-cover py-5"
        style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
        <h1 class="h5 font-weight-bold text-white">{{ __('projectList') }}</h1>
    </div>

    <section class="container py-5">
        <div class="card card-bordered card-body rounded-xl py-5 mb-4">
            <h2 class="h5 font-weight-bold mb-4">{{ __('LookingForProjects') }}</h2>
            <form action="{{ route('project-listing') }}" method="get" id="projectSearchForm">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-search"></i>
                        </div>
                    </div>
                    <input class="form-control" type="text" name="search_project_by_title"
                        placeholder="{{ __('SeeProject') }}"
                        value="{{ request()->search_project_by_title ? request()->search_project_by_title : '' }}">
                </div>
                <hr>
                <h2 class="h5 font-weight-bold pt-3 mb-4">{{ __('mySkills') }}</h2>
                <div class="form-group pb-3">
                    <select class="custom-select" data-toggle="select" id="search_project_skills" multiple>
                        {{-- Coming Option From Ajax.js (AJAX CALL) --}}
                        @if (request()->search_project_by_skills)
                            <ul class="list-inline">
                                @foreach (Illuminate\Support\Str::of(request()->search_project_by_skills)->explode(',') as $skill)
                                    <option selected="selected" value="{{ $skill }}">
                                        {{ App\Models\User::skillTitle($skill)->title }}
                                    </option>
                                @endforeach
                            </ul>
                        @endif
                    </select>
                    <input type="hidden" name="search_project_by_skills" id="selected_search_project_skills" required>
                </div>
                <input type="submit" value="{{ __('Filter') }}" class="btn mb-2 btn-info btn-sm">
                <a href="{{ route('project-listing') }}"
                    class="btn mb-2 btn-secondary btn-sm">{{ __('ClearFilter') }}</a>
            </form>

            {{ $projects->links('vendor.pagination.custom') }}

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th scope="col">{{ __('ProjectDetails') }}</th>
                            <th class="text-center" scope="col">{{ __('Bids') }}</th>
                            <th class="text-center" scope="col">{{ __('started') }}</th>
                            <th class="text-center" scope="col">{{ __('budget') }}</th>
                            <th class="text-center" scope="col">{{ __('AvailableInterview') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($projects->count())
                            @foreach ($projects as $proj)
                                <tr>
                                    <td class="py-4">
                                        <div class="media">
                                            <i class="fa fa-desktop h1 text-body mr-3"></i>
                                            <div class="media-body">
                                                <h5 class="h6 font-weight-bold">
                                                    <a class="link-heading"
                                                        href="{{ route('project.show', $proj->project_id) }}">{{ $proj->title }}</a>
                                                </h5>
                                                <p class="font-size-sm">{!! Illuminate\Support\Str::of($proj->description)->limit(255) !!}</p>
                                                <ul class="list-inline">
                                                    @if ($proj->skills)
                                                        @foreach (Illuminate\Support\Str::of($proj->skills)->explode(',') as $skill)
                                                            <li class="list-inline-item font-size-sm text-info mx-2">
                                                                {{ App\Models\User::skillTitle($skill)->title }}
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                <span class="badge badge-info">{{ __('featured') }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center font-size-sm py-4">
                                        {{ App\Models\Bid::getBids($proj->project_id)->count() }}
                                    </td>
                                    <td class="text-center font-size-sm py-4">
                                        <i class="fa fa-clock-o text-warning-alt mr-1"></i>
                                        {{ $proj->created_at->format('M d, y') }}
                                    </td>
                                    <td class="text-center font-size-sm py-4">
                                        <div class="hover-visible">
                                            @if ($proj->min_budget && $proj->max_budget)
                                                {{ $proj->currency == 'USD' ? '$' : '₩' }} {{ $proj->min_budget }} -
                                                {{ $proj->currency == 'USD' ? '$' : '₩' }} {{ $proj->max_budget }}
                                            @else
                                                @if ($proj->rate_status == '1')
                                                    {{ $proj->fixed_rate }}
                                                @else
                                                    {{ $proj->hourly_rate . '/' . __('hourly') }}
                                                @endif
                                            @endif

                                            <div class="hover-visible-content">
                                                <span class="badge badge-info">{{ __('gaurantee') }}</span>
                                                <div class="py-1"></div>
                                                <a class="badge badge-info"
                                                    href="{{ route('post-project') }}">{{ __('postProjectLikeThis') }}</a>
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
                                        @if ($proj->user_id == auth()->id())
                                            <a href="" class="btn btn-secondary">{{ __('YourProject') }}</a>
                                        @else
                                            <a href="{{ route('project.show', $proj->project_id) }}"
                                                class="btn btn-secondary">{{ __('bidNow') }}</a>
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

            {{ $projects->links('vendor.pagination.custom') }}
        </div>
    </section>
@endsection
