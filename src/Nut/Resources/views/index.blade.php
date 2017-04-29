@extends('Nut::layout')

@section('title')
    Sign In
@endsection

@section('scripts')
    
    @parent
@endsection

@section('styles')

    <link rel='stylesheet' href="{{ assets('Nut::vendor/reset/reset/src/reset.css') }}">
    
    <!-- component -->
    <link rel='stylesheet' href="{{ assets('Nut::component/toggle/toggle.css') }}">


    <!-- vendor -->
    <link rel='stylesheet' href="{{ assets('Nut::vendor/bootstrap/bootstrap/src/bootstrap.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/bootstrap/bootstrap-social/bootstrap-social.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/railken/framework/src/Application/Application.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/railken/template/src/Template.css') }}">
    <link rel='stylesheet' href="{{ assets('Nut::vendor/font-awesome/font-awesome/src/css/font-awesome.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600&subset=latin-ext,cyrillic-ext' rel='stylesheet' type='text/css'>

    <link rel='stylesheet' href="{{assets('Nut::app/layout/style.css')}}">

    <link rel='stylesheet' href="{{assets('Nut::app/layout/sign-in/style.css')}}">
    <link rel='stylesheet' href="{{assets('Nut::app/layout/home/style.css')}}">


@endsection


@section('body')
    <div class="page-loader">
        <div class="loading">
            <div class="loading-spin"></div>
            <span>Loading...</span>
        </div>
    </div>

    <template data-name='nav-projects'>
        
        Projects
        <ul class='nav-list project-list'>

        {#user.projects}

            <li class='toggle {#active}active{/active} projects-element' data-status='1' data-container='projects' data-id='{id}'>
                <div data-panel='1' class='fluid fluid-vcenter'>
                    <div class="dropdown">
                        <span class="project-dropdown dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <i class='fa fa-ellipsis-h'></i>
                        </span>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#" data-open='2'>Edit project</a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#project-delete" data-modal-id="input,{id}">Delete project</a>
                            <!--
                            <form method='POST' class='projects-delete'>
                                <input type='hidden' name='id' value='{id}'>
                                <button class="dropdown-item" type='submit'>Leave project</button>
                            </form>-->
                        </div>
                    </div>
                    <div class='nav-element fluid fluid-vcenter' data-href='projects/{id}'>

                        <i class='fa fa-circle project-icon'></i>
                        <span class='fill'><span class='project-title'>{name}</span> <span class='project-tasks'>{tasks.undone}</span></span>
                    </div>
                </div>
                <div data-panel='2'>

                    <form method='POST' class='projects-edit container-actions'>
                        <input type='hidden' name='id' value='{id}'>
                        <div class='nav-element editing fluid fluid-vcenter'>

                            <i class='fa fa-circle project-icon'></i>
                            <input type='text' class='form-control' name='name' value='{name}' autocomplete='off'>
                        </div>
                        <div class='fluid fluid-vcenter bar-actions'>
                            <button data-open='1' type='submit' class='btn btn-primary'>Save changes</button>
                            <span data-open='1' class='link'>Cancel</span>
                        </div>
                    </form>
                </div>
            </li>
        {/user.projects}
        </ul>
        
    </template>
    <template data-name='layout'>@include('Nut::base')</template>
    <template data-name='sign-in'>@include('Nut::sign-in')</template>
    <template data-name='home'>@include('Nut::home')</template>
    <template data-name='project'>@include('Nut::project')</template>
@endsection

@section('scripts')
    
    <script src="{{ assets('Nut::app/layout/main.js') }}"></script>
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
    <script src="{{ assets('Nut::vendor/railken/flash/src/Flash.js') }}"></script>


    <!-- component -->
    <script src="{{ assets('Nut::component/toggle/toggle.js') }}"></script>
    <script src="{{ assets('Nut::component/modal/modal.js') }}"></script>


    <!-- core -->
    <script src="{{ assets('Nut::core/Entity/Entity.js') }}"></script>
    <script src="{{ assets('Nut::core/User/UserManager.js') }}"></script>
    <script src="{{ assets('Nut::core/User/User.js') }}"></script>
    <script src="{{ assets('Nut::core/Project/ProjectManager.js') }}"></script>
    <script src="{{ assets('Nut::core/Project/Project.js') }}"></script>
    <script src="{{ assets('Nut::core/Task/TaskManager.js') }}"></script>
    <script src="{{ assets('Nut::core/Task/Task.js') }}"></script>

    <!-- app -->
    <script src="{{ assets('Nut::app/providers/RouteServiceProvider.js') }}"></script>
    <script src="{{ assets('Nut::app/providers/AuthServiceProvider.js') }}"></script>


    <script src="{{ assets('Nut::app/resolvers/ProjectResolver.js') }}"></script>
    <script src="{{ assets('Nut::app/resolvers/TaskResolver.js') }}"></script>
    <script src="{{ assets('Nut::app/layout/sign-in/auth.js') }}"></script>
    <script src="{{ assets('Nut::app/layout/sign-in/events.js') }}"></script>
    <script src="{{ assets('Nut::app/layout/sign-in/main.js') }}"></script>
    <script src="{{ assets('Nut::app/layout/home/events.js') }}"></script>

    <script>
        var App = new Application();

        function config(name)
        {

            var configs = {
                url: "{{ env('APP_URL') }}"
            };

            return configs[name];
        }

        function reload()
        {   
            // Close all modals
            $('.modal.in').modal('hide');
            
            // Reload route
            App.get('router')._lastRouteResolved = null;
            App.get('router').resolve();

            $('.modal-backdrop.fade.in').remove();
            
        }

        $(document).ready(function(){

            App.set('api', new Api());
            App.get('api').setUrl("{{ env('APP_API_URL') }}");
            App.set('flash', new Flash());

            App.init();


            App.addListener('loaded', function() {
                toggle.reload();
            });


        });

        var LoaderServiceProvider = function() {
            this.name = 'loader';
            this.initialize = function(self, next) {

                App.get('router').resolve();
                $('.page-loader').remove();
                next();
            };
        }

        var AuthenticatedServiceProvider = function() {

            // This will handle redirect for guest user

            this.name = 'authenticated';
            this.initialize = function(self, next) {

                if (!App.get('user')) {

                    App.get('router').navigate('/sign-in');
                    

                }
                next();
            };
        };
    </script>

    <script>
        App.addProviders([
            AuthServiceProvider,
            RouteServiceProvider,
            AuthenticatedServiceProvider,
            LoaderServiceProvider,
        ]);
    </script>

@endsection