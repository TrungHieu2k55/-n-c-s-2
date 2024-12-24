@extends('customer.maininterface')
@section('maininter-content')
<section>
    @if (session('success'))
            <script>
                alert("{{ session('success') }}");
            </script>
        
        @endif
    <div style="width: 100%; ">
        <div style="text-align: center">
            <a style="font-size: 30px; font-weight: bolder">GIỎ HÀNG CỦA BẠN</a>
        </div><br><br>

        <div>
            {{-- Display cart items --}}
            @auth('customers')
            <div style="width: 90%; margin: auto; text-align: center; font-size: 18px">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th>THÔNG TIN SẢN PHẨM</th>
                            <th>ĐƠN GIÁ</th>
                            <th>SỐ LƯỢNG</th>
                            <th>THÀNH TIỀN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $cart)
                        <tr>
                            <td>
                                <table>
                                    <tr style="border: none;">
                                        <td style="width: 110px; position: relative; border: none;">
                                            <div class="image-container" style="position: relative; width: 100px; height: 120px;">
                                                <img src="{{ asset('storage/images/' . $cart->productVariant->sanPham->hinhAnhs->first()->duong_dan) }}" alt="sanpham" style="width: 100%; height: 100%; object-fit: cover;">
                                                <sub style="position: absolute; bottom: 100px; left: 80px;">
                                                    <a href="{{ route('cart.delete', $cart->ma_bien_the) }}" class="delete-item" data-bienthe="{{ $cart->ma_bien_the }}"
                                                        style="display: inline-block; width: 25px; height: 25px; line-height: 25px; 
                                                               border-radius: 50%; text-align: center; font-size: 18px; font-weight: bold; 
                                                               background-color: red; color: #fff;">
                                                         X
                                                     </a>
                                                </sub>
                                            </div>
                                        </td>
                                        <td style="border: none;">
                                            <ul>{{ $cart->productVariant->sanPham->ten_san_pham }}</ul>
                                            <ul>Kích thước: {{ $cart->productVariant->kichThuoc->kich_thuoc }}</ul>
                                            <ul>Màu: {{ $cart->productVariant->mau->mau }}</ul>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="color: red; text-align: center">{{ number_format($cart->productVariant->sanPham->gia_ban, 0, '.', '.') }} VNĐ</td>
                            <td>
                                <div class="quantity buttons_added form-minimal" style="border: 2px solid black; width: 170px; height: 52px; background-color: white; display: flex; margin: auto">
                                    <input type="button" value="-" class="minus button is-form" onclick="decreaseQuantity('{{ $cart->ma_bien_the }}', '{{ $cart->productVariant->sanPham->gia_ban }}')">
                                    <input type="number" id="quantity_{{ $cart->ma_bien_the }}" step="1" min="1" max="{{ $cart->productVariant->so_luong_ton }}" name="so_luong_{{ $cart->ma_bien_the }}" value="{{ $cart->so_luong }}" placeholder="" inputmode="numeric" onchange="updateSubtotal('{{ $cart->ma_bien_the }}', '{{ $cart->productVariant->sanPham->gia_ban }}')" readonly>
                                    <input type="button" value="+" class="plus button is-form" onclick="increaseQuantity('{{ $cart->ma_bien_the }}', '{{ $cart->productVariant->sanPham->gia_ban }}')">
                                </div>
                            </td>
                            <td id="subtotal_{{ $cart->ma_bien_the }}" style="color: red; text-align: center">{{ number_format($cart->productVariant->sanPham->gia_ban * $cart->so_luong, 0, '.', '.') }} VNĐ</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">Giỏ hàng của bạn đang trống.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            <br><br>
            <div style="width: 450px; margin-left:77%; ">
                <a style="font-size: 18px; font-weight: bolder">TỔNG TIỀN:</a>
                <span id="totalSum" style="font-size: 24px; font-weight: bolder; color: red">{{ number_format($totalSum, 0, '.', '.') }} VNĐ</span>
            </div>
                <div style="text-align: center">
                    <a href="{{route('order.index')}}" style="width: 200px; height: 60px; font-size: 24px; font-weight: bold; background: #86ff3af0; padding: 14px; border-radius: 25px;">ĐẶT HÀNG</a>
                </div>
            @else
            <div>
                <p>Vui lòng <a href="{{ route('login') }}">đăng nhập</a> để xem giỏ hàng của bạn.</p>
            </div>
            @endauth
        </div>
       
    </div>
    <br><br>
</section>
<script>
    function decreaseQuantity(maBienThe, giaBan) {
        let quantityInput = document.getElementById('quantity_' + maBienThe);
        let currentQuantity = parseInt(quantityInput.value);

        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
            updateSubtotal(maBienThe, giaBan);
        }
    }

    function increaseQuantity(maBienThe, giaBan) {
        let quantityInput = document.getElementById('quantity_' + maBienThe);
        let currentQuantity = parseInt(quantityInput.value);
        let maxQuantity = parseInt(quantityInput.max);

        if (currentQuantity < maxQuantity) {
            quantityInput.value = currentQuantity + 1;
            updateSubtotal(maBienThe, giaBan);
        }
    }

    function updateSubtotal(maBienThe, giaBan) {
        let quantityInput = document.getElementById('quantity_' + maBienThe);
        let currentQuantity = parseInt(quantityInput.value);
        let subtotalElement = document.getElementById('subtotal_' + maBienThe);

        let newSubtotal = currentQuantity * giaBan;
        subtotalElement.innerHTML = number_format(newSubtotal, 0, '.', '.') + ' VNĐ';

        updateTotalSum();
    }

    function updateTotalSum() {
        let totalSum = 0;
        let subtotals = document.querySelectorAll('[id^="subtotal_"]');

        subtotals.forEach(subtotal => {
            let value = parseInt(subtotal.innerHTML.replace(/\D/g, ''));
            totalSum += value;
        });

        let totalSumElement = document.getElementById('totalSum');
        totalSumElement.innerHTML = number_format(totalSum, 0, '.', '.') + ' VNĐ';
    }

    function number_format(number, decimals, decPoint, thousandsSep) {
        decimals = decimals || 0;
        decPoint = decPoint || '.';
        thousandsSep = thousandsSep || ',';

        number = parseFloat(number);
        if (!isFinite(number) || (!number && number !== 0)) {
            return '';
        }

        let stringified = number.toFixed(decimals);

        let parts = stringified.split('.');
        let integerPart = parts[0];
        let decimalPart = parts.length > 1 ? (decPoint + parts[1]) : '';

        let rgx = /(\d+)(\d{3})/;
        while (rgx.test(integerPart)) {
            integerPart = integerPart.replace(rgx, '$1' + thousandsSep + '$2');
        }

        return integerPart + decimalPart;
    }
</script>


<style>
    strong {
        font-weight: bold;
        color: black;
        font-size: 18px;
    }

    .quantity.buttons_added {
        display: flex;
        align-items: center;
    }

    .quantity.buttons_added .button {
        width: 50px;
        height: 50px;
        text-align: center;
        background-color: white;
        border: none;
        font-size: 18px;
        font-weight: bold;
    }

    .quantity.buttons_added input[type="number"] {
        text-align: center;
        width: 70px;
        height: 50px;
        border: none;
        box-sizing: border-box;
        font-size: 18px;
        font-weight: bold;
    }
</style>

@endsection
