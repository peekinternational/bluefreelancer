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
        <h1 class="h5 font-weight-bold text-white">My Project &amp; Contest</h1>
    </div>

    <section class="container py-5 mt-3 mt-md-4">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6">
                <h2 class="h5 font-weight-bold mb-3">My Project ㆍ Contest</h2>
            </div>

            <div class="col-md-6 d-flex justify-content-end">
                <ul class="nav nav-pills nav-pills-dark border border-secondary rounded-pill mb-3" id="pills-tab"
                    role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill active" href="{{ route('my-project.employer') }}">Employeer</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill" href="{{ route('my-project.freelancer') }}">Freelancer</a>
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
                            <a class="nav-link py-2 active" id="nav-open-tab" data-toggle="tab" href="#nav-open" role="tab"
                                aria-controls="nav-open" aria-selected="true">Open</a>
                            <a class="nav-link py-2" id="nav-work-tab" data-toggle="tab" href="#nav-work" role="tab"
                                aria-controls="nav-work" aria-selected="false">Work</a>
                            <a class="nav-link py-2" id="nav-past-project-tab" data-toggle="tab" href="#nav-past-project"
                                role="tab" aria-controls="nav-past-project" aria-selected="false">Past Project</a>
                            <a class="nav-link py-2" id="nav-active-contest-tab" data-toggle="tab"
                                href="#nav-active-contest" role="tab" aria-controls="nav-active-contest"
                                aria-selected="false">Open Contest</a>
                            <a class="nav-link py-2" id="nav-past-contest-tab" data-toggle="tab" href="#nav-past-contest"
                                role="tab" aria-controls="nav-past-contest" aria-selected="false">Awarded Contest</a>
                        </div>
                    </div>
                </div>

                <div class="row py-4 d-none d-md-flex my-3">
                    <div class="col-md-8 col-lg-10">
                        <div class="input-group">
                            <input type="text" class="form-control">
                            <div class="input-group-append">
                                <button class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-2">
                        <div class="input-group">
                            <select class="custom-select">
                                <option value="1">1 Items</option>
                                <option value="10">10 Items</option>
                                <option value="25">25 Items</option>
                                <option value="50">50 Items</option>
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
                                        <th class="text-nowrap" scope="col">PROJECT NAME</th>
                                        <th class="text-nowrap" scope="col">BIDS</th>
                                        <th class="text-nowrap" scope="col">AVG BIDS</th>
                                        <th class="text-nowrap" scope="col">DEADLINE</th>
                                        <th class="text-nowrap" scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($openProjects->count())
                                        @foreach ($openProjects as $item)
                                            <tr>
                                                <td class="position-relative text-nowrap py-3">
                                                    <a href="{{ route('project.show', $item->project_id) }}">
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
                                                        <option selected value="{{ route('my-project.employer') }}">
                                                            Select</option>
                                                        <option value="{{ route('project.manage', $item->project_id) }}">
                                                            View Applicant
                                                        </option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <span class="text-danger">Ops 404 not Found!</span>
                                        </tr>
                                    @endif
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

                    <div class="tab-pane fade" id="nav-work" role="tabpanel" aria-labelledby="nav-work-tab">
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
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
