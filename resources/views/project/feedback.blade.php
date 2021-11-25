@extends('layouts.app')
@section('content')
<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    .starrating>input {
        display: none;
    }

    .starrating>label:before {
        content: "\f005";
        /* Star */
        margin: 2px;
        font-size: 1em;
        font-family: FontAwesome;
        display: inline-block;
    }

    .starrating>label {
        color: #222222;
    }

    .starrating>input:checked~label {
        color: #ffca08;
    }

    .starrating>input:hover~label {
        color: #ffca08;
    }
</style>
<div class="card card-bordered rounded-xl m-4">
    <div class="card-body">
        <div class="container">
            <h1 class="text-center">Leave Feedback</h1>
            <h6 class="text-center">Please leave feedback and rate project. <b>(you have 14 days to do this!)</b></h6>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{route('feedback.store')}}" method="post" class="mt-4">
                @csrf
                <input type="hidden" name="project_id" value="{{ request()->route('id') }}">
                <input type="hidden" name="to" value="{{ request()->route('user') }}">
                <input type="hidden" name="type" value="{{ request()->route('type') }}">
                <div class="d-flex"></div>
                <div class="d-flex  pb-2">
                    <div class="col-3">
                        <span>Professionalism: </span>
                    </div>
                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse pl-4">
                        <input type="radio" id="prof_star5" name="prof_rating" value="5" /><label for="prof_star5"
                            title="5 star"></label>
                        <input type="radio" id="prof_star4" name="prof_rating" value="4" /><label for="prof_star4"
                            title="4 star"></label>
                        <input type="radio" id="prof_star3" name="prof_rating" value="3" /><label for="prof_star3"
                            title="3 star"></label>
                        <input type="radio" id="prof_star2" name="prof_rating" value="2" /><label for="prof_star2"
                            title="2 star"></label>
                        <input type="radio" id="prof_star1" name="prof_rating" value="1" /><label for="prof_star1"
                            title="1 star"></label>
                    </div>
                </div>
                <div class="d-flex pb-2">
                    <div class="col-3">
                        <span>Communication: </span>
                    </div>
                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse pl-4">
                        <input type="radio" id="com_star5" name="com_rating" value="5" /><label for="com_star5"
                            title="5 star"></label>
                        <input type="radio" id="com_star4" name="com_rating" value="4" /><label for="com_star4"
                            title="4 star"></label>
                        <input type="radio" id="com_star3" name="com_rating" value="3" /><label for="com_star3"
                            title="3 star"></label>
                        <input type="radio" id="com_star2" name="com_rating" value="2" /><label for="com_star2"
                            title="2 star"></label>
                        <input type="radio" id="com_star1" name="com_rating" value="1" /><label for="com_star1"
                            title="1 star"></label>
                    </div>
                </div>
                <div class="d-flex pb-2">
                    <div class="col-3">
                        <span>Payment Promptness: </span>
                    </div>
                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse pl-4">
                        <input type="radio" id="pay_star5" name="pay_rating" value="5" /><label for="pay_star5"
                            title="5 star"></label>
                        <input type="radio" id="pay_star4" name="pay_rating" value="4" /><label for="pay_star4"
                            title="4 star"></label>
                        <input type="radio" id="pay_star3" name="pay_rating" value="3" /><label for="pay_star3"
                            title="3 star"></label>
                        <input type="radio" id="pay_star2" name="pay_rating" value="2" /><label for="pay_star2"
                            title="2 star"></label>
                        <input type="radio" id="pay_star1" name="pay_rating" value="1" /><label for="pay_star1"
                            title="1 star"></label>
                    </div>
                </div>
                <div class="d-flex pb-2">
                    <div class="col-3">
                        <span>Clarity in Specification: </span>
                    </div>
                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse pl-4">
                        <input type="radio" id="clarity_star5" name="clarity_rating" value="5" /><label
                            for="clarity_star5" title="5 star"></label>
                        <input type="radio" id="clarity_star4" name="clarity_rating" value="4" /><label
                            for="clarity_star4" title="4 star"></label>
                        <input type="radio" id="clarity_star3" name="clarity_rating" value="3" /><label
                            for="clarity_star3" title="3 star"></label>
                        <input type="radio" id="clarity_star2" name="clarity_rating" value="2" /><label
                            for="clarity_star2" title="2 star"></label>
                        <input type="radio" id="clarity_star1" name="clarity_rating" value="1" /><label
                            for="clarity_star1" title="1 star"></label>
                    </div>
                </div>
                <div class="d-flex pb-2">
                    <div class="col-3">
                        <span>Would you work for the employer again?: </span>
                    </div>
                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse pl-4">
                        <input type="radio" id="emp_star5" name="emp_rating" value="5" /><label for="emp_star5"
                            title="5 star"></label>
                        <input type="radio" id="emp_star4" name="emp_rating" value="4" /><label for="emp_star4"
                            title="4 star"></label>
                        <input type="radio" id="emp_star3" name="emp_rating" value="3" /><label for="emp_star3"
                            title="3 star"></label>
                        <input type="radio" id="emp_star2" name="emp_rating" value="2" /><label for="emp_star2"
                            title="2 star"></label>
                        <input type="radio" id="emp_star1" name="emp_rating" value="1" /><label for="emp_star1"
                            title="1 star"></label>
                    </div>
                </div>
                <div class="d-flex pb-2">
                    <span class="col-3 pr-2">Project completed on time?</span>
                    <input type="checkbox" checked name="comp_time" value="1">
                </div>
                <div class="d-flex pb-2">
                    <span class="col-3 pr-2">Project completed with in Budget?</span>
                    <input type="checkbox" checked name="comp_budget" value="1">
                </div>
                <div class="d-flex pb-2">
                    <div class="col-3">
                        <textarea name="comments" id="" cols="50" rows="10" placeholder="Comments"></textarea>
                    </div>
                </div>
                <div class="d-flex pb-2">
                    <div class="col-3">
                        <input type="submit" class="btn btn-success" value="Submit">
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection