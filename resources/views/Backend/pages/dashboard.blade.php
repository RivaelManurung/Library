@extends('Backend.layouts.baselayout')
@section('content')

<body>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Books Added Per Day</h5>

                  <!-- Line Chart -->
                  <div id="lineChart" style="min-height: 400px;" class="echart"></div>

                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                              // Data from the controller
                              const bookCountsPerDay = @json($bookCountsPerDay);
          
                              const dates = bookCountsPerDay.map(item => item.date);
                              const counts = bookCountsPerDay.map(item => item.count);
          
                              echarts.init(document.querySelector("#lineChart")).setOption({
                                  xAxis: {
                                      type: 'category',
                                      data: dates
                                  },
                                  yAxis: {
                                      type: 'value'
                                  },
                                  series: [{
                                      data: counts,
                                      type: 'line',
                                      smooth: true
                                  }]
                              });
                          });
                  </script>
                  <!-- End Line Chart -->

                </div>
              </div>
            </div>


          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body pb-0">
              <h5 class="card-title">Upload Terbaru <span>| Buku</span></h5>

              <div class="news">
                @foreach($latestBooks as $book)
                <div class="post-item clearfix">
                  <img src="{{ asset('covers/' . $book->cover_path) }}" alt="{{ $book->title }}"
                    style="max-width: 50px; max-height: 50px;">
                  <h4><a href="{{ route('book.show', $book->id) }}">{{ $book->title }}</a></h4>
                  <p>{{ Str::limit($book->description, 50) }}</p>
                </div>
                @endforeach
              </div><!-- End sidebar recent posts-->
            </div>
          </div><!-- End News & Updates -->
        </div>
      </div>
    </section>
  </main><!-- End #main -->
</body>
@endsection