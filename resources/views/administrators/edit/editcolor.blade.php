@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    
    <br>
    
        @csrf
        @method('PUT') 
        <div class="form-group">
            <label class="input-label" for="tenLoai">Tên màu/label>
            <input type="text" id="Mau" name="mau" class="form-control" value="{{ $mausac->mau }}" required>
        </div>
        <div class="form-group">
            <label class="input-label" for="tenLoai">Mã màu</label>
            <input type="text" id="maMauchitiet" name="ma_mau_chi_tiet" value="{{ $mausac->ma_mau_chi_tiet }}" class="form-control" placeholder="#000000" required>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 100px;">Cập nhật</button>
        </div>
    </form>
</section>
@endsection
