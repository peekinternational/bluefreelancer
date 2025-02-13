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
        <h1 class="h5 font-weight-bold text-white">{{ __('MyProjectContest') }}</h1>
    </div>

    <section class="container py-5 mt-3 mt-md-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6">
                <h2 class="h5 font-weight-bold mb-3">{{ __('MyProjectContest') }}</h2>
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <ul class="nav nav-pills nav-pills-dark border border-secondary rounded-pill mb-3" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill active"
                            href="{{ route('my-project.employer.open-projects') }}">{{ __('Employer') }}</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill "
                            href="{{ route('my-project.freelancer.open-projects') }}">{{ __('FreeLancer') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container pb-5 mb-3 mb-md-4">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-employeer" role="tabpanel"
                aria-labelledby="pills-employeer-tab">
                <div class="card rounded-xl overflow-hidden">
                    <div class="card-header bg-secondary">
                        <div class="nav nav-pills nav-pills-light nav-fill flex-column flex-md-row mb-md-n2" id="nav-tab"
                            role="tablist">
                            <a class="nav-link py-2" id="nav-open-tab"
                                href="{{ route('my-project.employer.open-projects') }}">{{ __('Opentab') }}</a>
                            <a class="nav-link py-2 active" id="nav-work-tab" href="#nav-work">{{ __('WorkProgess') }}</a>
                            <a class="nav-link py-2" id="nav-past-project-tab"
                                href="{{ route('my-project.employer.past-projects') }}">{{ __('PastProject') }}</a>
                            <a class="nav-link py-2" id="nav-active-contest-tab"
                                href="{{ route('my-project.employer.open-contests') }}">{{ __('OpenContests') }}</a>
                            <a class="nav-link py-2" id="nav-past-contest-tab"
                                href="{{ route('my-project.employer.awarded-contests') }}">{{ __('PrizesAwarded') }}</a>
                        </div>
                    </div>
                </div>

                <div class="row py-4 d-none d-md-flex my-3">
                    <div class="col-md-8 col-lg-10">
                        <form action="{{ route('my-project.employer.work-projects') }}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="You can find projects by their names / 이름으로 프로젝트를 찾을 수 있습니다." name="filter"
                                    value="{{ request('filter') ? request('filter') : '' }}">
                                <div class="input-group-append">
                                    <button class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="col-md-4 col-lg-2">
                        <div class="input-group">
                            <select class="custom-select" onchange="window.location.href=this.value;">
                                {{-- <option value="{{ route('my-project.employer.open-projects') }}?limit=1">1 Items</option> --}}
                                <option value="{{ route('my-project.employer.work-projects') }}?limit=10"
                                    @if (request('limit') == 10) selected @endif>10 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.employer.work-projects') }}?limit=25"
                                    @if (request('limit') == 25) selected @endif>25 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.employer.work-projects') }}?limit=50"
                                    @if (request('limit') == 50) selected @endif>50 Items | 아이템
                                </option>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content border shadow-sm" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">{{ __('PROJECTName') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('FREELANCE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('AWARDEDBIDS') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('DEADLINE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('MILESTONE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('ACTION') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($workProjects->count())
                                        @foreach ($workProjects as $item)
                                            <tr>
                                                <td class="text-nowrap py-3">
                                                    <a href="{{ route('project.manage.milestone', $item->project_id) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ App\Models\User::find($item->bid->user_id)->username }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->currency == 'USD' ? '$' : '₩' }}
                                                    @if ($item->rate_status == '1')
                                                        {{ $item->bid->budget }}
                                                    @else
                                                        {{ $item->bid->budget . '/' . __('hourly') }}
                                                    @endif
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->bid->updated_at->addDays($item->day)->format('M d, Y') }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ App\Models\Milestone::getMilestoneCount($item->bid->project_id, $item->bid->user_id) }}
                                                </td>
                                                <td class="text-nowrap py-3" style="min-width: 10rem;">
                                                    <select class="custom-select custom-select-sm"
                                                        onchange="window.location.href=this.value;">
                                                        <option selected
                                                            value="{{ route('my-project.employer.work-projects') }}">
                                                            Select | 선택하다
                                                        </option>
                                                        <option
                                                            value="{{ route('project.manage.milestone', $item->project_id) }}">
                                                            View Milestones | 이정표 보기
                                                        </option>
                                                        <option
                                                            value="{{ route('project.manage.modify', $item->project_id) }}">
                                                            Modify Project | 프로젝트 수정
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <caption class="text-danger text-center">
                                        {{ __('workCaption') }}
                                    </caption>
                                </tbody>
                            </table>
                        </div>
                        {{ $workProjects->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
