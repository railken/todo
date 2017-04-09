@extends('Nut::layout')

@section('title')
    Sign In
@endsection

@section('scripts')
    
    @parent
@endsection

@section('styles')

    <link rel='stylesheet' href="{{ assets('Nut::vendor/reset/reset/src/reset.css') }}">
    
    <!-- vendor -->
    <link rel='stylesheet' href="{{ assets('Nut::vendor/bootstrap/bootstrap/src/bootstrap.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/bootstrap/bootstrap-social/bootstrap-social.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/railken/framework/src/Application/Application.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/railken/template/src/Template.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/font-awesome/font-awesome/src/css/font-awesome.css') }}">

    
    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Raleway:100,600">
    <link rel='stylesheet' href="{{assets('Nut::app/layout/sign-in/style.css')}}">

@endsection


@section('body')
    <div class="page-loader">
        <div class="loading">
            <div class="loading-spin"></div>
            <span>Loading...</span>
        </div>
    </div>

    <xmp type='template' name='sign-in'>@include('Nut::sign-in')</xmp>
@endsection

@section('scripts')

    <!-- vendor -->
    <script src="{{ assets('Nut::vendor/navigo/navigo/navigo.min.js') }}"></script>

    <script src="{{ assets('Nut::vendor/mustache/mustache/src/mustache.min.js') }}"></script>

    <script src="{{ assets('Nut::vendor/jquery/jquery/src/jquery.js') }}"></script>
    <script src="{{ assets('Nut::vendor/jquery/jquery/src/jquery.cookie.js') }}"></script>
    <script src="{{ assets('Nut::vendor/jquery/jquery/src/jquery-ui.js') }}"></script>
    <script src="{{ assets('Nut::vendor/bootstrap/bootstrap/src/bootstrap.js') }}"></script>
    <!--<script src="{{ assets('Nut::vendor/bootstrap/bootstrap/src/bootstrap-notify.js') }}"></script>-->
    <script src="{{ assets('Nut::vendor/railken/template/src/Template.js') }}"></script>
    <script src="{{ assets('Nut::vendor/railken/framework/src/Application/Application.js') }}"></script>
    <script src="{{ assets('Nut::vendor/railken/framework/src/Client/Api.js') }}"></script>
    <script src="{{ assets('Nut::vendor/railken/framework/src/Client/Client.js') }}"></script>
    <script src="{{ assets('Nut::vendor/railken/framework/src/Client/Cookies.js') }}"></script>
    <script src="{{ assets('Nut::vendor/railken/storage/src/CookieStorage.js') }}"></script>

    <!-- core -->
    <script src="{{ assets('Nut::core/Entity/Entity.js') }}"></script>
    <script src="{{ assets('Nut::core/User/UserManager.js') }}"></script>
    <script src="{{ assets('Nut::core/User/User.js') }}"></script>

    <!-- app -->
    <script src="{{ assets('Nut::app/providers/RouteServiceProvider.js') }}"></script>
    <script src="{{ assets('Nut::app/providers/AuthServiceProvider.js') }}"></script>


    <script>
        var App = new Application();

        $(document).ready(function(){

            App.set('api', new Api());
            App.get('api').setUrl("{{ env('APP_API_URL') }}");

            App.init();


        });

        var LoaderServiceProvider = function() {
            this.name = 'loader';
            this.initialize = function(self, next) {
                $('.page-loader').remove();
                next();
            };
        }

        var AuthenticatedServiceProvider = function() {

            // This will handle redirect for guest user
            // If a guest is still in this page (for some reason), without a token 
            // will not be able to do anything

            this.name = 'authenticated';
            this.initialize = function(self, next) {

                if (!App.get('user')) {

                    // TODO: add the login in main page
                    // For now, just redirect to home
                    console.log('to login');

                    App.get('router').navigate('/sign-in');
                } else {

                    next();
                }
            };
        };
    </script>

    <script>
        App.addProviders([
            RouteServiceProvider,
            AuthServiceProvider,
            AuthenticatedServiceProvider,
            LoaderServiceProvider,
        ]);
    </script>

@endsection