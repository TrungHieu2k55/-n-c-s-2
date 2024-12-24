<!DOCTYPE html>
<html class="no-js" lang="zxx">
  
<!-- Mirrored from zomur.vercel.app/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 May 2024 08:18:39 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Site keywords here" />
    <meta name="description" content="#" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Site Title -->
    <title>Zomur - Modern Bootstrap Dashboard Template</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{asset('assets')}}/img/favicon.png" />

    <!--  Stylesheet -->
    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/slick.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/font-awesome-all.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/charts.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/datatables.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/fancy-box.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/nice-select.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/pikaday.min.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/css/reset.css" />
    <link rel="stylesheet" href="{{asset('assets')}}/style.css" />

    <style>
      .crancy-wc__form-input[type="radio"] {
          transform: scale(0.5);
          margin-right: 5px;
      }
  </style>
  </head>
  <body id="crancy-dark-light">
    <div class="body-bg">
      <section class="crancy-wc crancy-wc__full crancy-bg-cover">
        @if(session('success'))
            <div id="success" class="alert alert-success">{{ session('success') }}</div>
            <script>
                var dangtc = document.getElementById("success");
                setTimeout(function () {
                        // Ẩn thông báo sau 2 giây
                        dangtc.style.display = 'none';
                    }, 5000);
            </script>
        @endif
        {{-- <div class="crancy-wc__form">
          <!-- Welcome Banner -->
          <div class="crancy-wc__form--middle"> --}}
            <div class="crancy-wc__form-inner">
              <div class="crancy-wc__logo">
                <a href="index.html"><img src="{{asset('assets')}}/img/logo.png" alt="#" /></a>
              </div>
              <div class="crancy-wc__form-inside">
                <div class="crancy-wc__form-middle">
                  <div class="crancy-wc__form-top">
                    <div class="crancy-wc__heading pd-btm-20">
                      <h3
                        class="crancy-wc__form-title crancy-wc__form-title__one m-0" style="text-align: center"
                      >
                        ĐĂNG KÝ TÀI KHOẢN
                      </h3>
                    </div>
                    <!-- Sign in Form -->
                    <form
                      class="crancy-wc__form-main"
                      action="{{ route('store.employee') }}"
                      method="post"
                    >
                    @csrf
                      <div class="row">
                       
                        <div class="col-12">
                            <!-- Form Group -->
                            <div class="form-group">
                              <div class="form-group__input">
                                <input
                                  class="crancy-wc__form-input"
                                  type="text"
                                  name="ten_nhan_vien"
                                  placeholder="Họ tên"
                                  required="required"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <!-- Form Group -->
                            <div class="form-group">
                              <div class="form-group__input">
                                <input
                                  class="crancy-wc__form-input"
                                  type="date"
                                  name="ngay_sinh"
                                  placeholder="ngày sinh"
                                  required="required"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-12" style="display: flex">
                            <!-- Form Group -->
                            <div class="form-group col-6" style="display: flex">
                                <div class="form-group__input col-3">
                                    <input class="crancy-wc__form-input" type="radio" name="gioi_tinh" value="Nam" required="required" />
                                    
                                </div>
                                <div class="col-3" style="margin-top: 20px">
                                  <label> Nam</label>
                                </div>
                            </div>
                            <div class="form-group col-6" style="display: flex">
                                <div class="form-group__input col-3">
                                    <input class="crancy-wc__form-input" type="radio" name="gioi_tinh" value="Nữ" required="required" />
                                </div>
                                <div class="col-3" style="margin-top: 20px">
                                  <label> Nữ</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <!-- Form Group -->
                        
                        </div>
                          <div class="col-12">
                            <!-- Form Group -->
  
                            <div class="form-group">
                              <div class="form-group__input">
                                <input
                                  class="crancy-wc__form-input"
                                  type="tel"
                                  name="so_dien_thoai"
                                  placeholder="số điện thoại"
                                  required="required"
                                />
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <!-- Form Group -->
                            <div class="form-group">
                              <div class="form-group__input">
                                <input
                                  class="crancy-wc__form-input"
                                  type="text"
                                  name="dia_chi"
                                  placeholder="Địa chỉ"
                                  required="required"
                                />
                              </div>
                            </div>
                          </div>
                        <div class="col-12">
                          <!-- Form Group -->

                          <div class="form-group">
                            <div class="form-group__input">
                              <input
                                class="crancy-wc__form-input"
                                type="email"
                                name="email"
                                placeholder="Email"
                                required="required"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <!-- Form Group -->

                          <div class="form-group">
                            <div class="form-group__input">
                              <input
                                class="crancy-wc__form-input"
                                placeholder="Password"
                                id="password-field"
                                type="password"
                                name="mat_khau"
                                maxlength="16"
                                required="required"
                              />
                              <span class="crancy-wc__toggle"
                                ><i class="fas fa-eye" id="toggle-icon"></i
                              ></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                            <!-- Form Group -->
                            <div class="form-group">
                                <label class="input-label" for="role_id">Chọn danh mục</label>
                                <select name="role_id" multiple required>
                                    @foreach ($vt as $item)
                                        <option value="{{ $item->ma_vai_tro }}">{{ $item->ten_vai_tro }}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                      </div>
                      <!-- Form Group -->
                      <div class="form-group mg-top-30">
                        <div class="crancy-wc__button">
                          <button class="ntfmax-wc__btn" type="submit">
                            TẠO
                          </button>
                        </div>
                      </div>
                      <!-- Form Group -->
                    </form>
                    <!-- End Sign in Form -->
                  </div>
                  <!-- Footer Top -->
                  <div class="crancy-wc__footer--top">
                    <p class="crancy-wc__footer--copyright">
                      @ 2023 <a href="#">Zomur.</a> All Right Reserved.
                    </p>
                  </div>
                  <!-- End Footer Top -->
                </div>
              </div>
            </div>
      </section>
    </div>

    <!--  Scripts -->
    <script src="{{asset('assets')}}/js/jquery.min.js"></script>
    <script src="{{asset('assets')}}/js/jquery-migrate.js"></script>
    <script src="{{asset('assets')}}/js/popper.min.js"></script>
    <script src="{{asset('assets')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('assets')}}/js/slick.min.js"></script>
    <script src="{{asset('assets')}}/js/charts.js"></script>
    <script src="{{asset('assets')}}/js/final-countdown.min.js"></script>
    <script src="{{asset('assets')}}/js/fancy-box.min.js"></script>
    <script src="{{asset('assets')}}/js/fullcalendar.min.js"></script>
    <!-- <script src="/js/datatables.min.js"></script> -->
    <script src="{{asset('assets')}}/js/circle-progress.min.js"></script>
    <script src="{{asset('assets')}}/js/nice-select.min.js"></script>
    <script src="{{asset('assets')}}/js/pikaday.min.js"></script>
    <script src="{{asset('assets')}}/js/main.js"></script>

    <script>
      var crancyWCSlider = jQuery(".crancy-wc__slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        fade: true,
        infinite: true,
        arrows: false,
        speed: 300,
        slidesToShow: 1,
        adaptiveHeight: true,
      });
    </script>
  </body>
</html>
