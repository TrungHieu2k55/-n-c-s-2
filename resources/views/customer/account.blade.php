@extends('customer.maininterface')
@section('maininter-content')

   
        <div style="text-align: center">
            <a style="font-size: 50px; font-weight: bolder">TÀI KHOẢN</a>
        </div>
        <div class="row" style="display: flex; margin: 10px 30px 10px 50px">
            <div class="col-3">
                <div style="border: 1px solid black">
                    <div style="text-align: center">
                        <h2>{{$customer->ten_khach_hang}}</h2>
                    </div>
                    <hr>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                    <a id="accountInfoLink" href="#" style="font-weight: normal;" onclick="showAccountInfo()">
                        Thông tin tài khoản
                    </a>
                    <br><br>
                    <a id="purchaseHistoryLink" href="#" onclick="showPurchaseHistory()">
                        Lịch sử mua hàng
                    </a>
                    <hr>
                    <a href="{{ route('logoutcus') }}">Đăng xuất</a><br>

                </div>
            </div>
            <div class="col-9">
                <div id="thongtintaikhoan" style="display: block;">
                    <h2>Thông tin tài khoản</h2>
                    <a>Bạn có thể cập nhật thông tin của mình ở trang này</a>
                    <hr>
                    <div class="row">
                        <div class="col-5"> 
                            <h2>Thông tin đăng nhập</h2>
                            <a style="font-size: 18px">Email: </a> <span>{{$customer->email}}</span><br><br>
                            <div style="display: flex">
                                <div style="width: 30px;">
                                    <input type="checkbox" id="doimatkhau" onclick="togglePasswordChange()">
                                </div>
                                <div style="margin-top: 0px">
                                    <a>Thay đổi mật khẩu</a>
                                </div>
                            </div>
                            <br>
                            <form role="form" method="POST" action="{{ route('updatemk.customer', ['ma_khach_hang' => $customer->ma_khach_hang]) }}">
                                @csrf
                                @method('PUT')
                            <div id="matkhaumoi" style="display: none;">
                                
                                <label>Mật khẩu mới</label>
                                <input type="password" name="mat_khau"  minlength="8" maxlength="20" style="width: 400px;"><br><br>
                                <div style="text-align: center;">
                                    <button type="submit" style="background: black; color: white; font-weight: bold; width: 200px; height: 50px;">CẬP NHẬT</button>
                                </div>
                               
                            </div> </form>
                        </div>
                       
        
                    <div class="col-7">
                        <h2>Thông tin cá nhân</h2>
                        <form role="form" method="POST" action="{{ route('update.customer', ['ma_khach_hang' => $customer->ma_khach_hang]) }}">
                            @csrf
                            @method('PUT')
                        
                            <label for="ten_khach_hang">Họ và Tên</label><br><br>
                            <input type="text" id="ten_khach_hang" name="ten_khach_hang" value="{{ $customer->ten_khach_hang }}" style="width: 600px;"><br><br>
                        
                            <label for="email">Email</label><br><br>
                            <input type="email" id="email" name="email" value="{{ $customer->email }}" style="width: 600px;"><br><br>
                        
                            <label for="so_dien_thoai">Số điện thoại</label><br><br>
                            <input type="tel" id="so_dien_thoai" name="so_dien_thoai" value="{{ $customer->so_dien_thoai }}" style="width: 600px;"><br><br>
                        
                            <label for="ngay_sinh">Ngày sinh</label><br><br>
                            <input type="date" id="ngay_sinh" name="ngay_sinh" value="{{ $customer->ngay_sinh }}" style="width: 600px;"><br><br>
                        
                            <label for="dia_chi">Địa chỉ</label><br><br>
                            <input type="text" id="dia_chi" name="dia_chi" value="{{ $customer->dia_chi }}" style="width: 600px;"><br><br>
                            <small>Vui lòng nhập đầy đủ thông tin: Số nhà, xã/phường, quận/huyện, tỉnh/thành phố</small><br><br>
                        
                            <button type="submit" style="background: black; color: white; font-weight: bold; width: 300px; height: 50px;">CẬP NHẬT THÔNG TIN</button>
                        </form>
                    </div>
                    </div>                       
                </div>
           
                <div id="giohang" style="display: none;">
                    <hr>
                    <table>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Số lượng sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Chiết khấu</th>
                            <th>Thành tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                        @foreach ($orders as $order)
                        <tr>
                            <td><a href="#" onclick="toggleOrderDetails('{{ $order->ma_don_hang }}')">{{ $order->ma_don_hang }}</a></td>
                            <td>{{ $order->orderDetails->sum('so_luong') }}</td>
                            <td>{{ number_format($order->orderDetails->sum('tong_tien'), 0, ',', '.') }} VNĐ</td>
                            <td>
                                @if (isset($order->payment))
                                    {{ number_format($order->payment->chiet_khau, 0, ',', '.') }} VNĐ
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if (isset($order->payment))
                                    {{ number_format($order->payment->so_tien, 0, ',', '.') }} VNĐ
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($order->trang_thai == 0)
                                    Đang chờ xác nhận
                                @elseif ($order->trang_thai == 1)
                                    Đang giao
                                @elseif ($order->trang_thai == 2)
                                    Đã giao
                                @else
                                    Hủy
                                @endif
                            </td>
                        </tr>
                        <tr class="order-details" id="orderDetails_{{ $order->ma_don_hang }}" style="display: none;">
                            <td colspan="6">
                                <div>
                                    <h2>Chi tiết đơn hàng</h2>
                                    <table>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá tiền</th>
                                        </tr>
                                        @foreach($order->orderDetails as $detail)
                                            <tr>
                                                <td>
                                                    @if($detail->productVariant->sanPham->hinhAnhs->isNotEmpty())
                                                    
                                                        <img src="{{ asset('storage/images/' . $detail->productVariant->sanPham->hinhAnhs->first()->duong_dan) }}" alt="Product Image" width="100">
                                                    @else
                                                        Không có hình ảnh
                                                    @endif
                                                </td>
                                                <td>{{ $detail->productVariant->sanPham->ten_san_pham }}</td>
                                                <td>{{ $detail->so_luong }}</td>
                                                <td>{{ number_format($detail->tong_tien, 0, ',', '.') }} VND</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <br>
                                    @if ($order->trang_thai == 0)
                                    <form action="{{ route('cancel.order', $order->ma_don_hang) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger float-right" style="width: 160px; height: 50px;">Hủy đơn hàng</button>
                                    </form>
                                @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <br><br>
            </div>
        </div>
   
    <script>
        function togglePasswordChange() {
            var matkhaumoi = document.getElementById('matkhaumoi');
            var checkbox = document.getElementById('doimatkhau');
    
            if (checkbox.checked) {
                matkhaumoi.style.display = 'block';
            } else {
                matkhaumoi.style.display = 'none';
            }
        }
    </script>
    <script>
        function showAccountInfo() {
            var thongtintaikhoan = document.getElementById('thongtintaikhoan');
            var giohang = document.getElementById('giohang');

            thongtintaikhoan.style.display = 'block';
            giohang.style.display = 'none';
        }

        function showPurchaseHistory() {
            var thongtintaikhoan = document.getElementById('thongtintaikhoan');
            var giohang = document.getElementById('giohang');

            thongtintaikhoan.style.display = 'none';
            giohang.style.display = 'block';
        }

        function toggleOrderDetails(ma_don_hang) {
            var orderDetails = document.querySelector('#orderDetails_' + ma_don_hang);
            if (orderDetails.style.display === 'none') {
                orderDetails.style.display = 'table-row'; 
            } else {
                orderDetails.style.display = 'none'; 
            }
        }
    </script>
