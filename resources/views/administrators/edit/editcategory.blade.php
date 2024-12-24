@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    
    <br>
    <form role="form" method="POST" action="{{ route('update.category', ['ma_loai' => $danhmuc->ma_loai]) }}">
        @csrf
        @method('PUT') 
        <div class="form-group">
            <label class="input-label" for="tenLoai">Tên loại sản phẩm</label>
            <input type="text" id="tenLoai" name="ten_loai" class="form-control" value="{{ $danhmuc->ten_loai }}" required>
        </div>
        <div class="form-group">
            <label class="input-label" for="chondanhmuc">Chọn danh mục cha</label>
            <select id="chondanhmuc" name="ma_danh_muc_cha" class="form-control">
                <option value="">Chọn danh mục cha</option>
                @foreach ($danhmucList as $item)
                    <option value="{{ $item->ma_loai }}" {{ $item->ma_loai == $danhmuc->ma_danh_muc_cha ? 'selected' : '' }}>
                        {{ $item->ten_loai }}
                    </option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 100px;">Cập nhật</button>
        </div>
    </form>
</section>
@endsection
