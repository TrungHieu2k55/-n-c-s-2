@extends('administrators.layouts.master')

@section('main-content')
<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-12">
                <div class="crancy-body">
                    <div class="crancy-dsinner">
                        <div class="row mg-top-10">
                            <div class="col-lg-12 col-12" id="content">
                                <br>
                                <p style="font-size: 30px; text-align: center; font-weight: bold">Danh Sách Nhân Viên</p>
                                <div class="crancy-user-search mg-top-40" style="width: 100%;">
                                    <div class="crancy-user-search__single crancy-user-search__single--sform" style="width: 69%;">
                                        <div class="crancy-header__form crancy-header__form--user">
                                            <form class="crancy-header__form-inner" action="{{ route('show.employee') }}" method="GET">
                                                <button class="search-btn" type="submit">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="9.78639" cy="9.78614" r="8.23951" stroke="#9AA2B1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        <path d="M15.5176 15.9448L18.7479 19.1668" stroke="#9AA2B1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                </button>
                                                <input name="s" value="" type="text" placeholder="Tên nhân viên..."/>
                                            </form>
                                        </div>
                                    </div>
                                    {{-- <div class="crancy-user-search__single crancy-user-search__single--button" style="text-align: right;">
                                        <a >
                                        sắp xếp</a>
                                    </div> --}}
                                    
                                </div>
                                <div class="row">
                                    @foreach ($nhanvien as $item)
                                        <div class="col-xxl-3 col-lg-4 col-md-6 col-12">
                                            <div class="crancy-single-user mg-top-30">
                                                <div class="crancy-toggle">
                                                    <a href="{{ route('detail.employee', ['ma_nhan_vien' => $item->ma_nhan_vien]) }}" id="show-details">
                                                        <img src="{{asset('assets')}}/img/toggle-icon.svg" />
                                                    </a>
                                                </div>
                                                <div class="crancy-single-user__head">
                                                    <img src="img/user-2.png" class="avatar" />
                                                    <h4 class="crancy-single-user__title">{{ $item->ten_nhan_vien }}</h4>
                                                    <p class="crancy-single-user__label">
                                                        {{ $item->role->ten_vai_tro ?? 'Không có vai trò' }}
                                                    </p>
                                                </div>
                                                <div class="crancy-single-user__info">
                                                    <ul class="crancy-single-user__list">
                                                        <li>Email: {{ $item->email }}</li>
                                                        <li>Phone: {{$item->so_dien_thoai }}</li>
                                                    </ul>
                                                </div>
                                                {{-- <a href="inbox.html" class="crancy-btn__default">Message</a> --}}
                                            </div>
                                        </div>
                                    @endforeach
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
@section('styles')
<style>
    #crancy-table__main tbody tr {
        display: none;
    }
    #crancy-table__main tbody tr[style="display:"] {
        display: table-row;
    }
</style>
@endsection
