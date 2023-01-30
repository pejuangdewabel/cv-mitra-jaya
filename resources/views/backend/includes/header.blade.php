 <header id="header" class="header fixed-top d-flex align-items-center">

     <div class="d-flex align-items-center justify-content-between">
         <a href="{{ route('dashboard-karyawan') }}" class="logo d-flex align-items-center">
             <img src="{{ asset('assets/frontend/images/Logo-new/plotter.png') }}" alt="">
             <span class="d-none d-lg-block">CV MITRA JAYA</span>
         </a>
         @auth('karyawan')
             <i class="bi bi-list toggle-sidebar-btn"></i>
         @endauth
     </div><!-- End Logo -->

     <nav class="header-nav ms-auto">
         <ul class="d-flex align-items-center">

             <li class="nav-item d-block d-lg-none">
                 <a class="nav-link nav-icon search-bar-toggle " href="#">
                     <i class="bi bi-search"></i>
                 </a>
             </li><!-- End Search Icon-->

             {{-- <li class="nav-item dropdown">

                 <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                     <i class="bi bi-bell"></i>
                     <span class="badge bg-primary badge-number">4</span>
                 </a><!-- End Notification Icon -->

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                     <li class="dropdown-header">
                         You have 4 new notifications
                         <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                     </li>
                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li class="notification-item">
                         <i class="bi bi-exclamation-circle text-warning"></i>
                         <div>
                             <h4>Lorem Ipsum</h4>
                             <p>Quae dolorem earum veritatis oditseno</p>
                             <p>30 min. ago</p>
                         </div>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li class="notification-item">
                         <i class="bi bi-x-circle text-danger"></i>
                         <div>
                             <h4>Atque rerum nesciunt</h4>
                             <p>Quae dolorem earum veritatis oditseno</p>
                             <p>1 hr. ago</p>
                         </div>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li class="notification-item">
                         <i class="bi bi-check-circle text-success"></i>
                         <div>
                             <h4>Sit rerum fuga</h4>
                             <p>Quae dolorem earum veritatis oditseno</p>
                             <p>2 hrs. ago</p>
                         </div>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>

                     <li class="notification-item">
                         <i class="bi bi-info-circle text-primary"></i>
                         <div>
                             <h4>Dicta reprehenderit</h4>
                             <p>Quae dolorem earum veritatis oditseno</p>
                             <p>4 hrs. ago</p>
                         </div>
                     </li>

                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <li class="dropdown-footer">
                         <a href="#">Show all notifications</a>
                     </li>

                 </ul><!-- End Notification Dropdown Items -->

             </li><!-- End Notification Nav --> --}}

             <li class="nav-item dropdown pe-3">
                 @auth('user')
                     <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                         data-bs-toggle="dropdown">
                         <img src="{{ asset('assets/backend/img/user-default.png') }}" alt="Profile"
                             class="rounded-circle">
                         <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('user')->user()->nama }}</span>
                     </a><!-- End Profile Iamge Icon -->
                 @endauth

                 @auth('karyawan')
                     <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                         data-bs-toggle="dropdown">
                         <img src="{{ Storage::url(Auth::guard('karyawan')->user()->foto) }}" alt="Profile"
                             class="rounded-circle">
                         <span
                             class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::guard('karyawan')->user()->nama }}</span>
                     </a><!-- End Profile Iamge Icon -->
                 @endauth

                 <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                     @auth('karyawan')
                         <li class="dropdown-header">
                             <h6>{{ Auth::guard('karyawan')->user()->nama }}</h6>
                             <span>
                                 @if (Auth::guard('karyawan')->user()->level == 1)
                                     ADMIN
                                 @elseif(Auth::guard('karyawan')->user()->level == 2)
                                     OPERATOR
                                 @elseif(Auth::guard('karyawan')->user()->level == 3)
                                     PIMPINAN
                                 @endif
                             </span>
                         </li>
                     @endauth
                     @auth('user')
                         <li class="dropdown-header">
                             <h6>{{ Auth::guard('user')->user()->nama }}</h6>
                             <span>
                                 {{ Auth::guard('user')->user()->level }}
                             </span>
                         </li>
                     @endauth
                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     @auth('karyawan')
                         <li>
                             <a class="dropdown-item d-flex align-items-center" href="{{ route('setting-profile-admin') }}">
                                 <i class="bi bi-person"></i>
                                 <span>My Profile</span>
                             </a>
                         </li>
                     @endauth
                     @auth('user')
                         <li>
                             <a class="dropdown-item d-flex align-items-center" href="{{ route('dashboard-user') }}">
                                 <i class="bi bi-grid"></i>
                                 <span>Dashboard Home</span>
                             </a>
                         </li>
                         <li>
                             <a class="dropdown-item d-flex align-items-center" href="{{ route('user-setting') }}">
                                 <i class="bi bi-person"></i>
                                 <span>My Profile</span>
                             </a>
                         </li>
                     @endauth
                     <li>
                         <hr class="dropdown-divider">
                     </li>
                     <li>
                         <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                             <i class="bi bi-box-arrow-right"></i>
                             <span>Sign Out</span>
                         </a>
                     </li>

                 </ul><!-- End Profile Dropdown Items -->
             </li><!-- End Profile Nav -->
         </ul>
     </nav><!-- End Icons Navigation -->

 </header>
