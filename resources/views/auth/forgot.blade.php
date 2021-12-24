@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-6 py-5 bg-light mx-auto">
                <div class="col-md-8 px-0 mx-auto">
                    <div class="container px-0">
                        <div class="bg-primary text-center rounded-sm p-4 my-4">
                            <h4 class="h5 text-white mb-0">Forgot Password</h4>
                        </div>

                        <form class="mb-4" name="" novalidate="" autocomplete="off"
                            action="{{ route('forgot.email') }}" method="post">
                            @csrf
                            <fieldset>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter your Email" required value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary btn-block"><span
                                            class="ng-scope">Send Email</span></button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
