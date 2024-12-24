<style>
  .preview-image {
    width: 150px;
    height: 150px;
    object-fit: cover; /* Đảm bảo ảnh không bị méo */
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    margin-top: 10px;
}

</style>
@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
  <div class="container container__bscreen">
    <div class="row" style="display: flex">
      <div class="col-xxl-8 col-12 crancy-main__column">
        <div class="crancy-body">
          <div class="crancy-dsinner">
            @if (session()->has('flash_notification'))
            <script>
            @foreach (session('flash_notification') as $notification)
                toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
            @endforeach
             {{ session()->forget('flash_notification') }}
            </script>
        @endif
            <div class="row" style="display: flex">
              <div class="col-6 col-6 mg-top-30">
                <form role="form" method="POST" action="{{ route('update.productsp', ['ma_san_pham' => $sanpham->ma_san_pham]) }}" enctype="multipart/form-data">
                  @csrf
                  @method('PUT') 
                  <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">
                      Thông tin sản phẩm
                      <a href="#"><img src="{{asset('assets')}}/img/alert-circle.svg" /></a>
                    </h4>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Tên sản phẩm</label>
                      <input class="crancy__item-input" type="text" id="tenSanPham" name="ten_san_pham" value="{{ $sanpham->ten_san_pham }}" required />
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Loại sản phẩm</label>
                      <select id="chondanhmuc" name="ma_loai" class="form-control">
                        <option value="">Chọn loại sản phẩm</option>
                        @foreach ($danhmuc as $item)
                          <option value="{{ $item->ma_loai }}" @if($item->ma_loai == $sanpham->ma_loai) selected @endif>{{ $item->ten_loai }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Giá nhập</label>
                      <input class="crancy__item-input" type="text" id="giaNhap" name="gia_nhap" value="{{ $sanpham->gia_nhap }}" required />
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Giá bán</label>
                      <input class="crancy__item-input" type="text" id="giaBan" name="gia_ban" value="{{ $sanpham->gia_ban }}" required />
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Thương hiệu</label>
                      <input class="crancy__item-input" type="text" id="thuongHieu" name="thuong_hieu" value="{{ $sanpham->thuong_hieu }}" required />
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Chất liệu</label>
                      <input class="crancy__item-input" type="text" id="chatLieu" name="chat_lieu" value="{{ $sanpham->chat_lieu }}" required />
                    </div>
                    <div class="crancy-product-card">
                      <h4 class="crancy-product-card__title">
                        Ảnh sản phẩm
                        <a href="#"><img src="{{asset('assets')}}/img/alert-circle.svg" /></a>
                      </h4>
                      <div class="crancy-product-card__img">
    <div class="row mg-btm-20">
        <label>Ảnh sản phẩm</label>
        <input type="file" class="form-control" id="duongDan" name="duong_dan[]" required onchange="ImagesFileAsURL()"><br>
        <div id="displayImg">
            <!-- Kiểm tra nếu có hình ảnh, nếu không có hiển thị ảnh mặc định -->
            @if($hinhanh)
            <img src="{{ asset('storage/images/' . basename($hinhanh->full_path)) }}" class="preview-image" id="currentImage" alt="lỗi nè">
        @else
            <img src="{{ asset('images/default-product.jpg') }}" class="preview-image" id="currentImage" alt="lỗi cc">
        @endif
        
        </div>
    </div>
</div>
                    
                      <div class="crancy__item-form--group mg-top-25">
                        <label class="crancy__item-label crancy__item-label-product crancy-flex-between">Mô tả</label>
                         <textarea class="form-control" id="editor1" placeholder="" name="mo_ta" required="required">{{ $sanpham->mo_ta }}</textarea> 
                      </div> 
                      <div style="text-align: center;margin-top: 30px;">
                        <button type="submit" class="btn btn-primary" style="width: 150px;">Cập nhật</button>
                      </div>
                    </div>
                  </div>
                </form> 
              </div>
              <div class="col-6 col-6 mg-top-30">
                <form method="POST" action="{{ route('update.capnhatbt', ['ma_bien_the' => $bienthe->ma_bien_the]) }}" >
                  @csrf
                  @method('PUT') 
                  <div class="crancy-product-card">
                    <h4 class="crancy-product-card__title">
                      Chi tiết sản phẩm
                      <a href="#"><img src="{{asset('assets')}}/img/alert-circle.svg" /></a>
                    </h4>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Tên sản phẩm</label>
                      <input type="text" class="form-control" name="mau_sac" value="{{ $bienthe->sanPham->ten_san_pham ?? '' }}" readonly>
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Màu sắc</label>
                      <input type="text" class="form-control" name="mau_sac" value="{{ $bienthe->mau->mau ?? '' }}" readonly>
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Kích thước</label>
                      <input type="text" class="form-control" name="kich_thuoc" value="{{ $bienthe->kichThuoc->kich_thuoc ?? '' }}" readonly>
                    </div>
                    <div class="crancy__item-form--group mg-top-25">
                      <label class="crancy__item-label crancy__item-label-product">Số lượng tồn</label>
                      <input class="crancy__item-input" type="text" id="soLuongTon" name="so_luong_ton" value="{{ $bienthe->so_luong_ton }}" required />
                    </div>
                    <div class="crancy-product-card">
                      <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" style="width: 150px;">Cập nhật</button>
                      </div>
                    </div>
                  </div>
                </form> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="http://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
     <script>
         CKEDITOR.replace('editor1');
      </script>
@endsection
 <script>
  function ImagesFileAsURL() {
    var fileSelected = document.getElementById('duongDan').files;
    var displayDiv = document.getElementById('displayImg');
    
    if (fileSelected.length > 0) {
        var fileToLoad = fileSelected[0]; // Chỉ lấy ảnh đầu tiên nếu chọn nhiều
        var fileReader = new FileReader();

        fileReader.onload = function(fileLoaderEvent) {
            var srcData = fileLoaderEvent.target.result;
            var currentImage = document.getElementById('currentImage');

            if (currentImage) {
                // Nếu đã có ảnh hiển thị, thay thế ảnh
                currentImage.src = srcData;
            } else {
                // Nếu chưa có ảnh, tạo mới
                var newImage = document.createElement('img');
                newImage.src = srcData;
                newImage.classList.add('preview-image');
                newImage.id = 'currentImage';
                displayDiv.appendChild(newImage);
            }
        };

        fileReader.readAsDataURL(fileToLoad);
    }
}

 </script>