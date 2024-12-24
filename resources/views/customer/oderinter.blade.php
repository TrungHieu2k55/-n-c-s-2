@extends('customer.maininterface')
@section('maininter-content')
<section>
    <section>
        @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        
        @endif
    </section>
    <form action="{{ route('order.place') }}" method="POST">
        @csrf
    <div class="row" >
        {{-- <img src="{{asset('assets/cdn/shop/files/Black White Minimalist SImple Monogram Typography Logo (1)_preview_rev_1.png')}}"
        style="width: 200px; margin: auto"></img> --}}
        <div class="col-12" style="display: flex;">
            <div class="col-6" style=" margin-left: 5%">
                <div class="row" style="display: flex;">
                    <div class="col-md-6">
                        <a style="font-size: 25px; font-weight: bold">Thông Tin Mua Hàng</a><hr>
                        <div id="thongtin">
                            <input type="text" name="ten_khach_hang" value="{{ $customer->ten_khach_hang }}" placeholder="Tên khách hàng" style="width: 500px; height: 40px;">
                        </div><br>
                        <div id="thongtin">
                            <input type="email" name="email" value="{{ $customer->email }}" placeholder="Email" style="width: 500px; height: 40px;">
                        </div><br>
                        <div id="thongtin">
                            <input type="text" name="so_dien_thoai" value="{{ $customer->so_dien_thoai }}" placeholder="Số điện thoại" style="width: 500px; height: 40px;">
                        </div><br>
                        <div id="thongtin">
                            <input type="text" name="dia_chi" value="{{ $customer->dia_chi }}" placeholder="Địa chỉ" style="width: 500px; height: 40px;">
                        </div><br>
                        <div id="thongtin">
                            <input type="text" name="ghi_chu" placeholder="Ghi Chú" style="width: 500px; height: 40px;">
                        </div>
                    </div>
                    <br><br>
                    <div class="col-md-5" style="margin-left:30px ">
                        <a style="font-size: 25px; font-weight: bold">Phương Thức Thanh Toán</a><hr>
                        <div style="width: 300px;">
                            <div id="thongtin">
                                <input name="payment_method" type="radio" value="vnpay" style=" transform: scale(1.5);"> Thanh toán qua VNPay
                            </div><br>
                            <div id="thongtin">
                                <input name="payment_method" type="radio" value="cod"  style=" transform: scale(1.5);"> Thanh toán khi nhận hàng
                            </div>
                        </div>
                    </div>
                </div><br><hr>
{{-- KHUYENS MAI --}}
                <a style="font-size: 25px; font-weight: bold">Khuyến mãi dành cho bạn</a><br><br>
                <div class="vouchers-container" style="display: flex; flex-wrap: wrap; gap: 16px;">
                    @if($vouchers->isEmpty())
                    <p>Không có khuyến mãi phù hợp dành cho bạn. Bạn có thể mua thêm để có thể sử dụng các khuyến mãi cho đơn hàng của mình.</p>
                @else
                    @foreach($vouchers as $voucher)
                    <div class="item_discount" style="flex: 1 1 calc(33.333% - 16px); box-sizing: border-box; margin-bottom: 16px;">
                        <fieldset class="pro-discount" style="border: 1px solid #ccc !important; padding: 10px !important;">
                            <legend style="border-bottom: 1px solid #ccc !important; padding: 5px !important;">
                                <img alt="MÃ GIẢM GIÁ" src="//bizweb.dktcdn.net/100/462/587/themes/880841/assets/code_dis.gif?1717822329210"> MÃ GIẢM GIÁ
                            </legend>
                            <div class="top_discount" style="margin-top: 10px !important;">
                                <div class="item-name">
                                    <p class="code_dis">
                                       Giảm {{ $voucher->phan_tram_khuyen_mai }}%
                                    </p>
                                </div>
                                <img width="36" height="20" src="//bizweb.dktcdn.net/100/462/587/themes/880841/assets/coupon3_value_img.png?1717822329210" alt="FREESHIP" style="margin-top: 5px !important;">
                            </div>
                            <div class="coupon_desc" style="margin-top: 10px !important; height: 50px;">
                                <p>{{ $voucher->mo_ta }}</p>        
                            </div>
                            <div class="copy_discount" style="margin-top: 10px !important;">
                                <p class="code_zip">
                                    Mã áp dụng:  {{ $voucher->ma_ap_dung }}
                                </p>
                            </div>
                        </fieldset>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
            <div class="col-6" style="margin-left: 70px">
                <a style="font-size: 20px; font-weight: bold">Sản Phẩm Đơn Hàng</a><br>
                <div>
                    @foreach ($carts as $cart)
                    <table style=" width: 600px;">
                        <tr>
                            <td style="width: 100px;">
                                <div class="image-container" style="position: relative; width: 100px; height: 120px;">
                                    <img src="{{ asset('storage/images/' . $cart->productVariant->sanPham->hinhAnhs->first()->duong_dan) }}" alt="sanpham" style="width: 90px; height: 100px; object-fit: cover;">
                                </div>
                            </td>
                            <td style="padding-left: 10px;">
                                <div style="display: flex; flex-direction: column;">
                                    <div style="font-weight: bolder">{{ $cart->productVariant->sanPham->ten_san_pham }}</div>
                                    <div>Màu: {{ $cart->productVariant->mau->mau }} / Kích thước: {{ $cart->productVariant->kichThuoc->kich_thuoc }}</div>
                                    <div>Số lượng: {{$cart->so_luong}}</div>
                                    {{-- <div>max biến thể: {{$cart->ma_bien_the}}</div> --}}
                                </div>
                            </td>
                            <td style="text-align: right;">{{ number_format($cart->productVariant->sanPham->gia_ban * $cart->so_luong, 0, '.', '.') }} VNĐ</td>
                        </tr>
                    </table> 
                    <br>
                    @endforeach
                </div><hr style="width: 74%;">
                <div>
                    <span>
                        <input name="ma_ap_dung" id="voucherCode" type="text" placeholder="Nhập mã giảm giá" style="width: 400px; height: 40px;">
                    </span>
                    <span>
                        <input type="button" id="applyVoucher" style="width: 100px; height: 40px; font-weight: bold; background: dimgrey; color: white" value="Áp dụng">
                    </span>
                </div><hr style="width: 74%;">
                
                    <div style="display: flex; justify-content: space-between; width: 590px;">
                        <div>
                            Tạm tính:
                        </div>
                        <div id="subTotal">
                            {{ number_format($totalSum, 0, '.', '.') }} VNĐ
                        </div>
                    </div>
                    <br>
                    <div style="display: flex; justify-content: space-between; width: 590px;">
                    <div>
                        Chiết khấu:
                    </div>
                    <div id="discountAmount">
                        {{ number_format($discount, 0, '.', '.') }} VNĐ
                    </div>
                    <input id="discount" name="chiet_khau" type="text" value="{{ number_format($discount, 0, '.', '.') }}">
                    </div>
                    <hr style="width: 74%;">
                    <div style="display: flex; justify-content: space-between; width: 590px;">
                    <div>
                        Tổng cộng:
                    </div>
                    <div id="totalAmount">
                        {{ number_format($totalAfterDiscount, 0, '.', '.') }} VNĐ
                        
                    </div>
                    <input id="totalPricessInput" type="text" name="totalPricess" value="{{ number_format($totalAfterDiscount, 0, '.', '.') }}">
                    </div>
                <br>
                <div style="text-align: center">
                   
                        <button type="submit" style="width: 200px; height: 60px; font-size: 24px; font-weight: bold; background: #86ff3af0; padding: 14px; border-radius: 25px; border: none; cursor: pointer;">
                            ĐẶT HÀNG
                        </button>
                    
                    {{-- <a href="#" style="width: 200px; height: 60px; font-size: 24px; font-weight: bold; background: #86ff3af0; padding: 14px; border-radius: 25px;">ĐẶT HÀNG</a> --}}
                </div>
                <br>
            </div><br><br>
        </div>
    </div></form>
