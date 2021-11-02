@extends('layouts.app')
@section('content')
<!-- Page Content -->
<x-head-links></x-head-links>

<section class="container py-5 my-3 my-md-4">
    <h2 class="h4 font-weight-bold mb-3">Employer Financial Dasboard</h2>

    <div class="card overflow-hidden mb-5">
        <div class="card-header border-0 d-flex justify-content-between">
            <h6 class="font-weight-bold mb-0">Money Management</h6>

            <div class="d-flex">
                <a class="mx-2 bg-success text-white p-2 rounded" href="{{route('financial-dashboard.employer')}}">Employer</a>
                <a class="mx-2 p-2" href="{{route('financial-dashboard.freelancer')}}">Freelancer</a>
            </div>
        </div>
    </div>
    <table class="table font-size-sm">
        <thead class="bg-white">
            <tr>
                <th class="text-nowrap" scope="col">Project Title</th>
                <th class="text-nowrap" scope="col">Applicant/Freelancer</th>
                <th class="text-nowrap" scope="col">Amount</th>
                <th class="text-nowrap" scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($results->count())
            @foreach ($results as $item)
            <tr>
                <td class="text-nowrap">{{ App\Models\Project::where('project_id',
                    $item->milestone->project_id)->first()->title }}</td>
                <td class="text-nowrap">{{ App\Models\User::where('id', $item->to)->first()->username }}</td>
                <td class="text-nowrap">{{ $item->amt }}</td>
                <td class="text-nowrap">{{ $item->status == 1 ? 'Deposit' : 'Paid' }}</td>
            </tr>
            @endforeach
            @else
            <caption class="font-size-lg text-center text-danger">There are no milestones info to show</caption>
            @endif
        </tbody>
    </table>

    {{$results->links()}}

</section>
@endsection