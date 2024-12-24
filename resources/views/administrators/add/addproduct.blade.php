<!DOCTYPE html>
<style>
    #displayImg {
    margin-top: 5px;
    display: flex;
    flex-wrap: wrap; /* Tự động xuống dòng nếu không đủ chỗ */
    gap: 10px; /* Khoảng cách giữa các ảnh */
}

.preview-image {
    width: 150px; /* Chiều rộng cố định */
    height: 150px; /* Chiều cao cố định */
    object-fit: cover; /* Đảm bảo ảnh khớp khung và giữ tỉ lệ */
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

</style>
@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
  <div class="container container__bscreen">
      <div class="row" style="display: flex" >
          <div class="col-xxl-8 col-12 crancy-main__column">
              <div class="crancy-body">
                  <div class="crancy-dsinner">
                    {{-- @php
                    Log::info('Session Data:', session()->all());    
                    @endphp --}}
                
                    @if (session()->has('flash_notification'))
                        <script>
                        @foreach (session('flash_notification') as $notification)
                            toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
                        @endforeach
                         {{ session()->forget('flash_notification') }}
                        </script>
                    @endif
                          <div class="row" style="display: flex">
                              <div class="col-6 col-6 mg-top-30"  >
                                <form role="form" method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data"  onsubmit="return validateForm()">
                                @csrf
                                  <div class="crancy-promoduct-card">
                                      <h4 class="crancy-product-card__title">
                                          Thông tin sản phẩm
                                          <a href="#"><img src="{{asset('assets')}}/img/alert-circle.svg" /></a>
                                      </h4>
                                      <div class="crancy__item-form--group mg-top-25">
                                          <label class="crancy__item-label crancy__item-label-product">Tên sản phẩm</label>
                                          <input class="crancy__item-input" type="text" id="tenSanPham" name="ten_san_pham" required />
                                      </div>
                                      <div class="crancy__item-form--group mg-top-25">
                                          <label class="crancy__item-label crancy__item-label-product">Loại sản phẩm</label>
                                          <select id="chondanhmuc" name="ma_loai" class="form-control">
                                              <option value="">Chọn loại sản phẩm</option>
                                              @php
                                              function renderCategoryOptions($categories, $level = 0) {
                                                  foreach ($categories as $item) {
                                                      echo '<option value="' . $item->ma_loai . '">' . str_repeat('-', $level) . ' ' . $item->ten_loai . '</option>';
                                                      if ($item->children->isNotEmpty()) {
                                                          renderCategoryOptions($item->children, $level + 1);
                                                      }
                                                  }
                                              }
                                              renderCategoryOptions($danhmuc);
                                              @endphp
                                          </select>
                                      </div>
                                      <div class="crancy__item-form--group mg-top-25">
                                          <label class="crancy__item-label crancy__item-label-product">Giá nhập</label>
                                          <input class="crancy__item-input" type="text" id="giaNhap" name="gia_nhap" required />
                                      </div>
                                      <div class="crancy__item-form--group mg-top-25">
                                          <label class="crancy__item-label crancy__item-label-product">Giá bán</label>
                                          <input class="crancy__item-input" type="text" id="giaBan" name="gia_ban" required />
                                      </div>
                                      <div class="crancy__item-form--group mg-top-25">
                                          <label class="crancy__item-label crancy__item-label-product">Thương hiệu</label>
                                          <input class="crancy__item-input" type="text" id="thuongHieu" name="thuong_hieu" required />
                                      </div>
                                      <div class="crancy__item-form--group mg-top-25">
                                          <label class="crancy__item-label crancy__item-label-product">Chất liệu</label>
                                          <input class="crancy__item-input" type="text" id="chatLieu" name="chat_lieu" required />
                                      </div>
                                      <div class="crancy-product-card">
                                        <h4 class="crancy-product-card__title">
                                            Ảnh sản phẩm
                                            <a href="#"><img src="{{asset('assets')}}/img/alert-circle.svg" /></a>
                                        </h4>
                                        <div class="crancy-product-card__img">
                                            <div class="row mg-btm-20">
                                                <label>Ảnh sản phẩm</label>
                                                <input type="file" class="form-control" id="duongDan" name="duong_dan[]" multiple required onchange="ImagesFileAsURL()"><br>
                                                <div id="displayImg"></div>
                                            </div>
                                        </div>
                                            <div >
                                                <label class="crancy__item-label crancy__item-label-product crancy-flex-between">Mô tả</label>
                                                <textarea class="ckeditor2" id="editor1" placeholder="Nhập vào"  name="mo_ta"></textarea>
                                            </div>  
                                      <br>
                                      <div style="text-align: center;">
                                          <button type="submit" class="btn btn-primary" style="width: 150px;">Thêm mới</button>
                                      </div>
                                    </div>
                                  </div>
                                 </form> 
                              </div>
                              <div class="col-6 col-6 mg-top-30">
                                <form role="form" method="POST" action="{{ route('create.productBT') }}" enctype="multipart/form-data">
                                    @csrf
                                <div class="crancy-product-card" >
                                    <h4 class="crancy-product-card__title">
                                        Chi tiết
                                        <a href="#"><img src="{{asset('assets')}}/img/alert-circle.svg" /></a>
                                    </h4>
                                    <div class="crancy__item-form--group mg-top-25">
                                        <label class="crancy__item-label crancy__item-label-product crancy-flex-between">Sản phẩm
                                           
                                        </label>
                                        <div class="row" style="display: flex">
                                            <div class="form-group col-6">
                                                <label for="ma_mau">Sản phẩm</label>
                                                <input list="browsers" name="ten_san_pham" id="browser">
                                                <datalist id="browsers">
                                                    @foreach ($sanpham as $sp)
                                                    <option value="{{ $sp->ten_san_pham }}"></option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="crancy__item-form--group mg-top-25">
                                        <label class="crancy__item-label crancy__item-label-product crancy-flex-between">Màu sản phẩm
                                            
                                        </label>
                                        <div class="row" style="display: flex">
                                            <div class="form-group col-6">
                                                <label for="ma_mau">Chọn màu sắc:</label>
                                                <select class="form-control" name="ma_mau" id="maMau">
                                                    <option value="">Chọn màu sắc</option>
                                                    @foreach ($mausac as $ms)
                                                    <option value="{{ $ms->ma_mau }}">{{ $ms->mau }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="size-selection" class="crancy__item-form--group mg-top-25" style="display: block;">
                                        <label class="crancy__item-label crancy__item-label-product">Kích thước đã chọn</label><br>
                                        <div class="row" id="size-options" style="display: flex; flex-wrap: wrap;">
                                            @foreach ($kichthuoc as $kt)
                                                <div class="form-group crancy-form-checkbox__added col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                                                    <input class="d-none crancy-form-checkbox" type="checkbox" id="add{{ $kt->ma_kich_thuoc }}" name="kich_thuoc" value="{{ $kt->ma_kich_thuoc }}" onclick="handleCheckboxClick(this)"/>
                                                    <label class="crancy-form-label" for="add{{ $kt->ma_kich_thuoc }}">
                                                        {{ $kt->kich_thuoc }}
                                                        <span><i class="fas fa-times"></i></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                                    <input type="hidden" id="selected_kich_thuoc" name="selected_kich_thuoc" value="">
                                        </div>
                                        <div class="crancy__item-form--group mg-top-25" id="quantity-selection">
                                            <label class="crancy__item-label crancy__item-label-product">Nhập số lượng</label>
                                            <div class="row" style="display: flex;">
                                                <input type="number" min="0" name="so_luong_ton">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div style="text-align: center">
                                        <button type="submit" class="btn btn-primary" style="width: 150px;">Thêm biến thể</button>
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
  </div>
</section>
@endsection
{{-- <script src="{{asset('assets')}}/ckeditor/ckeditor/ckeditor.js"></script> --}}

    <script src="https://cdn.tiny.cloud/1/7rqanoi5h2bf8k517ymgsbl3538ejjqzl2y111fny1weip63/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
    tinymce.init({
      selector: '#editor1',
      plugins: [
               'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor',
               'pagebreak', 'tinymcespellchecker'
            ]
    });
  </script>
  
<script>
    function validateForm() {
        var content = tinymce.get("editor1").getContent();
        if (content === '') {
            alert('Mô tả không được bỏ trống');
            return false; // Ngăn không cho form submit
        }
        return true;
    }
</script>

<script>
    function handleCheckboxClick(checkbox) {
        var checkboxes = document.getElementsByName('kich_thuoc');
        var hiddenInput = document.getElementById('selected_kich_thuoc');
        if (checkbox.checked) {
            // Uncheck all other checkboxes
            checkboxes.forEach(function(cb) {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
            hiddenInput.value = checkbox.value;
        } else {
            hiddenInput.value = '';
        }
    }
</script>


<script type="text/javascript">
    function ImagesFileAsURL() {
        var fileSelected = document.getElementById('duongDan').files;
        var displayDiv = document.getElementById('displayImg');
        displayDiv.innerHTML = ""; // Xóa nội dung cũ

        if (fileSelected.length > 0) {
            for (var i = 0; i < fileSelected.length; i++) {
                var fileToLoad = fileSelected[i];
                var fileReader = new FileReader();

                fileReader.onload = function(fileLoaderEvent) {
                    var srcData = fileLoaderEvent.target.result;
                    var newImage = document.createElement('img');
                    newImage.src = srcData;
                    newImage.classList.add('preview-image'); // Gán class để áp dụng CSS
                    displayDiv.appendChild(newImage);
                };

                fileReader.readAsDataURL(fileToLoad);
            }
        }
    }
</script>

