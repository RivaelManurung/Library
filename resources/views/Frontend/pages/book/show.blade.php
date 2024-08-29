@extends('Frontend.layouts.baselayout')

@section('content')

<body>
    <!-- Start: Page Banner -->
    <section class="page-banner services-banner"
        style="background-image: url('{{ asset('assets/frontend/images/page-banners/services-banner.jpg') }}') ">
        >
        <div class="container">
            <div class="banner-header">
                <h2>Books & Media Listing</h2>
                <span class="underline center"></span>
                <p class="lead">Proin ac eros pellentesque dolor pharetra tempo.</p>
            </div>
            <div class="breadcrumb">
                <ul>
                    <li><a href="{{ url('/user/dashboard') }}">Home</a></li>
                    <li>Books</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End: Page Banner -->

    <!-- Start: Products Section -->
    <div id="content" class="site-content">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="booksmedia-detail-main">
                    <div class="container">
                        <div class="row">
                            <!-- Start: Search Section -->
                            <section class="search-filters">
                                <div class="container">
                                    <div class="filter-box">
                                        <h3>What are you looking for at the library?</h3>
                                        <form action="{{ route('books.search') }}" method="get">
                                            <div class="row justify-content-end">
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="form-group">
                                                        <label class="sr-only" for="keywords">Search by Keyword</label>
                                                        <input class="form-control" placeholder="Search by Keyword"
                                                            id="keywords" name="keywords" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-6">
                                                    <div class="form-group">
                                                        <input class="form-control btn btn-primary" type="submit"
                                                            value="Search">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                            <!-- End: Search Section -->
                        </div>
                        <div class="row">
                            <div class="col-md-9 col-md-push-3">
                                <div class="booksmedia-detail-box">
                                    <div class="single-book-box">
                                        <div class="post-thumbnail">
                                            <img src="{{ asset('covers/' . $book->cover_path) }}"
                                                alt="{{ $book->title }}" class="img-fluid"
                                                style="width: 400px; height: 465px; object-fit: cover;">
                                        </div>
                                        <div class="post-detail">
                                            <div class="optional-links">
                                                <ul>
                                                    <li>
                                                        <a href="#" target="_blank" data-toggle="blog-tags"
                                                            data-placement="top" title="Like">
                                                            <i class="fa fa-heart"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <header class="entry-header">
                                                <h2 class="entry-title">{{ $book->title }}</h2>
                                                <ul>
                                                    <li>
                                                        <strong>Category:</strong> {{ $book->category->name }}
                                                    </li>
                                                    <li>
                                                        <strong>Quantity:</strong> {{ $book->quantity}}
                                                    </li>
                                                    <li><strong>Upload:</strong> {{ $book->created_at->format('F d,
                                                        Y')}} </li>
                                                </ul>
                                            </header>
                                            <div class="entry-content post-buttons">
                                                @if($book->file_path)
                                                <a href="{{ asset('files/' . $book->file_path) }}"
                                                    class="btn btn-dark-gray">Read PDF</a>
                                                @else
                                                <button class="btn btn-secondary" disabled>No PDF</button>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <p><strong>Summary:</strong> {{ $book->description }}</p>
                                </div>
                            </div>
                            <div class="col-md-3 col-md-pull-9">
                                <aside id="secondary" class="sidebar widget-area" data-accordion-group>
                                    <div class="widget widget_related_search open" data-accordion>
                                        <div class="widget-header" data-content>
                                            <h5 class="widget-sub-title" data-control>Categories</h5>
                                        </div>
                                        <div class="widget_categories" data-content>
                                            <ul>
                                                <li>
                                                    <a href="{{ route('books.index') }}">All Categories</a>
                                                </li>
                                                @foreach($categories as $category)
                                                <li>
                                                    <a
                                                        href="{{ route('books.filterByCategory', ['category' => $category->id]) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- End: Products Section -->
</body>
@endsection