@extends('layouts.app')
@section('content')
    <div class="bg-secondary py-4">
        <div class="container pt-2 pb-3">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <a href="/project-listing"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mt-2 mr-md-2">{{ __('browseProject') }}</a>
                <a href="/contest-listing"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('browseContest') }}</a>
                <a href="/browse/category"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('browseCategories') }}</a>
                <a href="/showcases"
                    class="btn btn-block bg-gray-800 text-white w-md-auto mr-md-2">{{ __('showcase') }}</a>
                <a href="/post-contest" class="btn btn-block btn-primary w-md-auto ml-auto">{{ __('startContest') }}</a>
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
                            <a class="nav-link py-2 " id="nav-open-tab"
                                href="{{ route('my-project.employer.open-projects') }}">{{ __('Opentab') }}</a>
                            <a class="nav-link py-2" id="nav-work-tab"
                                href="{{ route('my-project.employer.work-projects') }}">{{ __('WorkProgess') }}</a>
                            <a class="nav-link py-2" id="nav-past-project-tab"
                                href="{{ route('my-project.employer.past-projects') }}">{{ __('PastProject') }}</a>
                            <a class="nav-link py-2" id="nav-active-contest-tab"
                                href="{{ route('my-project.employer.open-contests') }}">{{ __('OpenContests') }}</a>
                            <a class="nav-link py-2 active" id="nav-past-contest-tab"
                                href="#nav-past-contest">{{ __('PrizesAwarded') }}</a>
                        </div>
                    </div>
                </div>

                <div class="row py-4 d-none d-md-flex my-3">
                    <div class="col-md-8 col-lg-10">
                        <form action="{{ route('my-project.employer.awarded-contests') }}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control"
                                    placeholder="You can find contests by their names / 이름으로 프로젝트를 찾을 수 있습니다." name="filter"
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
                                <option value="{{ route('my-project.employer.awarded-contests') }}?limit=10"
                                    @if (request('limit') == 10) selected @endif>10 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.employer.awarded-contests') }}?limit=25"
                                    @if (request('limit') == 25) selected @endif>25 Items | 아이템
                                </option>
                                <option value="{{ route('my-project.employer.awarded-contests') }}?limit=50"
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

                    <div class="tab-pane fade show active" id="nav-past-contest" role="tabpanel"
                        aria-labelledby="nav-past-contest-tab">
                        <div class="table-responsive">
                            <table class="table font-size-sm">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-nowrap" scope="col">{{ __('CONTESTNAME') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('FREELANCE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('AWARDEDENTRY') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('AWARDEDPRIZE') }}</th>
                                        <th class="text-nowrap" scope="col">{{ __('PAYMENTDATE') }}</th>
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
                                    <caption>
                                        <button class="btn btn-light btn-block">
                                            {{ __('openContestAwardedCaption') }}
                                        </button>
                                    </caption>
                                @endif
                            </table>
                        </div>
                        {{ $awardedContests->links('vendor.pagination.simple-bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
