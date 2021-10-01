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
                        <a class="nav-link rounded-pill" href="{{ route('my-project.employer.open-projects') }}">Employeer</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link rounded-pill active" href="{{ route('my-project.freelancer.open-projects') }}">Freelancer</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="container pb-5 mb-3 mb-md-4">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-freelancer" role="tabpanel"
                aria-labelledby="pills-freelancer-tab">
                <div class="card rounded-xl overflow-hidden">
                    <div class="card-header bg-secondary">
                        <div class="nav nav-pills nav-pills-light nav-fill flex-column flex-md-row mb-md-n2" id="nav-tabs"
                            role="tablist">
                            <a class="nav-link py-2 active" id="nav-open2-tab" href="#nav-open2">Open</a>
                            <a class="nav-link py-2" id="nav-work2-tab"
                                href="{{ route('my-project.freelancer.work-projects') }}">Work</a>
                            <a class="nav-link py-2" id="nav-past-project2-tab" href="{{ route('my-project.freelancer.past-projects') }}">Past Project</a>
                            <a class="nav-link py-2" id="nav-active-contest2-tab" href="{{ route('my-project.freelancer.active-contests') }}">Active
                                Contest</a>
                            <a class="nav-link py-2" id="nav-past-contest2-tab" href="{{ route('my-project.freelancer.past-contests') }}">Past Contest</a>
                        </div>
                    </div>
                </div>

                <div class="row py-4 d-none d-md-flex my-3">
                    <div class="col-md-8 col-lg-10">
                        <form action="{{ route('my-project.freelancer.open-projects') }}" method="get">
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
                                <option value="{{ route('my-project.freelancer.open-projects') }}?limit=10"
                                    @if (request('limit') == 10) selected @endif>10 Items
                                </option>
                                <option value="{{ route('my-project.freelancer.open-projects') }}?limit=25"
                                    @if (request('limit') == 25) selected @endif>25 Items
                                </option>
                                <option value="{{ route('my-project.freelancer.open-projects') }}?limit=50"
                                    @if (request('limit') == 50) selected @endif>50 Items
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

                <div class="tab-content border shadow-sm" id="nav-tabsContent">
                    <div class="tab-pane fade show active" id="nav-open2" role="tabpanel" aria-labelledby="nav-open2-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">PROJECT NAME</th>
                                        <th class="text-nowrap" scope="col">BIDS</th>
                                        <th class="text-nowrap" scope="col">MY BIDS</th>
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
                                                        {{ $item->project->title }}
                                                    </a>
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ App\Models\Bid::where('project_id', $item->project_id)->count() }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->project->currency == 'USD' ? '$' : '₩' }}
                                                    @if ($item->project->rate_status == '1')
                                                        {{ $item->budget }}
                                                    @else
                                                        {{ $item->budget . '/Hourly' }}
                                                    @endif
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->project->currency == 'USD' ? '$' : '₩' }}
                                                    {{ App\Models\Bid::getBidAvgAmt($item->project_id) }}
                                                </td>
                                                <td class="text-nowrap py-3">
                                                    {{ $item->day }} Days
                                                </td>
                                                <td class="text-nowrap py-3" style="min-width: 10rem;">
                                                    <select class="custom-select custom-select-sm"
                                                        onchange="window.location.href=this.value;">
                                                        <option selected value="{{ route('my-project.freelancer') }}">
                                                            Select</option>
                                                        <option value="requestPayment">Request payment</option>
                                                        <option value="{{ route('bid.show', $item->id) }}">Edit Bid
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
                        {{ $openProjects->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
