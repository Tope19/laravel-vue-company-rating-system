@extends('layouts.auth')

@section('title')

    Login

@endsection

@section('content')

    <div class="card card-shadowed p-50 w-400 mb-0" style="max-width: 100%">
        <h5 class="text-uppercase text-center">Login</h5>
        <br>

        <form method="POST" action="{{ route('login') }}" class="mt-5 form-type-material">
            @csrf


            <div class="form-group">
                <input type="email" required value="{{old('email')}}" class="form-control " name="email" placeholder="Email address" >
                @error('email')
                    <span  class="help-block" >
                      <strong style="color: #dd4b39; font-size: 12px"><i>{{ $message }}</i></strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" required class="form-control " name="password" placeholder="Password" >
                @error('password')
                    <span  class="help-block" >
                      <strong style="color: #dd4b39; font-size: 12px"><i>{{ $message }}</i></strong>
                </span>
                @enderror
            </div>
            <div class="form-group flexbox py-10">
                <label class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
                    <span class="custom-control-indicator"></span>
                    <span class="custom-control-description">Remember me</span>
                </label>
            </div>

            <button class="btn btn-bold btn-block btn-primary" type="submit">Login</button>
        </form>

        <hr class="w-30">

        <p class="text-center text-muted fs-13 mt-10">Dont have an account? <a href="{{url('/register')}}">Register here</a></p>

    </div>


@endsection
