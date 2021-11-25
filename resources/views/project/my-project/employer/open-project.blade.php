@extends('layouts.app')
@section('content')
    <style>
        nav {
            text-align: center;
        }

    </style>
    <x-head-links></x-head-links>

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
                            <a class="nav-link py-2 active" id="nav-open-tab" href="#nav-open">{{ __('Opentab') }}</a>
                            <a class="nav-link py-2" id="nav-work-tab"
                                href="{{ route('my-project.employer.work-projects') }}">{{ __('WorkProgess') }}</a>
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
                        <form action="{{ route('my-project.employer.open-projects') }}" method="get">
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
                                <option value="{{ route('my-project.employer.open-projects') }}?limit=10"
                                    @if (request('limit') == 10) selected @endif>10 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.employer.open-projects') }}?limit=25"
                                    @if (request('limit') == 25) selected @endif>25 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.employer.open-projects') }}?limit=50"
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
                    <div class="tab-pane fade show active" id="nav-open" role="tabpanel" aria-labelledby="nav-open-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">{{ __('PROJECTName') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('BID') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('AVGBIDS') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('DEADLINE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('ACTION') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($openProjects->count())
                                        @foreach ($openProjects as $item)
                                            <tr>
                                                <td class="position-relative text-nowrap py-3">
                                                    <a href="{{ route('project.manage.milestone', $item->project_id) }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ App\Models\Bid::getBids($item->project_id)->count() }}</td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->currency == 'USD' ? '$' : '₩' }}
                                                    {{ App\Models\Bid::getBidAvgAmt($item->project_id) ? App\Models\Bid::getBidAvgAmt($item->project_id) : '0' }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->created_at->addDays(15)->format('M d, Y') }}
                                                </td>
                                                <td class="text-nowrap py-3" style="min-width: 10rem;">
                                                    <select class="custom-select custom-select-sm"
                                                        onchange="window.location.href=this.value;">
                                                        <option selected
                                                            value="{{ route('my-project.employer.open-projects') }}">
                                                            Select |
                                                            선택하다</option>
                                                        <option
                                                            value="{{ route('project.manage.proposals', $item->project_id) }}">
                                                            View Applicant | 지원자 보기
                                                        </option>
                                                        <option
                                                            value="{{ route('project.manage.modify', $item->project_id) }}">
                                                            Modify Project | 프로젝트 수정
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                </tbody>
                            @else
                                <caption>
                                    <button class="btn btn-light btn-block">
                                        {{ __('openCaption') }}
                                    </button>
                                </caption>
                                @endif
                            </table>
                        </div>
                        {{ $openProjects->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>

                    {{-- <div class="tab-pane fade" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">PROJECT NAME</th>
                                        <th class="text-nowrap" scope="col">APPLICANT</th>
                                        <th class="text-nowrap" scope="col">AWARDED BIDS</th>
                                        <th class="text-nowrap" scope="col">DEADLINE</th>
                                        <th class="text-nowrap" scope="col">MILESTONE</th>
                                        <th class="text-nowrap" scope="col">ACTION</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if ($workProjects->count())
                                        @foreach ($workProjects as $item)
                                            <tr>
                                                <td class="text-nowrap py-3">
                                                    <a href="{{ route('project.show', $item->project_id) }}">
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
                                                        {{ $item->bid->budget . '/Hourly' }}
                                                    @endif
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->bid->updated_at->addDays($item->day)->format('M d, Y') }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ App\Models\Milestone::getMilestoneCount($item->bid->project_id, $item->bid->user_id) }}
                                                </td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    <caption class="text-danger text-center">
                                        If you don't see any project its means no one approved your project proposal.
                                    </caption>
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="tab-pane fade" id="nav-past-project" role="tabpanel"
                        aria-labelledby="nav-past-project-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">PROJECT NAME</th>
                                        <th class="text-nowrap" scope="col">BIDS</th>
                                        <th class="text-nowrap" scope="col">APPLICANTS</th>
                                        <th class="text-nowrap" scope="col">AWARDED BIDS</th>
                                        <th class="text-nowrap" scope="col">TIME</th>
                                        <th class="text-nowrap" scope="col">STATUS</th>
                                        <th class="text-nowrap" scope="col">ACTION</th>
                                    </tr>
                                </thead>

                                <tbody></tbody>

                                <caption>
                                    <button class="btn btn-light btn-block">
                                        You have not bid on any project please click <a href="#">Browse Projects</a> to view
                                        all posted projects.
                                    </button>
                                </caption>
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="tab-pane fade" id="nav-active-contest" role="tabpanel"
                        aria-labelledby="nav-active-contest-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">CONTEST NAME</th>
                                        <th class="text-nowrap" scope="col">ENTRIES</th>
                                        <th class="text-nowrap" scope="col">PRIZE</th>
                                        <th class="text-nowrap" scope="col">DEADLINE</th>
                                    </tr>
                                </thead>
                                @if ($openContests->count())
                                    <tbody>
                                        @foreach ($openContests as $item)
                                            <tr>
                                                <td class="text-nowrap py-3">{{ $item->title }}</td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->contestEntries->count() }}
                                                </td>
                                                <td class="text-nowrap py-3">{{ $item->budget }}</td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->created_at->addDays($item->days)->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <caption>
                                        <button class="btn btn-light btn-block">
                                            You have not bid on any project please click <a href="#">Browse Projects</a> to
                                            view
                                            all posted projects.
                                        </button>
                                    </caption>
                                @endif
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="tab-pane fade" id="nav-past-contest" role="tabpanel"
                        aria-labelledby="nav-past-contest-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">CONTEST NAME</th>
                                        <th class="text-nowrap" scope="col">APPLICANTS</th>
                                        <th class="text-nowrap" scope="col">AWARDED ENTRY</th>
                                        <th class="text-nowrap" scope="col">AWARDED PRIZE</th>
                                        <th class="text-nowrap" scope="col">PAYMENT DATE</th>
                                    </tr>
                                </thead>

                                @if ($awardedContests->count())
                                    <tbody>
                                        @foreach ($awardedContests as $item)
                                            <tr>
                                                <td class="text-nowrap py-3">{{ $item->title }}</td>
                                                <td lass="text-nowrap py-3">
                                                    {{ App\Models\User::find($item->contestEntryCompleted->user_id)->username }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->contestEntryCompleted->title }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->contestEntryCompleted->amount }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->updated_at->format('M d, Y') }}
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                @else
                                    caption>
                                    <button class="btn btn-light btn-block">
                                        You have not bid on any project please click <a href="#">Browse Projects</a> to view
                                        all posted projects.
                                    </button>
                                    </caption>
                                @endif
                            </table>
                        </div>
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-center">
                                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
