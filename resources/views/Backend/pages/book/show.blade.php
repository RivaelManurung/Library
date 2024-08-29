@extends('Backend.layouts.baselayout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('book.index') }}">Books</a></li>
                <li class="breadcrumb-item active">Details</li>
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
                        <h5 class="card-title">Title : {{ $book->title }}</h5>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Category:</strong></div>
                            <div class="col-md-9">{{ $book->category->name }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Description:</strong></div>
                            <div class="col-md-9">{{ $book->description }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Quantity:</strong></div>
                            <div class="col-md-9">{{ $book->quantity }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Cover:</strong></div>
                            <div class="col-md-9">
                                @if($book->cover_path)
                                <img src="{{ asset('covers/' . $book->cover_path) }}" alt="Cover Image" style="width: 200px; height: auto;">
                                @else
                                <img src="{{ asset('covers/default-cover.png') }}" alt="Default Cover Image" style="width: 200px; height: auto;">
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>PDF:</strong></div>
                            <div class="col-md-9">
                                @if($book->file_path)
                                <a href="{{ asset('files/' . $book->file_path) }}" class="btn btn-primary" target="_blank">View PDF</a>
                                @else
                                <button class="btn btn-secondary" disabled>No PDF</button>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3"><strong>Actions:</strong></div>
                            <div class="col-md-9">
                                <a href="{{ route('book.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('book.destroy', $book->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
