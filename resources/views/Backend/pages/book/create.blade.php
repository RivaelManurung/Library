    @extends('Backend.layouts.baselayout')

    @section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admin/book') }}">Daftar Buku</a></li>
                    <li class="breadcrumb-item active">Tambah Buku</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Form Tambah Buku</h5>

                            <!-- Error or Success Message -->
                            @if (Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-x-circle me-1"></i>
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @elseif (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-1"></i>
                                {{ Session::get('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif

                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('book.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="title" class="col-sm-2 col-form-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="categories_id" class="col-sm-2 col-form-label">Kategori Buku</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" id="categories_id" name="categories_id" required>
                                            <option selected>Pilih Kategori</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" name="description" required style="height: 100px"></textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="quantity" class="col-sm-2 col-form-label">Jumlah</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="file" class="col-sm-2 col-form-label">Upload File Buku (PDF)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="file_path" name="file_path" accept=".pdf" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="cover" class="col-sm-2 col-form-label">Upload Cover Buku (jpeg/jpg/png)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="cover_path" name="cover_path" accept=".jpeg,.jpg,.png" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-primary">Tambah Buku</button>
                                    </div>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    @endsection
