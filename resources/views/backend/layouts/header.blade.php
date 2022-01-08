<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="text-capitalize {{ isset($active) ? ($active == "dashboard" ? "active" : "" ) : ''  }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="menu-icon ti-home"></i>Dashboard </a>
                </li>
                <li class="text-capitalize {{ isset($active) ? ($active == "categories" ? "active" : "" ) : ''  }}">
                    <a href="{{ route('admin.categories.index') }}"><i class="menu-icon ti-menu"></i>Danh mục</a>
                </li>
                <li class="text-capitalize ">
                    <a href="{{ route('admin.product') }}"><i class="menu-icon ti-bag"></i>Sản phẩm</a>
                </li>
                <li class="text-capitalize ">
                    <a href="#"><i class="menu-icon ti-tag"></i>Giảm giá</a>
                </li>
                <li class="text-capitalize ">
                    <a href="#"><i class="menu-icon ti-truck"></i>Đơn hàng</a>
                </li>
                <li class="text-capitalize {{ isset($active) ? ($active == "users" ? "active" : "" ) : ''  }}">
                    <a href="#"><i class="menu-icon ti-user"></i>Khách hàng</a>
                </li>
                <li class="text-capitalize ">
                    <a href="#"><i class="menu-icon ti-marker-alt"></i>
                    Bài đăng</a>
                </li>
                <li class="{{ isset($active) ? ($active == "contacts" ? "active" : "" ) : ''  }}">
                    <a href="{{ route('admin.contacts.index') }}"><i class="menu-icon ti-info-alt"></i>
                    Thông tin</a>
                </li>
                <li class="{{ isset($active) ? ($active == "slides" ? "active" : "" ) : ''  }} text-capitalize">
                    <a href="{{ route('admin.slides.index') }}"><i class="menu-icon ti-image"></i>
                    Trình chiếu</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="./"><img src="{{ asset('backend/images/logo.png') }}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="{{ asset('backend/images/logo.png') }}" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="header-left">
                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">3</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">
                            <p class="red">You have 3 Notification</p>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>
                        </div>
                    </div>

                    <div class="dropdown for-message">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                            <span class="count bg-primary">4</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="message">
                            <p class="red">You have 4 Mails</p>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('backend/images/avatar/1.jpg') }}"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Jonathan Smith</span>
                                    <span class="time float-right">Just now</span>
                                    <p>Hello, this is an example msg</p>
                                </div>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('backend/images/avatar/2.jpg') }}"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Jack Sanders</span>
                                    <span class="time float-right">5 minutes ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </div>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('backend/images/avatar/3.jpg') }}"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Cheryl Wheeler</span>
                                    <span class="time float-right">10 minutes ago</span>
                                    <p>Hello, this is an example msg</p>
                                </div>
                            </a>
                            <a class="dropdown-item media" href="#">
                                <span class="photo media-left"><img alt="avatar" src="{{ asset('backend/images/avatar/4.jpg') }}"></span>
                                <div class="message media-body">
                                    <span class="name float-left">Rachel Santos</span>
                                    <span class="time float-right">15 minutes ago</span>
                                    <p>Lorem ipsum dolor sit amet, consectetur</p>
                                </div>
                            </a>
                        </div>
                    </div>
                

                    <div class="user-area dropdown">
                        <a href="#" class="dropdown-toggle active" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="{{ asset('backend/images/admin.jpg') }}" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="{{ route('admin.logout') }}"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>