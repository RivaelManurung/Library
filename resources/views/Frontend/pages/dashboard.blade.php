@extends('Frontend.layouts.baselayout')

@section('content')
<body>
<!-- Start: Slider Section -->
<div data-ride="carousel" class="carousel slide" id="home-v1-header-carousel">

    <!-- Carousel slides -->
    <div class="carousel-inner">
        @foreach (['home-v1/header-slide.jpg', 'home-v1/header-slide.jpg', 'home-v1/header-slide.jpg'] as $index => $image)
        <div class="item {{ $index === 0 ? 'active' : '' }}">
            <figure>
                <img alt="Home Slide" src="{{ asset('assets/frontend/images/header-slider/' . $image) }}" />
            </figure>
            <div class="container">
                <div class="carousel-caption">
                    <h3>Welcome to Our Digital Library</h3>
                    <h2>Powered by PHP Laravel</h2>
                    <p>Explore a world of knowledge with our digital library, built using PHP Laravel. Our platform offers a seamless and efficient way to manage and access a vast collection of books and resources online.</p>
                    <div class="slide-buttons hidden-sm hidden-xs">
                        <a href="{{url('/user/books')}}" class="btn btn-primary">Explore Books</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    

    <!-- Controls -->
    <a class="left carousel-control" href="#home-v1-header-carousel" data-slide="prev"></a>
    <a class="right carousel-control" href="#home-v1-header-carousel" data-slide="next"></a>
</div>
<!-- End: Slider Section -->

<!-- Start: Welcome Section -->
<section class="welcome-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-wrap">
                    <div class="welcome-text">
                        <h2 class="section-title">Welcome to Our Library</h2>
                        <span class="underline left"></span>
                        <p class="lead">Powered by PHP Laravel</p>
                        <p>Our library system is built using PHP Laravel, a powerful and flexible framework for web development. Laravel provides a robust set of tools and features to build modern, scalable applications with ease. From elegant routing to comprehensive ORM, Laravel helps us deliver a seamless and efficient library experience. With Laravel's built-in security, database management, and user-friendly interface, we ensure that our library services are reliable and accessible. Explore our collection and discover how Laravel enhances your library experience.</p>
                        <a class="btn btn-primary" href="{{ route('books.index') }}">See All Books</a>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</section>
<!-- End: Welcome Section -->
</body>

@endsection
