@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    @if (session()->has('flash_notification'))
    <script>
    @foreach (session('flash_notification') as $notification)
        toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
    @endforeach
     {{ session()->forget('flash_notification') }}
    </script>
@endif
    <br>
    <form role="form" method="POST" action="{{ route('store.sale') }}">
        @csrf
        <div class="form-group">
            <label class="input-label" for="PhanTram">Phần trăm khuyến mãi</label>
            <input type="text" id="PhanTram" name="phan_tram_khuyen_mai" class="form-control" placeholder="Ví dụ 20" required>
            <label class="input-label" for="GiaApDung">Mức giá sử dụng khuyến mãi</label>
            <input type="text" id="GiaApDung" name="gia_ap_dung" class="form-control" placeholder="chỉ cần nhập giá tiền để dùng khuyến mãi." required>
            <label class="input-label" for="Mota">Mô tả</label>
            <input type="text" id="Mota" name="mo_ta" class="form-control" required>
            <label class="input-label" for="MaAD">Mã áp dụng</label>
            <input type="text" id="MaAD" name="ma_ap_dung" class="form-control" required>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 150px;">Thêm mới</button>
        </div>
    </form>
</section>
@endsection