@endsection
{{-- @extends('customer.maininterface')
@section('maininter-content')
<form role="form" method="POST" action="{{ route('update.customer', ['ma_khach_hang' => $customer->ma_khach_hang]) }}">
    @csrf
    @method('PUT')

    <label for="ten_khach_hang">Họ và Tên</label><br><br>
    <input type="text" id="ten_khach_hang" name="ten_khach_hang" value="{{ $customer->ten_khach_hang }}" style="width: 600px;"><br><br>

    <label for="email">Email</label><br><br>
    <input type="email" id="email" name="email" value="{{ $customer->email }}" style="width: 600px;"><br><br>

    <label for="so_dien_thoai">Số điện thoại</label><br><br>
    <input type="tel" id="so_dien_thoai" name="so_dien_thoai" value="{{ $customer->so_dien_thoai }}" style="width: 600px;"><br><br>

    <label for="ngay_sinh">Ngày sinh</label><br><br>
    <input type="date" id="ngay_sinh" name="ngay_sinh" value="{{ $customer->ngay_sinh }}" style="width: 600px;"><br><br>

    <label for="dia_chi">Địa chỉ</label><br><br>
    <input type="text" id="dia_chi" name="dia_chi" value="{{ $customer->dia_chi }}" style="width: 600px;"><br><br>
    <small>Vui lòng nhập đầy đủ thông tin: Số nhà, xã/phường, quận/huyện, tỉnh/thành phố</small><br><br>

    <button type="submit" style="background: black; color: white; font-weight: bold; width: 300px; height: 50px;">CẬP NHẬT THÔNG TIN</button>
</form>
@endsection --}}