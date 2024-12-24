@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    @if(Session::has('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{!! Session::get('success') !!}</strong>
        </div>
    @endif
    @if(Session::has('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{ Session::get('error') }}</strong>
        </div>
    @endif
    @if (session()->has('color'))
        <script>
                @foreach (session('color') as $notification)
                    toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
                @endforeach
                {{ session()->forget('color') }}
        </script>
    @endif
    <br>
    <form role="form" method="POST" action="{{ route('store.color') }}">
        @csrf
        <div class="form-group">
            <label class="input-label" for="tenLoai">Tên màu</label>
            <input type="text" id="Mau" name="mau" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="input-label" for="tenLoai">Mã màu</label>
            <input type="text" id="maMauchitiet" name="ma_mau_chi_tiet" class="form-control" placeholder="#000000" required>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 150px;">Thêm mới</button>
        </div>
        
    </form>
</section>
@endsection
<script>
    document.getElementById('colorForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        
        const color = document.getElementById('maMauchitiet').value;

        
        const hexPattern = /^#([0-9A-F]{3}|[0-9A-F]{6})$/i;
        if (!hexPattern.test(color)) {
            alert('Vui lòng nhập mã màu hợp lệ (ví dụ: #000000 hoặc #FFF).');
            return;
        }

        console.log('Màu đã lưu:', color);
        alert('Màu đã được lưu thành công!');
    });
</script>