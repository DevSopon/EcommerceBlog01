@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <form class="col-md-5">
                <div class="card p-4">
                    <div class="card-header text-center text-uppercase h4 font-weight-light">
                        Register
                    </div>
                    <form method="POST" action="{{ route('register') }}"> @csrf
                        <div class="card-body py-5">
                            <div class="form-group">
                                <label class="form-control-label">Name</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control {{$errors->has('name') ? 'is invalid' : ''}}">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" >
                                        <strong>{{ $errors->first ('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="text" name="email" value="{{old('email')}}" class="form-control {{$errors->has('email') ? 'is invalid' : ''}}">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" >
                                        <strong>{{ $errors->first ('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Password</label>
                                <input type="text" name="password" class="form-control {{$errors->has('password') ? 'is invalid' : ''}}">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" >
                                        <strong>{{ $errors->first ('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label class="form-control-label">Confirm Password</label>
                                <input type="text" name="confirm_password" class="form-control {{$errors->has('confirm_password') ? 'is invalid' : ''}}">

                                @if ($errors->has('confirm_password'))
                                    <span class="invalid-feedback" >
                                        <strong>{{ $errors->first ('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block">Create Account</button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
    </div>


@endsection