</section><br><br>

<style>
    #thongtin {
        font-size: 18px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const applyButton = document.getElementById('applyVoucher');
        applyButton.addEventListener('click', function() {
            applyVoucher();
        });

        function applyVoucher() {
            const voucherCode = document.getElementById('voucherCode').value.trim();
            fetch(`/apply-voucher?ma_ap_dung=${voucherCode}`)
                .then(response => response.json())
                .then(data => {
                    // Cập nhật chiết khấu và tổng cộng trên giao diện
                    document.getElementById('discountAmount').innerText = data.discount;
                    document.getElementById('totalAmount').innerText = data.total;

                    document.getElementById('discount').value = data.discount;
                    document.getElementById('totalPricessInput').value = data.total;
                })
                .catch(error => {
                    console.error('Error applying voucher:', error);
                    alert('Đã xảy ra lỗi khi áp dụng mã giảm giá.');
                });
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#placeOrderButton').click(function(e) {
            e.preventDefault();

            var paymentMethod = $("input[name='payment_method']:checked").val();
            if (!paymentMethod) {
                alert('Vui lòng chọn phương thức thanh toán!');
                return;
            }

            // Update totalPricess input with the value from #totalAmount
            var totalAmountText = $('#totalAmount').text().trim();
            var totalAmountValue = totalAmountText.split(' ')[0];
             // Remove ' VNĐ' part
            // Remove dots for number format

            // Continue with form submission or other logic here
            $('#orderForm').submit();
        });

        // Optional: Clear the other radio button if one is clicked
        $('#payment_vnpay').click(function() {
            $('#payment_cod').prop('checked', false);
        });

        $('#payment_cod').click(function() {
            $('#payment_vnpay').prop('checked', false);
        });
    });
</script>
@endsection