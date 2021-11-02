@extends('layouts.app')
@section('content')
<!-- Title -->
<div class="bg-secondary text-center bg-cover py-5"
    style="background-image: url({{url('assets/img/dashboard/banner-1.jpg')}});">
    <h1 class="h5 font-weight-bold text-white">Transaction History</h1>
</div>

<section class="container py-5 my-3 my-md-4">
    <div class="d-flex justify-content-between my-2">
        <h2 class="h4 font-weight-bold mb-3">Withdraw History</h2>
        <a href="{{ route('transaction-history.deposit') }}" class="btn btn-info">Deposit History</a>
    </div>

    {{-- <a class="pb-3 mb-3" href="#export" data-toggle="collapse">+ Export full statement file</a>

    <div class="collapse" id="export">
        <div class="card card-body mt-4">
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Please enter date in YYYY-mm-dd format">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa fa-calendar-check-o"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Please enter date in YYYY-mm-dd format">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <i class="fa fa-calendar-check-o"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <select class="custom-select">
                        <option value="pdf">PDF</option>
                        <option value="csv">CSV</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button class="btn btn-primary btn-block">Export</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="d-flex justify-content-between py-4">
        <div class="col-2 col-lg-1 px-0">
            <select class="custom-select">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>

        <button class="btn btn-primary">
            <i class="fa fa-refresh"></i>
        </button>
    </div> --}}

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-income" role="tabpanel" aria-labelledby="pills-income-tab">
            <div class="table-responsive">
                <table class="table table-striped font-size-sm">
                    <thead class="bg-white">
                        <tr>
                            <th class="text-nowrap" scope="col">Date</th>
                            <th class="text-nowrap" scope="col">Email</th>
                            <th class="text-nowrap" scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($withdrawHistory->count())
                        @foreach ($withdrawHistory as $item)
                        <tr>
                            <td>{{$item->created_at->format('M d, Y')}}</td>
                            <td>{{$item->email}}</td>
                            <td class="text-success">{{$item->amount}}</td>
                        </tr>
                        @endforeach
                        @else
                        {{__('notFound')}}
                        @endif

                    </tbody>
                </table>
            </div>

            <hr>

            {{ $withdrawHistory->links() }}
        </div>

        {{-- <div class="tab-pane fade" id="pills-expenditure" role="tabpanel" aria-labelledby="pills-expenditure-tab">
            <div class="table-responsive">
                <table class="table font-size-sm">
                    <thead class="bg-white">
                        <tr>
                            <th class="text-nowrap" scope="col">Applicant / freelancer </th>
                            <th class="text-nowrap" scope="col">Project Title</th>
                            <th class="text-nowrap" scope="col">Price</th>
                            <th class="text-nowrap" scope="col">Contents</th>
                            <th class="text-nowrap" scope="col">Situation</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <caption class="font-size-lg text-center text-danger">There is no financial status.</caption>
                </table>
            </div>

            <hr>

            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-center">
                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div> --}}
    </div>
</section>
@endsection