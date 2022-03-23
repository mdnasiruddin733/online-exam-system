<header class="topbar">
        <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
            <div class="navbar-collapse">
                <!-- ============================================================== -->
                <!-- toggle and nav items -->
                <!-- ============================================================== -->
                <ul class="navbar-nav mr-auto mt-md-0">
                    <!-- This is  -->
                    <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
   
                    <li class="nav-item hidden-sm-down">
                        <h3 class="text-white pl-3">{{config("app.name")}} </h3>
                    </li>
                </ul>

                <ul class="navbar-nav my-lg-0">

                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{asset(auth()->user()->image)}}" alt="user" class="profile-pic m-r-10" />{{auth()->user()->name}}</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>