@extends('Frontend.layouts.baselayout')
@section('content')

<!-- Start: Page Banner -->
<section class="page-banner services-banner"
    style="background-image: url('{{ asset('assets/frontend/images/page-banners/services-banner.jpg') }}') ">
    <div class="container">
        <div class="banner-header">
            <h2>Favorite Books</h2>
            <span class="underline center"></span>
            <p class="lead">Here are the books you've marked as favorites.</p>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ url('/user/dashboard') }}">Home</a></li>
                <li>Favorites</li>
            </ul>
        </div>
    </div>
</section>
<!-- End: Page Banner -->

<!-- Start: Favorite Books Section -->
<div id="content" class="site-content">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="books-full-width">
                <div class="container">
                    <!-- Start: Search Section -->
                    <section class="search-filters">
                        <div class="container">
                            <div class="filter-box">
                                <h3>What are you looking for at the library?</h3>
                                <form action="{{ route('user.favorites') }}" method="get">
                                    <div class="row justify-content-end">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label class="sr-only" for="keywords">Search by Keyword</label>
                                                <input class="form-control" placeholder="Search by Keyword"
                                                    id="keywords" name="keywords" type="text"
                                                    value="{{ request('keywords') }}">
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

                    <!-- Start: Books List -->
                    <div class="booksmedia-fullwidth">
                        <ul>
                            @if($favoriteBooks->isEmpty())
                            <p>No favorite books found.</p>
                            @else
                            @foreach($favoriteBooks as $book)
                            <li>
                                <figure>
                                    <a href="{{ route('books.show', $book->id) }}">
                                        <img src="{{ asset('covers/' . $book->cover_path) }}" alt="Book"
                                            style="width: 400px; height: 465px; object-fit: cover;" />
                                    </a>
                                    <figcaption>
                                        <header>
                                            <h4><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
                                            </h4>
                                          <p>
                                                <strong>Category:</strong> {{ $book->category->name }}
                                            </p>
                                          <p>
                                                <strong>Quantity:</strong> {{ $book->quantity}}
                                            </p>
                                            <p><strong>Description:</strong> {{
                                                \Illuminate\Support\Str::words($book->description, 20, '...') }}</p>
                                        </header>
                                        <div class="actions">
                                            <ul>
                                                <li>
                                                    <form action="{{ route('books.toggleFavorite', $book->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link"
                                                            title="{{ $user->favorites()->where('book_id', $book->id)->exists() ? 'Unlike' : 'Like' }}">
                                                            <i
                                                                class="fa fa-heart {{ $user->favorites()->where('book_id', $book->id)->exists() ? 'text-danger' : '' }}"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <!-- Add other actions if necessary -->
                                            </ul>
                                        </div>
                                    </figcaption>
                                </figure>
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <!-- End: Books List -->

                    <!-- Start: Pagination -->
                    <div class="pagination-container">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                @if ($favoriteBooks->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $favoriteBooks->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @endif

                                <!-- Pagination Links -->
                                @php
                                $currentPage = $favoriteBooks->currentPage();
                                $lastPage = $favoriteBooks->lastPage();
                                $range = 2; // Number of pages to show before and after the current page
                                @endphp

                                @if ($currentPage > 1 + $range)
                                <li class="page-item">
                                    <a class="page-link" href="{{ $favoriteBooks->url(1) }}">1</a>
                                </li>
                                @if ($currentPage > 2 + $range)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                                @endif
                                @endif

                                @for ($i = max(1, $currentPage - $range); $i <= min($lastPage, $currentPage + $range);
                                    $i++) <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $favoriteBooks->url($i) }}">{{ $i }}</a>
                                    </li>
                                    @endfor

                                    @if ($currentPage < $lastPage - $range) @if ($currentPage < $lastPage - 1 - $range)
                                        <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                        </li>
                                        @endif
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $favoriteBooks->url($lastPage) }}">{{
                                                $lastPage }}</a>
                                        </li>
                                        @endif

                                        <!-- Next Page Link -->
                                        @if ($favoriteBooks->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $favoriteBooks->nextPageUrl() }}"
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
                    <!-- End: Pagination -->

                </div>
            </div>
        </main>
    </div>
</div>
<!-- End: Favorite Books Section -->

@endsection