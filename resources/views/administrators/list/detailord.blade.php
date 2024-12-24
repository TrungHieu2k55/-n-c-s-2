@extends('administrators.layouts.master')
@section('main-content')
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
            <div class="row">
                <div class="col-xxl-8 col-12 crancy-main__column">
                    <div class="crancy-body">
                        <!-- Dashboard Inner -->
                            <div class="tab-content" id="nav-tabContent">
                                
                                <div class="tab-pane fade show active" id="crancy-table-tab-1" role="tabpanel" aria-labelledby="crancy-table-tab-1">
                                    <div class="crancy-table crancy-table--v3 mg-top-30">
                                        <p style="text-align: center; color: black; font-weight: bold; font-size: 35px" >CHI TIẾT ĐƠN HÀNG</p>    
                                        <br><br>
                                        @if($orderDetails->ghi_chu)
                                            <p style="color: red"><span style="font-weight: bold">Ghi chú:</span>
                                            <span style="color: black">{{ $orderDetails->ghi_chu }}</span></p>
                                        @endif  
                                        <br><br>
                                        <table>
                                            <!-- crancy Table Head -->
                                            <thead class="crancy-table__head">
                                                <tr>
                                                    <th class="crancy-table__column-2">Tên sản phẩm</th>
                                                    <th class="crancy-table__column-2">Hình ảnh</th>
                                                    <th class="crancy-table__column-3 crancy-table__h3">Màu</th>
                                                    <th class="crancy-table__column-4 crancy-table__h4">Kích thước</th>
                                                    <th class="crancy-table__column-4 crancy-table__h4">Giá bán</th>
                                                    <th class="crancy-table__column-4 crancy-table__h4">Số lượng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderDetails->orderDetails as $detail)
                                                <tr>
                                                    <td class="crancy-table__column-2 centered-cell">{{ $detail->productVariant->sanPham->ten_san_pham }}</td>
                                                    <td class="crancy-table__column-2 centered-cell">
                                                        <img src="{{ asset('storage/images/' . $detail->productVariant->sanPham->hinhAnhs->first()->duong_dan) }}" alt="sanpham" style="width: 80%; height: 80%; object-fit: cover;">
                                                    </td>
                                                    <td class="crancy-table__column-3 centered-cell">{{ $detail->productVariant->mau->mau }}</td>
                                                    <td class="crancy-table__column-4 centered-cell">{{ $detail->productVariant->kichThuoc->kich_thuoc }}</td>
                                                    <td class="crancy-table__column-4 centered-cell">{{ number_format($detail->productVariant->sanPham->gia_ban,0,'.','.') }} VND</td>
                                                    <td class="crancy-table__column-4 centered-cell">{{ $detail->so_luong }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .centered-cell {
            text-align: center; /* Horizontal centering */
            vertical-align: middle; /* Vertical centering */
        }
    </style>
@endsection