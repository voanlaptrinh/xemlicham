<nav class="navbar top-bar navbar-light border-bottom py-0 py-xl-3">
    <div class="container-fluid p-0">
        <div class="d-flex align-items-center w-100">

            <!-- Logo START -->
            <div class="d-flex align-items-center d-xl-none">
                <a class="navbar-brand" href="/">
                    <img class="light-mode-item navbar-brand-item h-30px" src="{{asset('/images/logo.jpg')}}"
                        alt="">
                    <img class="dark-mode-item navbar-brand-item h-30px" src="{{asset('/images/logo.jpg')}}"
                        alt="">
                </a>
            </div>
            <!-- Logo END -->

            <!-- Toggler for sidebar START -->
            <div class="navbar-expand-xl sidebar-offcanvas-menu">
                <button class="navbar-toggler me-auto" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-expanded="false"
                    aria-label="Toggle navigation" data-bs-auto-close="outside">
                    <i class="bi bi-text-right fa-fw h2 lh-0 mb-0 rtl-flip" data-bs-target="#offcanvasMenu">
                    </i>
                </button>
            </div>
            <!-- Toggler for sidebar END -->

            <!-- Top bar left -->
            <div class="navbar-expand-lg ms-auto ms-xl-0">

                <!-- Toggler for menubar START -->

                <!-- Toggler for menubar END -->

                <!-- Topbar menu START -->
                <div class="collapse navbar-collapse w-100" id="navbarTopContent">
                    <!-- Top search START -->
                    <div class="nav my-3 my-xl-0 flex-nowrap align-items-center">
                        <div class="nav-item w-100">
                        </div>
                    </div>
                    <!-- Top search END -->
                </div>
                <!-- Topbar menu END -->
            </div>
            <!-- Top bar left END -->

            <!-- Top bar right START -->
            <div class="ms-xl-auto">
                <ul class="navbar-nav flex-row align-items-center">
                    <li class="nav-item ms-2 ms-md-3 dropdown"> </li>


                    <!-- Profile dropdown START -->
                    <li class="nav-item ms-2 ms-md-3 dropdown">
                        <!-- Avatar -->
                        <a class="avatar avatar-sm p-0" href="#" id="profileDropdown" role="button"
                            data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="avatar-img rounded-circle"
                                src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('/images/gallery.svg') }}"
                                alt="avatar">
                        </a>

                        <!-- Profile dropdown START -->
                        <ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3"
                            aria-labelledby="profileDropdown">
                            <!-- Profile info -->
                            <li class="px-3">
                                <div class="d-flex align-items-center">
                                    <!-- Avatar -->
                                    <div class="avatar me-3 mb-3">
                                        <img class="avatar-img rounded-circle shadow"
                                            src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('/images/gallery.svg') }}"
                                            alt="avatar">
                                    </div>
                                    <div>
                                        <a class="h6 mt-2 mt-sm-0" href="#">{{ Auth::user()->name }}</a>
                                        <p class="small m-0">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <!-- Links -->
                            <li><a class="dropdown-item" href="{{ route('account.edit',  Auth::user()->id) }}"><i class="bi bi-person fa-fw me-2"></i>Edit Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item bg-danger-soft-hover" type="submit">
                                        <i class="bi bi-power fa-fw me-2"></i>
                                        Đăng xuất
                                    </button>
                                </form>
                            </li>

                            <!-- Dark mode options END-->
                        </ul>
                        <!-- Profile dropdown END -->
                    </li>
                    <!-- Profile dropdown END -->
                </ul>
            </div>
            <!-- Top bar right END -->
        </div>
    </div>
</nav>
