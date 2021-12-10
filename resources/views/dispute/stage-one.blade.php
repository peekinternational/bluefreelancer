@extends('layouts.app')
@section('content')
<x-head-links></x-head-links>

<!-- Title -->
<div class="bg-secondary text-center bg-cover py-5"
    style="background-image: url({{ url('assets/img/dashboard/banner-1.jpg') }});">
    <h1 class="h5 font-weight-bold text-white">Dispute</h1>
</div>

<section class="container pb-5 mt-3 mb-3 mb-md-4">
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-freelancer" role="tabpanel"
            aria-labelledby="pills-freelancer-tab">
            <div class="card rounded-xl overflow-hidden">
                <div class="card-header bg-secondary">
                    <div class="nav nav-pills nav-pills-light nav-fill flex-column flex-md-row mb-md-n2" id="nav-tabs"
                        role="tablist">
                        <a class="nav-link py-2 active" href="#">Stage One</a>
                        <a class="nav-link py-2" href="#">Stage Two</a>
                        <a class="nav-link py-2" href="#">Stage Three</a>
                        <a class="nav-link py-2" href="#">Stage Four</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        {{-- Notify --}}
        <div class="p-3 mt-4" style="background: #faff9d;border: 1px solid black;border-radius: 5px;width:100%">
            <h3><b>Stage 1 - Identify the Issue</b></h3>
            <ul>
                <li>Most disputes are the result of a simple misunderstanding.</li>
                <li>Our dispute resolution system is designed to allow both parties to resolve the issue amongst
                    themselves.</li>
                <li>Most disputes are resolved without arbitation.</li>
                <li>If an agreement cannot be reached, either party may elect to pay an arbitration fee for our dispute
                    team to resolve the matter.</li>
            </ul>
        </div>
    </div>
    <div class="d-flex">
        {{-- Main Content --}}
        <form action="{{route('dispute.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="milestone_id" value="{{ base64_decode(request()->route('milestone_id')) }}">
            <input type="hidden" name="project_id" value="{{ $project_id }}">
            <input type="hidden" name="to" value="{{ base64_decode(request()->route('to')) }}">
            <input type="hidden" name="ms_amt" value="{{ $ms_amt }}">
            <div class="d-flex my-3">
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Select type of dispute:</h5>
                </div>
                <div class="col-md-3">
                    <select name="dispute_type" id="" class="form-control">
                        <option value="">Please select a category</option>
                        <option value="Accidental Milestone Creation">Accidental Milestone Creation</option>
                        <option value="Project Deadline Issue">Project Deadline Issue</option>
                        <option value="Work Quality Issue">Work Quality Issue</option>
                        <option value="Freelancer Attitude Issue">Freelancer Attitude Issue</option>
                        <option value="Employer Is Unresponsive">Employer Is Unresponsive</option>
                        <option value="Employer Won't Release Funds">Employer Won't Release Funds</option>
                        <option value="Other">Other</option>
                    </select>
                    @error('dispute_type')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="d-flex my-3">
                <div class="col-md-3">
                    <h5 class="font-weight-bold">Project of dispute:</h5>
                </div>
                <div class="col-md-3">
                    <input type="text" name="dispute_project_name" id="" class="form-control" disabled
                        placeholder="{{ $project_name }}">
                </div>
            </div>

            <div class="d-flex my-3">
                <div class="col-md-3">
                    <h5 class="font-weight-bold">User:</h5>
                </div>
                <div class="col-md-3">
                    <input type="text" name="dispute_username" id="" class="form-control" disabled
                        placeholder="{{ $to_name }}">
                </div>
            </div>

            <div class="d-flex">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Please describe in detail what the requirements were for the milestone
                        you wish to dispute.</h5>
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="col-md-6">
                    <textarea name="dispute_req_evidence" class="form-control" id="" cols="30" rows="10"></textarea>
                    @error('dispute_req_evidence')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="d-flex">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Please describe in detail how these requirements were completed.</h5>
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="col-md-6">
                    <textarea name="dispute_req_solution" class="form-control" id="" cols="30" rows="10"></textarea>
                    @error('dispute_req_solution')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="d-flex">
                <div class="col-md-6">
                    <h5 class="font-weight-bold">Ensure that you have uploaded evidence for how milestone requirement
                        was completed. Please include evidence of how the milestone requirements were communicated.</h5>
                </div>
            </div>
            <div class="d-flex mb-3">
                <div class="col-md-6">
                    <input type="file" name="dispute_one_file">
                    <br>
                    <small class="text-danger"><b>Note:</b> You can only upload the docx, doc and zip file. And size
                        2MB</small>
                    @error('dispute_one_file')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6 amount_offer_block p-3" style="background: #c3efff">
                <div class="d-flex">
                    <h5><b>Total amount in dispute: ${{ $ms_amt }} USD</b></h5>
                </div>
                <div class="d-flex mt-4">
                    <h5><b>Offer the amount you are prepared to accept:</b></h5>
                </div>
                <div class="d-flex mb-4">
                    <span><b>$</b></span>
                    &nbsp;
                    <input type="number" name="dispute_offer_amt" style="width:20%">
                    &nbsp;
                    <span> Please enter an amount between $1 and ${{ $ms_amt }}.</span>
                </div>
                @error('dispute_offer_amt')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="d-flex mt-4">
                    <span class="text-danger"><b>Note: You may decrease the offer amount in future but not increase
                            it.</b></span>
                </div>
            </div>

            <input type="submit" class="btn btn-danger my-4" name="dispute_submit" value="Create Dispute">
        </form>
    </div>
</section>
@endsection