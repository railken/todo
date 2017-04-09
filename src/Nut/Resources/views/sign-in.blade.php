@extends('Nut::layout')

@section('title')
    Sign In
@endsection

@section('styles')

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <link href="{{assets('Nut::app/sign-in/style.css')}}" rel='stylesheet'>
@endsection


@section('body')
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="title m-b-md">
                Laravel Multi Application
            </div>

            <div class="links">
                <a href="https://github.com/railken/laravel-application">GitHub</a>
            </div>
        </div>
    </div>
@endsection