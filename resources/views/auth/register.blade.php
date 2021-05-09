@extends('layouts.auth')

@section('title')

    Login

@endsection

@section('content')

    <div class="card card-shadowed p-50 w-400 mb-0" style="max-width: 100%">
        <h5 class="text-uppercase text-center">Register</h5>
        <br>
        <form method="POST" action="{{ route('register') }}" class="mt-5 form-type-material">
            @csrf

            <div class="form-group">
                <input type="text" required value="{{old('name')}}" class="form-control " name="name" placeholder="Name" >
                @error('name')
                <span  class="help-block" >
                      <strong style="color: #dd4b39; font-size: 12px"><i>{{ $message }}</i></strong>
                </span>
                @enderror
            </div>

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
            <div class="form-group">
                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" placeholder="Password (confirm)">
            </div>

            <button class="btn btn-bold btn-block btn-primary" type="submit">Register</button>
        </form>

        <hr class="w-30">
        <p class="text-center text-muted fs-13 mt-10">Already have an account? <a href="{{url('/login')}}">Sign in</a></p>

    </div>


@endsection
