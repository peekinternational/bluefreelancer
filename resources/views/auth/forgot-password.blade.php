@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-lg-6 py-5 bg-light mx-auto">
            <div class="col-md-8 px-0 mx-auto">
                <div class="container px-0">
                    <div class="bg-primary text-center rounded-sm p-4 my-4">
                        <h4 class="h5 text-white mb-0">Change your password</h4>
                    </div>

                    <form class="mb-4" name="" novalidate="" autocomplete="off" action="{{ route('forgot.store') }}"
                        method="post">
                        @csrf
                        <input type="hidden" name="email" value="{{request('email')}}">
                        <fieldset>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your new password" required value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary btn-block"><span
                                        class="ng-scope">Submit</span></button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection