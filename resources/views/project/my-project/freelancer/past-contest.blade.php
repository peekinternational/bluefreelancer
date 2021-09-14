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
                            <a class="nav-link py-2" id="nav-open2-tab"
                                href="{{ route('my-project.freelancer.open-projects') }}">Open</a>
                            <a class="nav-link py-2" id="nav-work2-tab"
                                href="{{ route('my-project.freelancer.work-projects') }}">Work</a>
                            <a class="nav-link py-2" id="nav-past-project2-tab"
                                href="{{ route('my-project.freelancer.past-projects') }}">Past Project</a>
                            <a class="nav-link py-2" id="nav-active-contest2-tab"
                                href="{{ route('my-project.freelancer.active-contests') }}">Active
                                Contest</a>
                            <a class="nav-link py-2 active" id="nav-past-contest2-tab" href="#nav-past-contest2">Past
                                Contest</a>
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

                <div class="tab-content border shadow-sm" id="nav-tabsContent">
                    <div class="tab-pane fade show active" id="nav-past-contest2" role="tabpanel"
                        aria-labelledby="nav-past-contest2-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">CONTEST NAME</th>
                                        <th class="text-nowrap" scope="col">ENYRIES</th>
                                        <th class="text-nowrap" scope="col">CLIENT ID</th>
                                        <th class="text-nowrap" scope="col">WINNER</th>
                                        <th class="text-nowrap" scope="col">AWARDED PRIZE</th>
                                        <th class="text-nowrap" scope="col">TIME</th>
                                        <th class="text-nowrap" scope="col">OUTCOME</th>
                                    </tr>
                                </thead>

                                @if ($pastContest->count())
                                    <tbody>
                                        @foreach ($pastContest as $item)
                                            <tr>
                                                <td class="text-nowrap">{{ $item->contest->title }}</td>
                                                <td class="text-nowrap">{{ $item->contestEntries->count() }}</td>
                                                <td class="text-nowrap">
                                                    {{ App\Models\User::find($item->contest->user_id)->username }}
                                                </td>
                                                <td class="text-nowrap">
                                                    @foreach ($item->contestEntries as $entry)
                                                        @if ($entry->status == 2)
                                                            {{ App\Models\User::find($entry->user_id)->username }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ $item->amount }}
                                                </td>
                                                <td class="text-nowrap">
                                                    {{ $item->updated_at->format('M d, Y') }}
                                                </td>
                                                <td class="text-nowrap">
                                                    COMPLETED
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
                </div>
            </div>
        </div>
    </section>
@endsection
