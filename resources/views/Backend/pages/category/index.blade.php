@extends('Backend.layouts.baselayout')

@section('content')
<main id="main" class="main">

    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
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
                        <h5 class="card-title">Category Table</h5>
                        <form action="{{ route('category.index') }}" method="GET" class="d-flex mb-3">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search books"
                                value="{{ request()->query('search') }}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration + ($categories->currentPage() - 1) *
                                        $categories->perPage() }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('category.show', $category->id) }}"
                                            class="btn btn-info btn-sm">Show</a>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
                                @if ($categories->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </span>
                                </li>
                                @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @endif

                                @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                <li class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                                @endforeach

                                @if ($categories->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
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