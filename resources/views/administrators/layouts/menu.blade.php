<div class="crancy-smenu" id="CrancyMenu" >
    <!-- Admin Menu -->
    <div class="admin-menu" >
      <!-- Logo -->
      <div class="logo crancy-sidebar-padding pd-right-0">
        <a class="crancy-logo" href="#">
          <!-- Logo for Default -->
                                            
          @if(Auth::check())
          <span style="font-size: 30px">{{ Auth::user()->ten_nhan_vien }}</span>
      @endif
          <img
            class="crancy-logo__main--dark"
            src="{{asset('assets')}}/cdn/shop/files/logo/apple-icon-114x114.png"
            alt="#"
          />
          <!-- Logo for Dark Version -->
          <img
            class="crancy-logo__main--small"
            src="{{asset('assets')}}/img/logo-icon.png"
            alt="#"
          />
          <img
            class="crancy-logo__main--small--dark"
            src="{{asset('assets')}}/img/logo-icon-dark.html"
            alt="#"
          />
        </a>
        <div id="crancy__sicon" class="crancy__sicon close-icon">
          <img src="{{asset('assets')}}/img/arrow-icon.svg" />
        </div>
      </div>

      <!-- Main Menu -->
      <div class="admin-menu__one crancy-sidebar-padding mg-top-20">
        <h4 class="admin-menu__title">Menu</h4>
        <!-- Nav Menu -->
        <div class="menu-bar">
          <ul id="CrancyMenu" class="menu-bar__one crancy-dashboard-menu">
            <li>
              <a class="collapsed" href="{{route('index')}}"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width: 24; height: 24;">
                      <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"
                            stroke="black" stroke-width="35" fill="none"/>
                  </svg>
                  </span>
                  <span class="menu-bar__name">Trang chủ</span></span
                ></a
              >
            </li> 
            <li id="active" class="nav-item">
              <a
                class="nav-link collapsed"
                href="#"
                data-bs-toggle="collapse"
                data-bs-target="#menu-item__danhmuc"
                aria-expanded="false"
                aria-controls="menu-item__danhmuc"
              >
                <span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg
                      class="crancy-svg-icon"
                      width="20"
                      height="22"
                      viewBox="0 0 20 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M6 9H14M6 13H14M6 17H10M6 3C6 4.10457 6.89543 5 8 5H12C13.1046 5 14 4.10457 14 3M6 3C6 1.89543 6.89543 1 8 1H12C13.1046 1 14 1.89543 14 3M6 3H5C2.79086 3 1 4.79086 1 7V17C1 19.2091 2.79086 21 5 21H15C17.2091 21 19 19.2091 19 17V7C19 4.79086 17.2091 3 15 3H14"
                        stroke-width="1.5"
                        stroke-linecap="round"
                      />
                    </svg>
                  </span>
                  <span class="menu-bar__name">Danh mục</span></span>
                  <span class="crancy__toggle"></span>
                </span>
              </a>
              <div
                class="collapse crancy__dropdown"
                id="menu-item__danhmuc"
                data-bs-parent="#CrancyMenu"
              >
                <ul class="menu-bar__one-dropdown">
                  <li>
                    <a href="{{route('show.color')}}">
                      <span class="menu-bar__text">
                        <span class="menu-bar__name">Màu</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('show.size')}}">
                      <span class="menu-bar__text">
                        <span class="menu-bar__name">kích thước</span>
                      </span>
                    </a>
                  </li>
                  <li>
                    <a href="{{route('Category')}}">
                      <span class="menu-bar__text">
                        <span class="menu-bar__name">Loại sản phẩm</span>
                      </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a class="collapsed" href="{{route('show.product')}}"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 640 512"
                      fill="none"
                  >
                      <rect width="100%" height="100%" fill="white" />
                      <path
                          d="M211.8 0c7.8 0 14.3 5.7 16.7 13.2C240.8 51.9 277.1 80 320 80s79.2-28.1 91.5-66.8C413.9 5.7 420.4 0 428.2 0h12.6c22.5 0 44.2 7.9 61.5 22.3L628.5 127.4c6.6 5.5 10.7 13.5 11.4 22.1s-2.1 17.1-7.8 23.6l-56 64c-11.4 13.1-31.2 14.6-44.6 3.5L480 197.7V448c0 35.3-28.7 64-64 64H224c-35.3 0-64-28.7-64-64V197.7l-51.5 42.9c-13.3 11.1-33.1 9.6-44.6-3.5l-56-64c-5.7-6.5-8.5-15-7.8-23.6s4.8-16.6 11.4-22.1L137.7 22.3C155 7.9 176.7 0 199.2 0h12.6z"
                          stroke="black"
                          stroke-width="35"
                          fill="none"
                      />
                  </svg>
                  </span>
                  <span class="menu-bar__name">Sản phẩm</span></span
                ></a
              >
            </li> 
            <li>
              <a class="collapsed" href="{{route('show.sale')}}"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"  style="width: 24; height: 24;">
                      <path d="M0 80V229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7H48C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"
                            fill="none" stroke="black" stroke-width="35"/>
                    </svg>
                    
                  </span>
                  <span class="menu-bar__name">Khuyến mãi</span></span
                ></a
              >
            </li>
            <li>
              <a class="collapsed" href="{{route('showorder')}}"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg
                      class="crancy-svg-icon"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M20 22H5C3.34315 22 2 20.6569 2 19V5C2 3.34315 3.34315 2 5 2H15C16.6569 2 18 3.34315 18 5V8M20 22C18.8954 22 18 21.1046 18 20V8M20 22C21.1046 22 22 21.1046 22 20V10C22 8.89543 21.1046 8 20 8H18M6 7H14M6 12H14M6 17H10"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      ></path>
                    </svg>
                  </span>
                  <span class="menu-bar__name">Đơn hàng</span></span
                ></a>
            </li>
            {{-- <li>
              <a class="collapsed" href="{{route('statistical')}}"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 24; height: 24;">
                      <path d="M160 80c0-26.5 21.5-48 48-48h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H208c-26.5 0-48-21.5-48-48V80zM0 272c0-26.5 21.5-48 48-48H80c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V272zM368 96h32c26.5 0 48 21.5 48 48V432c0 26.5-21.5 48-48 48H368c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48z"
                            fill="none" stroke="black" stroke-width="35"/>
                    </svg>
                    
                    
                  </span>
                  <span class="menu-bar__name">Thống kê</span></span
                ></a
              >
            </li> --}}
{{-- danh sách nhân viên--}}
            <li>
              <a class="collapsed" href="{{route('show.employee')}}"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg  class="crancy-svg-icon" xmlns="http://www.w3.org/2000/svg" with="20" height="20"
                     viewBox="0 0 640 512"  fill="none">
                      <path d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192h42.7c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0H21.3C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7h42.7C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3H405.3zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352H378.7C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7H154.7c-14.7 0-26.7-11.9-26.7-26.7z"
                      stroke-width="35"
                      stroke-linecap="round"/>
                  </svg>  
                  </span>
                  <span class="menu-bar__name">Nhân viên</span></span
                ></a
              >
            </li>

           
          </ul>
        </div>
        <!-- End Nav Menu -->
      </div>

      <div class="crancy-sidebar-padding pd-btm-40">
        <div class="menu-bar">
          <ul class="menu-bar__one crancy-dashboard-menu" id="CrancyMenu">
            <li>
              <a href="{{ route('logout') }}" class="collapsed"
                ><span class="menu-bar__text">
                  <span class="crancy-menu-icon crancy-svg-icon__v1">
                    <svg
                      class="crancy-svg-icon"
                      xmlns="http://www.w3.org/2000/svg"
                      width="22"
                      height="18"
                      viewBox="0 0 22 18"
                      fill="none"
                    >
                      <path
                        d="M19 11L20.2929 9.70711C20.6834 9.31658 20.6834 8.68342 20.2929 8.29289L19 7"
                        stroke="#191B23"
                        stroke-width="1.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      />
                      <path
                        d="M20 9H12M5 17C2.79086 17 1 15.2091 1 13V5C1 2.79086 2.79086 1 5 1M5 17C7.20914 17 9 15.2091 9 13V5C9 2.79086 7.20914 1 5 1M5 17H13C15.2091 17 17 15.2091 17 13M5 1H13C15.2091 1 17 2.79086 17 5"
                        stroke="#191B23"
                        stroke-width="1.5"
                        stroke-linecap="round"
                      />
                    </svg>
                  </span>
                  <span class="menu-bar__name">Đăng xuất</span></span
                ></a
              >
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>