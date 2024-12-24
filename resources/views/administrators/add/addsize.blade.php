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
    @if (session()->has('size'))
        <script>
            @foreach (session('size') as $notification)
                toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
            @endforeach
            {{ session()->forget('size') }}
        </script>
    @endif
    <br>
    <form role="form" method="POST" action="{{ route('store.size') }}">
        @csrf
        <div class="form-group">
            <label class="input-label" for="kichThuoc">kích thước</label>
            <input type="text" id="Kichthuoc" name="kich_thuoc" class="form-control" required>
        </div>
        <br>
        <div>
            <button type="submit" class="btn btn-primary" style="width: 150px;">Thêm mới</button>
        </div>
    </form>
</section>
@endsection
