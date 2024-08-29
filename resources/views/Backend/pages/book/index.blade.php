@extends('Backend.layouts.baselayout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Books</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ Session::get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Books Table</h5>
                            <form action="{{ route('book.index') }}" method="GET" class="d-flex mb-3">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search books" value="{{ request()->query('search') }}">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                            
                            <div class="btn-group">
                                <a href="{{ url('admin/book-export') }}" class="btn btn-success">Export to Excel</a>
                                <a href="{{  url('admin/pdf-export') }}" class="btn btn-danger">Export to PDF</a>
                            </div>
                        </div>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Cover</th>
                                    <th scope="col">PDF</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <th scope="row">{{ $loop->iteration + ($books->currentPage() - 1) *
                                        $books->perPage() }}</th>
                                    <td>{{ \Illuminate\Support\Str::words($book->title, 5, '...') }}</td>
                                    <td>{{ $book->category->name }}</td>
                                    <td>{{ \Illuminate\Support\Str::words($book->description, 12, '...') }}</td>
                                    <td>{{ $book->quantity }}</td>
                                    <td>
                                        @if($book->cover_path)
                                        <img src="{{ asset('covers/' . $book->cover_path) }}" alt="Cover Image"
                                            style="width: 100px; height: auto;">
                                        @else
                                        <img src="{{ asset('covers/default-cover.png') }}" alt="Default Cover Image"
                                            style="width: 100px; height: auto;">
                                        @endif
                                    </td>
                                    <td>
                                        @if($book->file_path)
                                        <a href="{{ asset('files/' . $book->file_path) }}" class="btn btn-primary"
                                            target="_blank">View PDF</a>
                                        @else
                                        <button class="btn btn-secondary" disabled>No PDF</button>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('book.show', $book->id) }}" class="btn btn-info">Show</a>
                                        <a href="{{ route('book.update', $book->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->

                        <!-- Custom Pagination with icons -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                @if ($books->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @endif

                                @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                                <li class="page-item {{ $books->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                                @endforeach

                                @if ($books->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $books->nextPageUrl() }}" aria-label="Next">
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
                        </nav><!-- End Custom Pagination with icons -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection