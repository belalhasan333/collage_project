<nav class="sidebar sidebar-offcanvas fixed-sidebar" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('dashboard') }}">
            <img src="{{ asset('Backend/assets/images/logo-mini.jpg') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('dashboard') }}">
            <img src="{{ asset('Backend/assets/images/logo-mini.jpg') }}" alt="logo" />
        </a>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle"
                             src="{{ Auth::check() && Auth::user()->profile_photo
                                 ? asset('storage/' . Auth::user()->profile_photo)
                                 : asset('Backend/assets/images/faces/face15.jpg') }}"
                             alt="profile">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        @auth
                            <h5 class="mb-0 font-weight-normal">{{ Auth::user()->name }}</h5>
                            <span>{{ Auth::user()->role ?? 'Gold Member' }}</span>
                        @else
                            <h5 class="mb-0 font-weight-normal">Belal Hasan</h5>
                            <span>Visitor</span>
                        @endauth
                    </div>
                </div>

                <a href="#" id="profile-dropdown" data-toggle="dropdown">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                     aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account Settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-logout text-danger"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Log Out</p>
                        </div>
                    </a>
                    <form id="logout-form" action="#" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </li>

        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-icon"><i class="mdi mdi-speedometer"></i></span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
                <span class="menu-title">Data Table</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="#">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Posts</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Posts Media</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="#">
                <span class="menu-icon"><i class="mdi mdi-playlist-play"></i></span>
                <span class="menu-title">Form Elements</span>
            </a>
        </li>

       <li class="nav-item menu-items">
             <a class="nav-link" href="#">
                 <span class="menu-icon">
                     <i class="mdi mdi-table-large"></i>
                 </span>
                 <span class="menu-title">Tables</span>
             </a>
         </li>
         <li class="nav-item menu-items">
             <a class="nav-link" href="pages/charts/chartjs.html">
                 <span class="menu-icon">
                     <i class="mdi mdi-chart-bar"></i>
                 </span>
                 <span class="menu-title">Charts</span>
             </a>
         </li>
         <li class="nav-item menu-items">
             <a class="nav-link" href="pages/icons/mdi.html">
                 <span class="menu-icon">
                     <i class="mdi mdi-contacts"></i>
                 </span>
                 <span class="menu-title">Icons</span>
             </a>
         </li>
         <li class="nav-item menu-items">
             <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                 <span class="menu-icon">
                     <i class="mdi mdi-security"></i>
                 </span>
                 <span class="menu-title">User Pages</span>
                 <i class="menu-arrow"></i>
             </a>
             <div class="collapse" id="auth">
                 <ul class="nav flex-column sub-menu">
                     <li class="nav-item"> <a class="nav-link"
                             href="#"> Blank Page </a></li>
                     <li class="nav-item"> <a class="nav-link"
                             href="#"> 404 </a></li>
                     <li class="nav-item"> <a class="nav-link"
                             href="#"> 500 </a></li>
                     <li class="nav-item"> <a class="nav-link"
                             href="{{ route('login') }}"> Login </a></li>
                     <li class="nav-item"> <a class="nav-link"
                             href="{{ route('register') }}"> Register </a></li>
                 </ul>
             </div>
         </li>
         <li class="nav-item menu-items">
             <a class="nav-link"
                 href="http://www.bootstrapdash.com/demo/corona-free/jquery/documentation/documentation.html">
                 <span class="menu-icon">
                     <i class="mdi mdi-file-document-box"></i>
                 </span>
                 <span class="menu-title">Documentation</span>
             </a>
         </li>
    </ul>
</nav>
