@extends('administrators.layouts.master')
@section('main-content')
    <section class="crancy-adashboard crancy-show">
        <div class="container container__bscreen">
        <div class="row">
            <div class="col-xxl-8 col-12 crancy-main__column">
            <div class="crancy-body">
                <!-- Dashboard Inner -->
                <div class="crancy-dsinner">                
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="crancy-table-tab-1" role="tabpanel" aria-labelledby="crancy-table-tab-1">
                    <div class="crancy-table crancy-table--v3 mg-top-30" >
                        <p style="text-align: center; color: black; font-weight: bold; font-size: 35px" >DANH SÁCH ĐƠN HÀNG</p>    
                                        <br><br>
                        <div class="crancy-customer-filter crancy-customer-filter--inline">
                        <div class="crancy-customer-filter__single crancy-customer-filter__search">
                            <div class="crancy-header__form crancy-header__form--customer">
                            <form class="crancy-header__form-inner" action="# " method="GET">
                                <button class="search-btn" type="submit" name="search">
                                <svg
                                    width="20" height="20"  viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle
                                    cx="9.78639"
                                    cy="9.78614"
                                    r="8.23951"
                                    stroke="#9AA2B1"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    ></circle>
                                    <path
                                    d="M15.5176 15.9448L18.7479 19.1668"
                                    stroke="#9AA2B1"
                                    stroke-width="1.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    ></path>
                                </svg>
                                </button>
                                <input name="search" value="" type="text" id="search-input" placeholder="Tìm theo tên khách hàng..."/>
                            </form>
                            </div>
                        </div>
                       
                        </div>
                        <!-- Table Filter -->
                       
                        <!-- End Table Filter -->

                        <!-- crancy Table -->
                        <table id="crancy-table__main" class="crancy-table__main crancy-table__main-v3">
                            <thead class="crancy-table__head">
                                <tr>
                                    <th class="crancy-table__column-1 crancy-table__h1">
                                        <div class="crancy-wc__checkbox">
                                            <input class="crancy-wc__form-check" id="checkbox" name="checkbox" type="checkbox" />
                                            <span>Mã đơn hàng</span>
                                        </div>
                                    </th>
                                    <th class="crancy-table__column-2 crancy-table__h2">
                                        Khách hàng
                                    </th>
                                    <th class="crancy-table__column-2 crancy-table__h2">
                                        Số lượng
                                    </th>
                                    <th class="crancy-table__column-3 crancy-table__h3">
                                        Tổng tiền
                                    </th>
                                    <th class="crancy-table__column-2 crancy-table__h4">
                                        Chiết khấu
                                    </th>
                                    <th class="crancy-table__column-3 crancy-table__h5">
                                        Thành tiền
                                    </th>
                                    <th class="crancy-table__column-3 crancy-table__h6">
                                        Trạng thái
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donhang as $item)
                                    <tr>
                                        <td class="text-center">
                                            <div class="crancy-wc__checkbox">
                                                <input class="crancy-wc__form-check" type="checkbox" name="checkbox[]" value="{{ $item->ma_don_hang }}" style="margin-left: 20px;">
                                                <span>{{ $item->ma_don_hang }}</span>
                                                <a href="{{ route('index.order', ['ma_don_hang' => $item->ma_don_hang]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" style="width: 20px; height: 20px;" data-ma-don-hang="{{ $item->ma_don_hang }}" class="info-icon">
                                                        <path d="M288 80c-65.2 0-118.8 29.6-159.9 67.7C89.6 183.5 63 226 49.4 256c13.6 30 40.2 72.5 78.6 108.3C169.2 402.4 222.8 432 288 432s118.8-29.6 159.9-67.7C486.4 328.5 513 286 526.6 256c-13.6-30-40.2-72.5-78.6-108.3C406.8 109.6 353.2 80 288 80zM95.4 112.6C142.5 68.8 207.2 32 288 32s145.5 36.8 192.6 80.6c46.8 43.5 78.1 95.4 93 131.1c3.3 7.9 3.3 16.7 0 24.6c-14.9 35.7-46.2 87.7-93 131.1C433.5 443.2 368.8 480 288 480s-145.5-36.8-192.6-80.6C48.6 356 17.3 304 2.5 268.3c-3.3-7.9-3.3-16.7 0-24.6C17.3 208 48.6 156 95.4 112.6zM288 336c44.2 0 80-35.8 80-80s-35.8-80-80-80c-.7 0-1.3 0-2 0c1.3 5.1 2 10.5 2 16c0 35.3-28.7 64-64 64c-5.5 0-10.9-.7-16-2c0 .7 0 1.3 0 2c0 44.2 35.8 80 80 80zm0-208a128 128 0 1 1 0 256 128 128 0 1 1 0-256z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="text-center">{{ $item->ten_khach_hang }}</td>
                                        <td class="text-center">{{ $item->tong_so_luong_bien_the }}</td>
                                        <td class="text-center">{{ number_format($item->tong_tien,0,'.','.') }} VND</td>
                                        <td class="text-center">{{ number_format($item->payment->chiet_khau,0,'.','.') }} VND</td>
                                        <td class="text-center">{{ number_format($item->payment->so_tien,0,'.','.') }} VND</td>
                                        <td class="text-center">
                                            <form action="{{ route('update.order.status', ['ma_don_hang' => $item->ma_don_hang]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select name="trang_thai" onchange="updateOrderStatus('{{ $item->ma_don_hang }}', this.value)">
                                                    <option value="0" {{ $item->trang_thai == '0' ? 'selected' : '' }}>Chờ xác nhận</option>
                                                    <option value="1" {{ $item->trang_thai == '1' ? 'selected' : '' }}>Đang giao</option>
                                                    <option value="2" {{ $item->trang_thai == '2' ? 'selected' : '' }}>Đã giao</option>
                                                    <option value="3" {{ $item->trang_thai == '3' ? 'selected' : '' }}>Hủy</option>
                                                </select>
                                            </form>
                                        </td>
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
@endsection
@section('styles')
    <style>
        /* Your CSS code goes here */
        #crancy-table__main tbody tr {
            display: none;
        }

        #crancy-table__main tbody tr[style="display:"] {
            display: table-row;
        }
    </style>
@endsection
<script>
        document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('search-input');
    const tableRows = document.querySelectorAll('#crancy-table__main tbody tr');

    searchInput.addEventListener('keyup', function(event) {
        const searchText = event.target.value.toLowerCase();
        tableRows.forEach(row => {
            const rowData = row.textContent.toLowerCase();
            if (removeDiacritics(rowData).includes(removeDiacritics(searchText))) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});

// Hàm để loại bỏ dấu trong chuỗi tiếng Việt
function removeDiacritics(str) {
    return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
}

public function showItems() {
    $items = Item::all();
    
    // Lọc ra chỉ những mã màu hợp lệ
    $items = $items->filter(function($item) {
        return preg_match('/^#([0-9A-F]{3}|[0-9A-F]{6})$/i', $item->mau);
    });

    return view('items.index', ['items' => $items]);
}
</script>

<script>
    function updateOrderStatus(ma_don_hang, trang_thai) {
        $.ajax({
            url: '/orders/' + ma_don_hang + '/update-status',
            type: 'PUT',
            data: {
                _token: '{{ csrf_token() }}',
                trang_thai: trang_thai
            },
            success: function(response) {
                console.log(response);
                // Update UI or show success message
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Error updating order status:', errorThrown);
                // Handle error or show error message
            }
        });
    }
</script>