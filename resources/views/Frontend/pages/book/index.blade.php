@extends('Frontend.layouts.baselayout')
@section('content')

<!-- Start: Page Banner -->
<section class="page-banner services-banner"
    style="background-image: url('{{ asset('assets/frontend/images/page-banners/services-banner.jpg') }}') ">
    <div class="container">
        <div class="banner-header">
            <h2>Books </h2>
            <span class="underline center"></span>
            <p class="lead">Here All The Books </p>
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
<!-- Start: Book & Media Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="books-media-list">
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
                            <div class="books-list">
                                @foreach($books as $book)
                                <article>
                                    <div class="single-book-box">
                                        <div class="post-thumbnail">
                                            <a href="{{ route('books.show', $book->id) }}">
                                                <img alt="Book" src="{{ asset('covers/' . $book->cover_path) }}"
                                                    style="width: 400px; height: 465px; object-fit: cover;" />
                                            </a>
                                        </div>
                                        <div class="post-detail">
                                            <div class="optional-links">
                                                <ul>
                                                    <li>
                                                        <form action="{{ route('books.toggleFavorite', $book->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-link"
                                                                title="{{ $user->favorites()->where('book_id', $book->id)->exists() ? 'Unlike' : 'Like' }}">
                                                                <i
                                                                    class="fa fa-heart {{ $user->favorites()->where('book_id', $book->id)->exists() ? 'text-danger' : '' }} fa-2x"></i>
                                                            </button>
                                                        </form>

                                                    </li>
                                                </ul>

                                            </div>
                                            <header class="entry-header">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h3 class="entry-title">
                                                            <a href="{{ route('books.show', $book->id) }}">{{
                                                                $book->title }}</a>
                                                        </h3>
                                                        <ul>
                                                            <li>
                                                                <strong>Category:</strong> {{ $book->category->name }}
                                                            </li>
                                                            <li>
                                                                <strong>Quantity:</strong> {{ $book->quantity}}
                                                            </li>
                                                            <li><strong>Upload:</strong> {{ $book->created_at->format('F
                                                                d,
                                                                Y')}} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </header>
                                            <div class="entry-content">
                                                <p>{{ \Illuminate\Support\Str::words($book->description, 20, '...') }}
                                                </p>
                                            </div>
                                            <footer class="entry-footer">
                                                <a class="btn btn-dark-gray"
                                                    href="{{ route('books.show', $book->id) }}">Read More</a>
                                            </footer>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </article>
                                @endforeach
                            </div>
                            <div class="pagination-container">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination">
                                        <!-- Previous Page Link -->
                                        @if ($books->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link" aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </span>
                                        </li>
                                        @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->previousPageUrl() }}"
                                                aria-label="Previous">
                                                <span aria-hidden="true">&laquo;</span>
                                            </a>
                                        </li>
                                        @endif

                                        <!-- Pagination Links -->
                                        @php
                                        $currentPage = $books->currentPage();
                                        $lastPage = $books->lastPage();
                                        $range = 2; // Number of pages to show before and after the current page
                                        @endphp

                                        @if ($currentPage > 1 + $range)
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $books->url(1) }}">1</a>
                                        </li>
                                        @if ($currentPage > 2 + $range)
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                        @endif
                                        @endif

                                        @for ($i = max(1, $currentPage - $range); $i <= min($lastPage, $currentPage +
                                            $range); $i++) <li
                                            class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $books->url($i) }}">{{ $i }}</a>
                                            </li>
                                            @endfor

                                            @if ($currentPage < $lastPage - $range) @if ($currentPage < $lastPage - 1 -
                                                $range) <li class="page-item disabled">
                                                <span class="page-link">...</span>
                                                </li>
                                                @endif
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $books->url($lastPage) }}">{{
                                                        $lastPage }}</a>
                                                </li>
                                                @endif

                                                <!-- Next Page Link -->
                                                @if ($books->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $books->nextPageUrl() }}"
                                                        aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                                @else
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </span>
                                                </li>
                                                @endif
                                    </ul>
                                </nav>
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
<!-- End: Books & Media Section -->
@endsection