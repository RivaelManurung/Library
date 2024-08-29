@extends('Backend.layouts.baselayout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('admin/book') }}">Books List</a></li>
                <li class="breadcrumb-item active">Edit Book</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Book</h5>

                        <!-- Form for editing book -->
                        <form method="POST" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $book->title }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="categories_id" class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select class="form-select" id="categories_id" name="categories_id" required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $book->categories_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description" style="height: 100px" required>{{ $book->description }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $book->quantity }}" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="file_path" class="col-sm-2 col-form-label">Current PDF</label>
                                <div class="col-sm-10">
                                    @if($book->file_path)
                                        <a href="{{ asset('files/' . $book->file_path) }}" target="_blank">View Current PDF</a>
                                    @else
                                        <p>No PDF uploaded</p>
                                    @endif
                                    <label for="file_path" class="form-label">Upload New PDF (Optional)</label>
                                    <input class="form-control" type="file" id="file_path" name="file_path" accept=".pdf">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="cover_path" class="col-sm-2 col-form-label">Current Cover</label>
                                <div class="col-sm-10">
                                    @if($book->cover_path)
                                        <img src="{{ asset('covers/' . $book->cover_path) }}" alt="Current Cover Image" style="width: 200px; height: auto;">
                                    @else
                                        <p>No cover uploaded</p>
                                    @endif
                                    <label for="cover_path" class="form-label">Upload New Cover (Optional)</label>
                                    <input class="form-control" type="file" id="cover_path" name="cover_path" accept=".jpeg,.jpg,.png">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Update Book</button>
                                </div>
                            </div>
                        </form><!-- End Form -->

                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
