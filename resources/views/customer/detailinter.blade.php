@extends('customer.maininterface')
@section('maininter-content')
<section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('error'))
                alert("{{ session('error') }}");
            @endif
            @if (session('success'))
                alert("{{ session('success') }}");
            @endif
        });
    </script>
    @if (session()->has('addToCart'))
    <script>
    @foreach (session('addToCart') as $notification)
        toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
    @endforeach
     {{ session()->forget('addToCart') }}
    </script>
    @endif
    <form action="{{ route('addToCart') }}" method="post">
    @csrf

    <div class="detail row">
        <div class="col-6" style="display: flex">
            <div class="col-3">
                <div>
                    @if($sanpham->hinhAnhs->isNotEmpty())
                        @foreach($sanpham->hinhAnhs as $hinh)
                            <div class="thumbnail" style="margin-left: 30px" >
                                <img class="thumbnail-image" src="{{ asset('storage/images/' . $hinh->duong_dan) }}" alt="{{ $sanpham->ten_san_pham }}" onclick="changeMainImage('{{ asset('storage/images/' . $hinh->duong_dan) }}')"
                                style="height: 165px">
                            </div><br>
                        @endforeach
                    @else
                        <p>Không có hình ảnh</p>
                    @endif
                </div>
            </div>
            <div class="col-9">
                @if($sanpham->hinhAnhs->isNotEmpty())
                <input name="image" type="hidden" value="{{ $sanpham->hinhAnhs->first()->duong_dan }}">
                    <img id="mainImage" name="image" src="{{ asset('storage/images/' . $sanpham->hinhAnhs[0]->duong_dan) }}" alt="{{ $sanpham->ten_san_pham }}">
                @else
                    <p>Không có hình ảnh</p>
                @endif
                <div style="margin-left: 10px">
                    <p>{!! $sanpham->mo_ta !!}</p>
                  </div>
            </div>
            <script>
                function changeMainImage(imageSrc) {
                    document.getElementById('mainImage').src = imageSrc;
                }
            </script>
        </div>
      <div class="col-6" style="width: 100%; height: 100%;">
        <div>
          <h2 style="font-weight: bold;">{{ $sanpham->ten_san_pham }}</h2>
          <p style="font-size: 18px; font-weight: bold; color: black">Giá bán:<span style="font-size: 40px; font-weight: 900; color: red" > {{ number_format( $sanpham->gia_ban,0,'.','.') }}</span> VND</p>
          <p>
            <div  style="font-size: 20px">Màu sắc: </div><br>
            <div style="margin-left: 10px">
                @php
                $seenColors = [];
            @endphp

            @foreach ($sanpham->bienThe as $bienThe)
                @php
                    $maMauChiTiet = $bienThe->mau->ma_mau_chi_tiet;
                    $mamau = $bienThe->mau->ma_mau;
                @endphp

                @if (!in_array($maMauChiTiet, $seenColors))
                    <input name="selected_colors[]" type="checkbox" class="color-ck" value="{{ $mamau }}" style="background-color: {{ $maMauChiTiet }};"
                           onclick="selectSingleColor(this)">
                    @php
                        $seenColors[] = $maMauChiTiet;
                    @endphp
                @endif
            @endforeach
            </div>
            </p>
          <div  style="font-size: 20px">Kích thước:</div><br>
         <div style="display: flex; width: 80%; text-align: center; height: 50px; font-weight: bold;font-size: 24px;flex-wrap: wrap;
                        gap: 20px; color: #000">
                @php
                     $hasSize = false;
                    $displayedSizes = [];
                @endphp
                @foreach($sanpham->bienThe as $bienThe)
                @if ($bienThe->kichThuoc && !in_array($bienThe->kichThuoc->ma_kich_thuoc, $displayedSizes))
                    <input name="selected_size[]" type="checkbox" value="{{ $bienThe->kichThuoc->ma_kich_thuoc }}" class="size size-option"
                            onclick="selectSize(this)" id="add{{ $bienThe->kichThuoc->ma_kich_thuoc }}" style="display: none">
                    <div class="chonsize" id="chonsize{{ $bienThe->kichThuoc->ma_kich_thuoc }}" style="border: 1px solid #000; width: 100px; height: 50px;">
                        <label for="add{{ $bienThe->kichThuoc->ma_kich_thuoc }}" style="margin-top: 12px">{{ $bienThe->kichThuoc->kich_thuoc }}</label>
                    </div>
                    @php
                     $hasSize = true;
                        $displayedSizes[] = $bienThe->kichThuoc->ma_kich_thuoc;
                    @endphp
                @endif
                @endforeach
            </div>
        </div>
      <br>
        <div style="font-size: 20px">Chọn số lượng: </div><br>
            <div style="margin-left: 10px; display: flex">
                <div class="quantity buttons_added form-minimal" style="border: 2px solid black; width: 170px; height: 52px; background-color: white;">
                    <input type="button" value="-" class="minus button is-form" onclick="decreaseQuantity()">
                    <input type="number" id="quantity" step="1" min="1" max="" name="so_luong" value="1" placeholder="" inputmode="numeric" readonly>
                    <input type="button" value="+" class="plus button is-form" onclick="increaseQuantity()">
                </div>
                <div>
                    <input type="hidden" name="ma_san_pham" value="{{$bienThe->ma_san_pham}}">
                    <button type="submit" id="add-to-cart-button" onclick="addToCart()" style="border: 2px solid black; background-color: white; width: 300px; height: 52px; font-size: 20px; font-weight: bold; width: 460px;" title="Thêm vào giỏ hàng" >Thêm vào giỏ hàng
                    {{-- <input type="button" style="border: 2px solid black; background-color: white; width: 300px; height: 52px; font-size: 20px; font-weight: bold; width: 460px;" value="Thêm vào giỏ hàng" onclick="addToCart()"> --}}
                </div>
            </div>
            <br>
            <div style="margin-left: 10px">
                {{-- <form action="{{ route('buyNow') }}" method="post">
                    @csrf
                 <input type="submit" onclick="buyNow()" id="buy-now-button" style="color: white; font-weight: bolder; font-size: 26px; background: black; width: 78%; height: 52px;" value="Mua ngay">
                    <form> --}}
                </div>
        <br>
      <div>
      </div>
        </div>
      </div>
    </div>
    </form>
    <br>
    <br>

 {{-- GIỢI Ý SẢN PHẨM LIÊN QUAN     --}}
        <div style="text-align: center">
            <div class="horizontal-line">
                <hr class="line">
                <h2 style="text-transform: capitalize; font-size: 50px; font-weight: bold">Sản phẩm liên quan</h2><br>
                <hr class="line">
            </div>


            <div class="row" style="display: flex; margin: auto;">

                    <a class="left"  role="button" data-slide="prev" style="margin-top: 10%">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                @foreach ($relatedProducts as $sp)
                    <div class="col-2">
                        <!-- Hiển thị từng sản phẩm liên quan -->
                        <div class="airi-product product-wrapper">
                            <div class="product-inner">
                                <!-- Hình ảnh sản phẩm -->
                                <figure class="product-image">
                                    <div class="product-image--holder product-img thumbnail">
                                        <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}">
                                            @if ($sp->hinhAnhs->isNotEmpty())
                                                <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" style="height: 300px" alt="{{ $sp->ten_san_pham }}" class="primary-image">
                                                @if ($sp->hinhAnhs->count() > 1)
                                                    <img src="{{ asset('storage/images/' . $sp->hinhAnhs[1]->duong_dan) }}" style="height: 300px" alt="{{ $sp->ten_san_pham }}" class="secondary-image">
                                                @else
                                                    <img src="{{ asset('storage/images/' . $sp->hinhAnhs->first()->duong_dan) }}" style="height: 300px" alt="{{ $sp->ten_san_pham }}" class="secondary-image">
                                                @endif
                                            @else
                                                <img src="default_primary_image_url" alt="{{ $sp->ten_san_pham }}" class="primary-image">
                                                <img src="default_secondary_image_url" alt="{{ $sp->ten_san_pham }}" class="secondary-image">
                                            @endif
                                        </a>
                                    </div>
                                </figure>
                                <!-- Thông tin sản phẩm -->
                                <div class="product-info text-center">
                                    <h3 class="product-title popup_cart_title" style="height:42px;">
                                        <a href="{{ route('increase-view', ['ma_san_pham' => $sp->ma_san_pham]) }}">{{ $sp->ten_san_pham }}</a>
                                    </h3>
                                    <!-- Thêm các chi tiết sản phẩm (giá, đánh giá, ...) -->
                                    <div class="product-rating">
                                        <span>
                                            <span class="shopify-product-reviews-badge" data-id="{{ $sp->ma_san_pham }}"></span>
                                        </span>
                                    </div>
                                    <span>
                                        <span class="btn btn-danger" style="font-weight:bolder">{{ number_format($sp->gia_ban, 0, '.', '.') }} VNĐ</span>
                                    </span>
                                    <!-- Các đặc điểm khác của sản phẩm -->
                                    <div class="product-color-swatch product-color">
                                        <ul class="grid-color-swatch">
                                            <!-- Swatch màu sắc hoặc các tính năng khác -->
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <a class="right" role="button" data-slide="next" style="margin-top: 10%">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
    </div>
  </form>
