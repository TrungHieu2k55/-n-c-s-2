{{-- @extends('administrators.layouts.master')
@section('main-content')

<section class="crancy-adashboard crancy-show">
    <div class="container container__bscreen">
        <div class="row">
            <div class="col-xxl-8 col-12 crancy-main__column">
                <div class="crancy-body">
                    <div class="crancy-dsinner">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-9 col-12 mg-top-30" style="width: 90%;">

                                    <div class="crancy-product-card">
                                        <div style="display: flex; justify-content: flex-end;">
                                        <button style="width: 20px; height: 20px; ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 512 512">
                                            <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/></svg>
                                    </button>
                                        </div>
                                        <h4 class="crancy-product-card__title">Thông tin cá nhân</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                <div class="crancy__item-form--group col-7">
                                                    <label class="crancy__item-label crancy__item-label-product">Họ tên</label>
                                                    <input class="crancy__item-input" type="text" value="{{ $detailND->ten_nguoidung }}" required="required"/>
                                                </div>
                                                <div class="crancy__item-form--group col-5">
                                                    <label class="crancy__item-label crancy__item-label-product">Vai trò: &nbsp;</label>
                                                    @foreach($roles as $role)
                                                        <span style="margin-left: 50px;">{{ $role->vaiTro->ten_vaitro }}</span>
                                                    @endforeach
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="crancy__item-form--group mg-top-25">
                                                            <label class="crancy__item-label crancy__item-label-product">Ngày sinh</label>
                                                            <input class="crancy__item-input" type="text" value="{{ $detailND->ngay_sinh }}" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="crancy__item-form--group mg-top-25">
                                                            <label class="crancy__item-label crancy__item-label-product">Giới tính</label>
                                                            <input class="crancy__item-input" type="text" value="{{ $detailND->gioi_tinh == 1 ? 'Nam' : 'Nữ' }}" required="required"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-25">
                                                    <label class="crancy__item-label crancy__item-label-product">Email</label>
                                                    <input class="crancy__item-input" type="email" value="{{ $detailND->email }}" required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-25">
                                                    <label class="crancy__item-label crancy__item-label-product">Số điện thoại</label>
                                                    <input class="crancy__item-input" type="text" value="{{ $detailND->so_dienthoai }}" required="required"/>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="crancy__item-form--group mg-top-25">
                                                    <label class="crancy__item-label crancy__item-label-product">Địa chỉ</label>
                                                    <input class="crancy__item-input" type="text" value="{{ $detailND->dia_chi }}" required="required"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                button cập nhật
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
 --}}
