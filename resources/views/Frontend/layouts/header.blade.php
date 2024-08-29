<!-- Start: Header Section -->
<header id="header-v1" class="navbar-wrapper">
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
                <div class="row">
                    <div class="col-md-3">
                        <div class="navbar-header">
                            <div class="navbar-brand">
                                <h1>
                                    <a href="{{url('/user/dashboard')}}">
                                        <img src="{{asset('assets/frontend/images/libraria-logo-v1.png')}}"
                                            alt="LIBRARIA" />
                                    </a>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Header Topbar -->
                        <div class="navbar-collapse hidden-sm hidden-xs">
                            <ul class="nav navbar-nav">
                                <li class="nav-item left"><a href="{{url('/user/dashboard')}}">Home</a></li>
                                <li class="nav-item center"><a href="{{url('/user/books')}}">Books</a></li>
                                <li class="nav-item right"><a href="{{ route('user.favorites') }}">Favorite Books</a></li>
                                <li class="nav-item right"><a href="{{ url('/user/logout') }}" class="btn btn-link"><i class="fa fa-sign-out"></i> Logout</a></li>
                            </ul>
                        </div>
                        
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- End: Header Section -->
