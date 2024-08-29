@extends('Backend.layouts.baselayout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
                <li class="breadcrumb-item active">Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-6">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category Details</h5>

                        <!-- Display Category Details -->
                        <div class="row mb-3">
                            <label for="categoryId" class="col-sm-4 col-form-label">ID</label>
                            <div class="col-sm-8">
                                <p id="categoryId">{{ $category->id }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="categoryName" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8">
                                <p id="categoryName">{{ $category->name }}</p>
                            </div>
                        </div>

                        <!-- Action buttons -->
                        <div class="row mb-3">
                            <div class="col-sm-8 offset-sm-4">
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection
