<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <meta name="turbolinks-visit-control" content="reload"> -->
        <link rel="stylesheet" href="/assets/css/flatly-bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/assets/css/prism-okaidia.css">
        <link rel="stylesheet" href="/assets/css/custom.min.css">
        <title>{{ env('APP_NAME') }}</title>
        @livewireStyles
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- <script src="/assets/jquery/dist/jquery.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="/assets/js/bootstrap.bundle.min.js"></script>
        <script src="/js/app.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('feed') }}"><img src="/assets/images/wirew_logo_white.png" alt="Site logo" width="150px"></a>
                @guest
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                @endguest
                @auth
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            <img src="/assets/images/default.png" class="border border-2 bg-light rounded-circle me-2" alt="default avatar" style="object-fit: contain;" width="40px" height="40px">
                            <span id="navbar-uname">{{ auth()->user()->uname }}</span>
                        </h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fas fa-times"></i></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <button class="btn btn-block btn-success mt-2 mb-2 rounded-0" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-feather"></i> Create</button>
                            <h6>FEED</h6>
                            <li class="nav-item">
                                <a href="{{ route('feed') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'feed') bg-info text-white @endif"><i class="fas fa-fire"></i> Hot</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('top') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'top') bg-info text-white @endif"><i class="fas fa-chart-bar"></i> Top</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('fresh') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'fresh') bg-info text-white @endif"><i class="far fa-clock"></i> Fresh</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('random') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'random') bg-info text-white @endif"><i class="fas fa-dice"></i> Random</a>
                            </li>
                            <h6>ACCOUNT</h6>
                            <li class="nav-item">
                                <a href="{{ route('profile') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'profile') bg-info text-white @endif"><i class="fas fa-user"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                @livewire('shortcuts.notification', ['is_mobile_view' => true])
                            </li>
                            <!-- <li class="nav-item">
                                <a href="./" class="nav-link p-2 text-dark"><i class="fas fa-envelope"></i> Messages</a>
                            </li> -->
                            <li class="nav-item">
                                <a href="{{ route('saved.posts') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'saved.posts') bg-info text-white @endif"><i class="fas fa-bookmark"></i> Saved</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.settings') }}" class="nav-link p-2 text-dark @if(Route::current()->getName() == 'user.settings') bg-info text-white @endif"><i class="fas fa-cog"></i> Settings</a>
                            </li>  
                       
                            @livewire('user-logout', ['is_mobile_view' => true])
                            <small class="text-secondary mt-2">
                                Developed by Odie Agnes © 2021 <br>
                                Laravel 8 · Livewire 2 · Bootstrap 5
                            </small>
                        </ul>
                        <!-- <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form> -->
                    </div>
                </div>
                @endauth
                <div class="collapse navbar-collapse" id="navbarColor01">
                    @auth()
                        @livewire('search')
                    @endauth
             
                    @guest
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    </ul>
                      
                    @endguest
                  
                    @auth
                    <div class="dropdown ms-auto d-none d-lg-block">
                        <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/assets/images/default.png" class="border border-2 bg-light rounded-circle me-2" alt="default avatar" style="object-fit: contain;" width="40px" height="40px">
                            <span id="navbar-uname">{{ auth()->user()->uname }}</span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('saved.posts') }}"><i class="fas fa-bookmark"></i> Saved</a></li>
                            <li><a class="dropdown-item" href="{{ route('user.settings') }}"><i class="fas fa-cog"></i> Settings</a></li>
                            @livewire('user-logout')
                        </ul>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        @auth()
        <div class="container">
            <div class="row">
                <div class="col-2 position-fixed px-1 d-none d-lg-block" style="width:280px;">
                    <div class="nav flex-column flex-nowrap vh-100 p-2">
                        <h6>FEED</h6>
                        <div style="font-size: 15px;">
                            <a href="{{ route('feed') }}" class="nav-link @if(Route::current()->getName() == 'feed') bg-info text-white @endif"><i class="fas fa-fire"></i> Hot</a>
                            <a href="{{ route('top') }}" class="nav-link @if(Route::current()->getName() == 'top') bg-info text-white @endif"><i class="fas fa-chart-bar"></i> Top</a>
                            <a href="{{ route('fresh') }}" class="nav-link @if(Route::current()->getName() == 'fresh') bg-info text-white @endif"><i class="far fa-clock"></i> Fresh</a>
                            <a href="{{ route('random') }}" class="nav-link @if(Route::current()->getName() == 'random') bg-info text-white @endif"><i class="fas fa-dice"></i> Random</a>
                        </div>
            
                        <h6 class="mt-2">SHORTCUTS</h6>
                        <div style="font-size: 15px;">
                            <a href="{{ route('profile') }}" class="nav-link @if(Route::current()->getName() == 'profile') bg-info text-white @endif"><i class="fas fa-user"></i> Profile</a>
                            @livewire('shortcuts.notification')
                            <!-- <a href="./" class="nav-link"><i class="fas fa-envelope"></i> Messages</a> -->
                            <a href="{{ route('saved.posts') }}" class="nav-link @if(Route::current()->getName() == 'saved.posts') bg-info text-white @endif"><i class="fas fa-bookmark"></i> Saved</a>
                            <a href="{{ route('user.settings') }}" class="nav-link @if(Route::current()->getName() == 'user.settings') bg-info text-white @endif"><i class="fas fa-cog"></i> Settings</a>
                        </div>
                        <button class="btn btn-block btn-success mt-2" data-bs-toggle="modal" data-bs-target="#createModal"><i class="fas fa-feather"></i> Create</button>
                        <small class="text-secondary mt-2">
                            Developed by Odie Agnes © 2021 <br>
                            Laravel 8 · Livewire 2 · Bootstrap 5
                        </small>
                    </div>
                </div>
                {{ $slot }}

                @if(in_array(Route::current()->getName(), ['feed', 'top', 'fresh', 'random']))
                    @livewire('people')
                @endif
            </div>
        </div>

        @livewire('post-create')
        
        @endauth

        @guest()
            {{ $slot }}
        @endguest
    

   
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" data-bs-autohide="true" aria-atomic="true">
                <div class="toast-header">
               
                <strong class="me-auto">Notification</strong>
                <!-- <small>11 mins ago</small> -->
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body" >
                    <strong id="toast-body">

                    </strong>
                </div>
            </div>
        </div>

        @auth()
        <script>
            window.addEventListener('DOMContentLoaded', function(){
                console.log('loaded!')
                Echo.private('user.' + {{ auth()->user()->id }})
                    .listen('UserUpdate', (e) => {
                        console.log(e);
                        $('#toast-body').html(e.contents);
                        var toastLiveExample = document.getElementById('liveToast')
                        var toast = new bootstrap.Toast(toastLiveExample)

                        toast.show();

                        Livewire.emitTo('shortcuts.notification', 'notif_refresh')
                    })

                
                    window.addEventListener('post-saved', event => {
                        $('#toast-body').html(event.detail.contents);
                        var toastLiveExample = document.getElementById('liveToast')
                        var toast = new bootstrap.Toast(toastLiveExample)

                        toast.show();
                    })
                
                    window.addEventListener('account-updated', event => {
                        $('#toast-body').html(event.detail.contents);
                        var toastLiveExample = document.getElementById('liveToast')
                        var toast = new bootstrap.Toast(toastLiveExample)

                        toast.show();
                        $('#navbar-uname').html(event.detail.uname);
                    })
             
                    window.addEventListener('password-updated', event => {
                        $('#toast-body').html(event.detail.contents);
                        var toastLiveExample = document.getElementById('liveToast')
                        var toast = new bootstrap.Toast(toastLiveExample)

                        toast.show();
                    })

                    window.addEventListener('post-created', event => {
                        var myModalEl = document.getElementById('createModal');
                        var modal = bootstrap.Modal.getInstance(myModalEl);
                        modal.hide();
                        // $('#createModal').dispose();
                        $('#toast-body').html(event.detail.contents);
                        var toastLiveExample = document.getElementById('liveToast')
                        var toast = new bootstrap.Toast(toastLiveExample)

                        toast.show();
                    })    
            });


        </script>
        @endauth
    
        @yield('scripts')
        
      
        @livewireScripts
    
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>
        <script>
            document.addEventListener('turbolinks:load', function() {
                var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
                var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
                    return new bootstrap.Dropdown(dropdownToggleEl)
                })
            });
        </script>
    </body>
</html>