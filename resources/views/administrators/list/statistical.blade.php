@extends('administrators.layouts.master')
@section('main-content')
<section class="crancy-adashboard crancy-show">
    <h2>Thời gian</h2>
    <hr>
    <div class="container container__bscreen">
        <div class="row">  
            <label>Thống kê theo tháng</label>
            <div class="col-6">
                <label>Chọn thời gian bắt đầu</label>
                <input type="date">
            </div>
            <div class="col-6">
                <label>chọn ngày kết thúc</label>
                <input type="date">
            </div>
        <button>Tìm kiếm</button>
        </div>
   
    <hr>
        <div>
            <p>Tổng doanh thu</p>
            <p>Tổng vốn</p>
            <p>Lợi Nhuận</p>
        </div>
    </div>
</section>
@endsection