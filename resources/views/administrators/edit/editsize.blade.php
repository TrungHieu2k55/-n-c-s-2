@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    
    <br>
    <form role="form" method="POST" action="{{ route('update.size', ['ma_kich_thuoc' => $kt->ma_kich_thuoc]) }}">
        @csrf
        @method('PUT') 
        <div class="form-group">
            <label class="input-label" for="tenLoai">Tên loại sản phẩm</label>
            <input type="text" id="kichThuoc" name="kich_thuoc" class="form-control" value="{{ $kt->kich_thuoc }}" required>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 100px;">Cập nhật</button>
        </div>
    </form>
</section>
@endsection
