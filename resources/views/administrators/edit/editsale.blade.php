@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    
    <br>
    <form role="form" method="POST" action="{{ route('update.sale', ['ma_khuyen_mai' => $khuyenmai->ma_khuyen_mai]) }}">
        @csrf
        @method('PUT') 
        <div class="form-group">
            <label class="input-label" for="PhanTram">Tên loại sản phẩm</label>
            <input type="text" id="PhanTram" name="phan_tram_khuyen_mai" class="form-control" value="{{ $khuyenmai->phan_tram_khuyen_mai }}" required>
            <label class="input-label" for="GiaApDung">Mức giá sử dụng khuyến mãi</label>
            <input type="text" id="GiaApDung" name="gia_ap_dung" class="form-control" value="{{ $khuyenmai->gia_ap_dung }}"  required>
            <label class="input-label" for="Mota">Mô tả</label>
            <input type="text" id="Mota" name="mo_ta" class="form-control" value="{{ $khuyenmai->mo_ta }}" required>
            <label class="input-label" for="MaAD">Mã áp dụng</label>
            <input type="text" id="MaAD" name="ma_ap_dung" class="form-control" value="{{ $khuyenmai->ma_ap_dung}}" required>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 100px;">Cập nhật</button>
        </div>
    </form>
</section>
@endsection
