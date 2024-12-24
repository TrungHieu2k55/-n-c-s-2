@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    {{-- @if(Session::has('success'))
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
    @endif --}}
    @if (session()->has('san_Pham'))
                        <script>
                        @foreach (session('san_Pham') as $notification)
                            toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
                        @endforeach
                         {{ session()->forget('san_Pham') }}
                        </script>
                    @endif
    <br>
    <form role="form" method="POST" action="{{ route('store.category') }}">
        @csrf
        <div class="form-group">
            <label class="input-label" for="tenLoai">Tên loại sản phẩm</label>
            <input type="text" id="tenLoai" name="ten_loai" class="form-control" required>
        </div>
        <div class="form-group">
            <label class="input-label" for="chondanhmuc">Chọn danh mục</label>
            <select id="chondanhmuc" name="ma_danh_muc_cha" class="form-control">
                <option value="">Chọn danh mục</option>
                @foreach ($danhmuc as $item)
                    <option value="{{ $item->ma_loai }}">{{ $item->ten_loai }}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 150px; ">Thêm mới</button>
        </div>
    </form>
</section>
@endsection
