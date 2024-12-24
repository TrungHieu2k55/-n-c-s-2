@extends('customer.maininterface')
@section('maininter-content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
  
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{asset('assets/cdn/shop/files/juno-29193.jpg')}}" style="width: 100%; height: 600px; alt="First slide">
            <div class="carousel-caption"></div>
        </div>
        <div class="item">
            <img src="{{asset('assets/cdn/shop/files/top-thuong-hieu-thoi-trang-nu.jpg')}}" style="width: 100%; height: 600px; alt="Second slide">
            <div class="carousel-caption"></div>
        </div>
        <div class="item">
            <img src="{{asset('assets/cdn/shop/files/blog-01__7__539816a09e69446dbd11c8705f0342b3_large.jpg')}}" 
            style="width: 100%; height: 600px;" alt="Third slide">
            <div class="carousel-caption"></div>
        </div>
    </div>
  
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev" style="display: none;">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span  class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next" style="display: none;">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<br> <br>
  <section class="trending-products-area" id="section-template--14742516727872__1630312092f711827f">
    <div id="shopify-section-template--14742516727872__1630312092f711827f" class="shopify-section"><!-- Trending Products area Start Here -->
        <section class="trending-products-area" id="section-template--14742516727872__1630312092f711827f">
          <div class=" container-fluid">
            <div class="row mb--40 mb-md--30">
              <div class="col-12 text-center">
                <div class="horizontal-line">
                    <hr class="line">
                    <span class="text">{{ $title }}</span>
                    <hr class="line">
                </div>
                <br>
                <label style="font-size:20px ">{{ $title2 }}</label>
                <p class="font-size-16"></p>
                {{-- <div style="font-size: 20px; text-align: center; height: 30px;">
                    <label> {{ count($sanpham) }} sản phẩm</label>   
                </div> --}}
              </div> 
            </div>
            {{-- <div class="row"  style="text-align: right; font-size: 20px; color: black">
            <div class="col-5">
                <div class="row">
                    <div class="col-md-6">
                        <label for="maMau" style=" margin-top: 6px">Sắp xếp</label>
                    </div>
                    <div class="col-md-6" style="padding-right: 20px">
                        <select class="form-control" name="sap_xep" id="sapXep" style="border: 2px solid black; height: 40px; font-size: 16px">
                            <option value="">Mặc Định</option>
                            <option>Mới Nhất</option>
                            <option>Giá Tăng Dần</option>
                            <option>Giá Giảm Dần</option>
                            <option>Từ A-Z</option>
                            <option>Từ Z-A</option>
                        </select>
                    </div>
                </div>
            </div>
            </div> --}}
            <div class="row">
                @foreach ($sanpham as $sp)
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center mb-4">
                        <div class="airi-product product-wrapper w-100">
                            <div class="product-inner">
                                <figure class="product-image">
                                    <div class="product-image--holder product-img thumbnail">
                                        <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}">
                                            @if ($sp->hinhAnhs->isNotEmpty())
                                                <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="primary-image img-fluid" style="height: auto;">
                                                @if ($sp->hinhAnhs->count() > 1)
                                                    <img src="{{ asset('storage/images/' . $sp->hinhAnhs[1]->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="secondary-image img-fluid" style="height: auto;">
                                                @endif
                                            @else
                                                <img src="default_primary_image_url" alt="{{ $sp->ten_san_pham }}" class="primary-image img-fluid">
                                                <img src="default_secondary_image_url" alt="{{ $sp->ten_san_pham }}" class="secondary-image img-fluid">
                                            @endif
                                        </a>
                                    </div>
                                </figure>
                                <div class="product-info text-center">
                                    <h3 class="product-title popup_cart_title">
                                        <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}">{{ $sp->ten_san_pham }}</a>
                                    </h3>
                                    <div class="product-rating">
                                        <span class="shopify-product-reviews-badge" data-id="{{ $sp->ma_san_pham }}"></span>
                                    </div>
                                    <span>
                                        <span class="btn btn-danger" style="font-weight:bolder">{{ number_format($sp->gia_ban, 0, ',', '.') }} VNĐ</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div style="width: 300px; margin-left: auto;">
                @if ($title !== "Sản Phẩm Bán Chạy")
                    {{ $sanpham->links('pagination::custom') }}
                @endif
            </div>
{{--  --}}
<section id="phu" style="display: none;">
<div class="row" style="display: flex; margin: auto">
    <div class="col-12 text-center">
            <div class="horizontal-line">
                <hr class="line">
                <span class="text">Sản Phẩm Mới</span>
                <hr class="line">
            </div>
        <br><br>
      </div>
      <div class="row gx-3 gy-4">
        @foreach ($productMoi as $sp)
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <div class="airi-product product-wrapper">
                    <div class="product-inner">
                        <figure class="product-image">
                            <div class="product-image--holder product-img thumbnail">
                                <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}">
                                    @if ($sp->hinhAnhs->isNotEmpty())
                                        <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="primary-image" style="height: 300px">
                                        @if ($sp->hinhAnhs->count() > 1)
                                            <img src="{{ asset('storage/images/' . $sp->hinhAnhs[1]->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="secondary-image" style="height: 300px">
                                        @else
                                            <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="secondary-image" style="height: 300px">
                                        @endif
                                    @else
                                        <img src="default_primary_image_url" alt="{{ $sp->ten_san_pham }}" class="primary-image">
                                        <img src="default_secondary_image_url" alt="{{ $sp->ten_san_pham }}" class="secondary-image">
                                    @endif
                                </a>
                            </div>
                        </figure>
                        <div class="product-info text-center">
                            <h3 class="product-title popup_cart_title" style="height:42px;">
                                <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}">{{ $sp->ten_san_pham }}</a>
                            </h3>
                            <div class="product-rating">
                                <span>
                                    <span class="shopify-product-reviews-badge" data-id="{{ $sp->ma_san_pham }}"></span>
                                </span>
                            </div>
                            <span>
                                <span class="btn btn-danger" style="font-weight:bolder">{{ number_format($sp->gia_ban, 0, '.', '.') }} VNĐ</span>
                            </span>
                            <div class="product-color-swatch product-color">
                                <ul class="grid-color-swatch">
                                    <!-- Các mẫu màu sắc sản phẩm -->
                                </ul>
                            </div>
                        </div>
                    </div><br><br>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
