<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin/dashboard')}}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <!--  Category Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#category-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="category-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url ('/admin/category')}}">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{url ('/admin/category/create')}}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Caregory Nav -->


        <!--  Book Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#book-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Book</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="book-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{url ('/admin/book')}}">
                        <i class="bi bi-circle"></i><span>Book</span>
                    </a>
                </li>
                <li>
                    <a href="{{url ('/admin/book/create')}}">
                        <i class="bi bi-circle"></i><span>Create</span>
                    </a>
                </li>
                

            </ul>
        </li>
        <!-- End Book Nav -->
    </ul>

</aside><!-- End Sidebar-->