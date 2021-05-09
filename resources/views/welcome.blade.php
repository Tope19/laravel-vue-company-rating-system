@extends('layouts.app')
@section('header')
    <header class="header header-inverse bg-fixed" style="background-image: url({{asset('assets/img/bg-stars.jpg')}})" data-overlay="8">
        <div class="container text-center">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">

                    <h1>Companies</h1>
                    <p>An application for viewing companies and rating them.</p>
                </div>
            </div>

        </div>
    </header>
    <!-- END Header -->

@endsection

@section('content')
    <div class=" mb-50" >
        <main class="container-fluid">
            <br>
            <user-companies is_auth="{{!auth()->guest()}}"></user-companies>
        </main>
    </div>
@endsection