</section>
<br><br>
<script>
// SỐ LƯỢNG
    function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            var maxQuantity = parseInt(quantityInput.max);

            if (!maxQuantity || currentQuantity < maxQuantity) {
                quantityInput.value = currentQuantity + 1;
                validateQuantity();
            }
        }

        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);

            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
                validateQuantity();
            }
        }

        function validateQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            var maxQuantity = parseInt(quantityInput.max);
            @foreach($sanpham->bienThe as $bienThe)
                var soLuongTon = parseInt('{{ $bienThe->so_luong_ton }}');
            @endforeach

            if (maxQuantity && currentQuantity > maxQuantity) {
                quantityInput.value = maxQuantity;
                currentQuantity = maxQuantity;
            }
            if (currentQuantity > soLuongTon) {
                quantityInput.value = soLuongTon;
            }
        }
// MÀU

// KÍCH THƯỚC


</script>
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

    <style>
        strong{
            font-weight:bold;
            color: black;
            font-size: 18px
        }
      </style>
      <style>
        .quantity.buttons_added {
            display: flex;
            align-items: center;
        }
        .quantity.buttons_added .button {
            width: 50px;
            height: 50px;
            text-align: center;
            background-color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
        }

        .quantity.buttons_added input[type="number"] {
            text-align: center;
            width: 70px;
            height: 50px;
            border: none;
            box-sizing: border-box;
            font-size: 18px;
            font-weight: bold;
        }
    </style>
    <style>
        .color-ck {
            width: 40px !important;
            height: 40px !important;
            border-radius: 50% !important;
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            outline: none !important;
            cursor: pointer !important;
            border: 2px solid #999 !important;
            margin: 5px !important;
        }

        .color-ck:checked {
            border-color: #000 !important; /* Màu viền khi được chọn */
        }
    </style>
    <script>
        function selectSingleColor(checkbox) {
            // Deselect all checkboxes
            const checkboxes = document.querySelectorAll('.color-ck');
            checkboxes.forEach(cb => {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
        }


    </script>






<style>
    .size {
        margin: 20px;
    }
    .box {
        width: 100px;
        height: 100px;
        background-color: white;
        border: 1px solid black;
    }
</style>

<script>
    function selectSize(checkbox) {
        var checkBoxes = document.querySelectorAll('.size-option');
        var divs = document.querySelectorAll('.chonsize');

        // Uncheck all checkboxes and reset all div styles
        checkBoxes.forEach(function(item) {
            if (item !== checkbox) {
                item.checked = false;
            }
        });
        divs.forEach(function(item) {
            item.style.backgroundColor = '';
            item.style.color = 'black'; // Reset background color
        });

        // Change background color of selected div
        if (checkbox.checked) {
            var divId = 'chonsize' + checkbox.value;
            var selectedDiv = document.getElementById(divId);
            selectedDiv.style.backgroundColor = '#000';
            selectedDiv.style.color = 'white';
        }
    }
    </script>
    {{-- <script>
        function addToCart() {
            // Kiểm tra xem đã chọn màu sắc và kích thước chưa
            var selectedColor = document.querySelector('.color-ck:checked');
            var selectedSize = document.querySelector('.size-option:checked');
            var quantity = document.getElementById('quantity').value;

            if (!selectedColor || !selectedSize || quantity <= 0) {
                alert('Vui lòng chọn màu sắc và kích thước và nhập số lượng hợp lệ.');
                return;
            }

            // Lấy giá trị của các input
            var maMau = selectedColor.value;
            var maKichThuoc = selectedSize.value;

            // Tạo object chứa thông tin sản phẩm
            var product = {
                _token: '{{ csrf_token() }}',
                ma_mau: maMau,
                ma_kich_thuoc: maKichThuoc,
                so_luong: quantity
            };

            // Submit form bằng Javascript
            var form = document.getElementById('addToCartForm');
            var formData = new FormData(form);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('ma_mau', maMau);
            formData.append('ma_kich_thuoc', maKichThuoc);
            formData.append('so_luong', quantity);

            fetch('{{ route('addToCart') }}', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Thêm sản phẩm vào giỏ hàng thất bại.');
            })
            .then(data => {
                alert(data.success_message); // Hiển thị thông báo thành công từ backend
            })
            .catch(error => {
                alert(error.message); // Hiển thị lỗi nếu có
            });
        }
    </script> --}}

<script>
    function validateSelection() {
        var selectedColors = document.querySelectorAll('input[name="selected_colors[]"]:checked');
        var selectedSizes = document.querySelectorAll('input[name="selected_size[]"]:checked');

        if (selectedColors.length === 0) {
            alert("Vui lòng chọn màu sắc.");
            return false;
        }

        if (selectedSizes.length === 0) {
            alert("Vui lòng chọn kích thước.");
            return false;
        }

        return true;
    }
    </script>
@endsection
