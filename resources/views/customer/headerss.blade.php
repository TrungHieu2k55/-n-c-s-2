
<style>
     /* Căn chỉnh dropdown khi di chuột vào biểu tượng người dùng
     .header-toolbar__item:hover .user-info-menu {
        display: block;
    } */
    /* Mega Menu cho giao diện lớn */
    .mm-text{
        display: block;
    }
    .megamenu {
        width: 900px;
        max-width: 1000px;
        margin: 0 auto;
        transform: translate(90%, 5%);
    }
    .dropdown:hover .megamenu {
        display: block;
        position: absolute;
        left: 50%;
        top: 100%;
        background-color: #fff;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        padding: 20px;
        z-index: 1000;
    }
    /* .header-fixed{
        position: fixed;
        /* top: -20px; */
    /* } */ */
    .megamenu .col-lg-3 {
        padding: 10px;
    }
    .megamenu-title {
        font-size: 18px;
        font-weight: bold;
    }
    
    /* Responsive cho màn hình nhỏ: chuyển Mega Menu thành dropdown */
    @media (max-width: 668px) {
        .navbar-brand{
            margin-bottom: 10px;
        }
        .megamenu {
            display: none;
            position: static;
            box-shadow: none;
            background-color: none;
            padding: 0;
            transform: none;
        }
        .dropdown:hover .megamenu{
            display: none;
            position: static;
            box-shadow: none;
            background-color: none;
            padding: 0;
            transform: none;
        }
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.show {
            display: block;
        }
    }
    </style>
    
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary py-5">
        <div class="container-fluid header-fixed">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets')}}/cdn/shop/files/logo/android-icon-72x72.png" alt="Logo" style="max-height: 70px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="height: 40px;width: 70px;margin-top: 30px;">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-5">
                    <li class="nav-item">
                        <a href="{{ route('maininterface', ['showPhu' => 'true']) }}" class="mainmenu__link">
                            <span class="mm-text" style="font-size: 18px">Trang Chủ</span>
                        </a>
                    </li>

                    <!-- Mega Menu Sản Phẩm -->
                    <li class="nav-item dropdown">
                        <a href="{{ route('maininterface', ['luot_xem' => 'luot_xem']) }}" class="nav-link" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="mm-text" style="font-size: 18px">Sản Phẩm</span>
                        </a>
                        <div class="dropdown-menu p-3 megamenu" aria-labelledby="productDropdown">
                            <div class="row">
                                @foreach ($rootCategories as $category)
                                    <div class="col-lg-3 col-md-6">
                                        <a href="{{ route('maininterface', $category->ma_loai) }}" class="dropdown-item megamenu-title">
                                            {{ $category->ten_loai }}
                                        </a>
                                        @if ($category->children->isNotEmpty())
                                            <ul class="list-unstyled ms-3">
                                                @foreach ($category->children as $child)
                                                    <li>
                                                        <a href="{{ route('maininterface', $child->ma_loai) }}" class="dropdown-item">
                                                            {{ $child->ten_loai }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </li>
                </ul>

                <!-- Thông tin người dùng và giỏ hàng -->
                <ul class="header-toolbar text-right mt-5">
                    <li class="header-toolbar__item user-info-menu-btn" style="font-size: 18px">
                        <a href="#">
                            <i class="fa fa-user-circle-o fa-lg"></i>
                        </a>
                        @if (Auth::guard('customers')->check())
                            <!-- Nếu đã đăng nhập -->
                            <ul class="user-info-menu" id="dadangnhap">
                                @if(session()->has('ten_khach_hang'))
                                    <li><a href="#">{{ session('ten_khach_hang') }}</a></li>
                                @endif
                                <li>
                                    <a href="{{ route('show.signup', ['ma_khach_hang' => Auth::guard('customers')->user()->ma_khach_hang]) }}">Tài khoản của bạn</a>
                                </li>
                                <li><a href="{{route('cart.index')}}">Giỏ hàng</a></li>
                                <li>
                                    <a href="{{ route('logoutcus') }}">
                                        Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        @else
                            <!-- Nếu chưa đăng nhập -->
                            <ul class="user-info-menu" id="chuadangnhap">
                                <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                <li><a href="{{ route('index.signup') }}">Đăng ký</a></li>
                            </ul>
                        @endif
                    </li>
                    <li class="header-toolbar__item">
                        <a href="{{route('cart.index')}}" class="mini-cart-btn" style="width: 50px;">
                            <i class="dl-icon-cart4 fa-lg"></i>
                            <sup class="mini-cart-count bigcounter" style="background: red; color: white">
                                @auth('customers')
                                    {{ $carts->sum('so_luong') }} <!-- Tổng số lượng sản phẩm trong giỏ hàng -->
                                @else
                                    0 <!-- Hiển thị 0 nếu không có người dùng đăng nhập -->
                                @endauth
                            </sup>
                        </a>
                    </li>
                    <li>
                        <!-- Tìm kiếm -->
                <form class="d-flex align-items-center" action="{{ route('search') }}" method="GET">
                    @csrf
                    <i class="dl-icon-search1 fa-lg mx-2" style="color: black"></i>
                    <input name="search" value="" style="width: 300px; height: 40px; font-size: 16px;" type="text" id="search-input" placeholder="Nhập sản phẩm bạn muốn tìm..." class="form-control me-2" />
                </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