</section>

{{-- SẢN PHẨM DÀNH CHO BẠN --}}
@auth
@if($suggestedProducts->isNotEmpty())
<section id="phu" style="display: block">
    <div class="row" style="display: flex; margin: auto">
        <div class="col-12 text-center">
                <div class="horizontal-line">
                    <hr class="line">
                    <span class="text">Gợi Ý Hôm Nay</span>
                    <hr class="line">    
                </div>
            <br><br>
          </div>
        @foreach ($suggestedProducts as $sp)
        <div class="col-2" >
            <div class="airi-product product-wrapper">
                <div class="product-inner">
                    <figure class="product-image">
                        <div class="product-image--holder product-img thumbnail">
                            <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}" >
                                @if ($sp->hinhAnhs->isNotEmpty())
                                    <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="primary-image" style="height: 300px">
                                    @if ($sp->hinhAnhs->count() > 1)
                                        <img src="{{ asset('storage/images/' . $sp->hinhAnhs[1]->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="secondary-image" style="height: 300px">
                                    @else
                                        <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" alt="{{ $sp->ten_san_pham }}" class="secondary-image" style="height: 300px">
                                    @endif
                                @else
                                    <img src="default_primary_image_url" alt="{{ $sp->ten_san_pham }}" class="primary-image">
                                    <img src="default_secondary_image_url" alt="{{ $sp->ten_san_pham }}" class="secondary-image">
                                @endif
                            </a>
                        </div>
                    </figure>
                    <div class="product-info text-center">
                        <h3 class="product-title popup_cart_title" style="height:42px;">
                            <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}" >{{ $sp->ten_san_pham }}</a>
                        </h3>
                        <div class="product-rating">
                            <span>
                                <span class="shopify-product-reviews-badge" data-id="{{ $sp->ma_san_pham }}"></span>
                            </span>
                        </div>
                        <span>
                            <span class="btn btn-danger" style="font-weight:bolder">{{ number_format($sp->gia_ban,0,'.','.') }} VNĐ</span>
                        </span>
                        <div class="product-color-swatch product-color">
                            <ul class="grid-color-swatch">
                                <!-- Các mẫu màu sắc sản phẩm -->
                            </ul>
                            <script>
                                //grid-color-swatch
                                $('.product-color li label').hover(function(){
                                    var variantImage = jQuery(this).parent().find('.hidden a').attr('href');
                                    jQuery(this).parents('.product-wrapper').find('.product-img > a > img').attr({ src: variantImage }); 
                                    return false;
                                });
                            </script>
                        </div>
                    </div>
                </div><br><br>
            </div>
        </div>
    @endforeach
    
    </div>
    </section>
@endif
@endauth
            <br>
            <br>
          </div>
        </section>  
      </div>
  </section>  
  <style>
    
    .horizontal-line {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .line {
            flex: 1;
            border: none;
            border-top: 1px solid black; /* Đổi màu sắc hoặc chiều dài tại đây */
            margin: 3px 10px; /* Khoảng cách giữa đường ngang và chữ */
        }

        .text {
            font-family: 'Trebuchet MS', sans-serif;
            font-size: 50px; /* Đổi kích thước font tại đây nếu cần */
            white-space: nowrap; /* Đảm bảo chữ không xuống dòng */
        }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Kiểm tra nếu có một tham số trong URL chỉ định để hiển thị phần tử #phu
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('showPhu')) {
            document.getElementById('phu').style.display = 'block';
          
        }
    });
</script>


@endsection