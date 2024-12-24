@extends('administrators.layouts.master')
@section('main-content')
    <section class="crancy-adashboard crancy-show">
        @if (session()->has('flash_notification'))
        <script>
        @foreach (session('flash_notification') as $notification)
            toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
        @endforeach
         {{ session()->forget('flash_notification') }}
        </script>
    @endif
        <div class="container container__bscreen">
        <div class="row">
            <div class="col-xxl-8 col-12 crancy-main__column">
            <div class="crancy-body">
                <!-- Dashboard Inner -->
                <div class="crancy-dsinner">
                <div class="crancy-table-meta mg-top-30">
                    <div class="row">
                    <div class="col-12">
                        <div class="crancy-flex-wrap crancy-flex-gap-15 crancy-flex-between">
                        <div class="crancy-table-meta__group">
                            <!-- Table Meta Single -->
                           
                        <div class="crancy-table-meta__group">
                          
                            <a href="{{route('index.sale')}}" class="crancy-btn crancy-btn__filter">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 16 16"
                                fill="none"
                            >
                                <path
                                d="M8 1V15"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                />
                                <path
                                d="M1 8H15"
                                stroke="white"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                />
                            </svg>
                            Thêm khuyến mãi
                            </a>
                            <!-- End Table Meta Single -->
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="crancy-table-tab-1" role="tabpanel" aria-labelledby="crancy-table-tab-1">
                    <div class="crancy-table crancy-table--v3 mg-top-30">
                        <div class="crancy-customer-filter crancy-customer-filter--inline">
                        <div class="crancy-customer-filter__single crancy-customer-filter__search">
                            <div class="crancy-header__form crancy-header__form--customer">
                            <form class="crancy-header__form-inner" action="#" method="GET">
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
                                <input name="search" value="" type="text" id="search-input" placeholder="tìm loại sản phẩm"/>
                            </form>
                            </div>
                        </div>
                       
                        </div>
                        <!-- Table Filter -->
                     
                        <!-- End Table Filter -->

                        <!-- crancy Table -->
                        <table id="crancy-table__main" class="crancy-table__main crancy-table__main-v3">
                        <!-- crancy Table Head -->
                        <thead class="crancy-table__head">
                            <tr>
                            <th class="crancy-table__column-1 crancy-table__h1">
                                <div class="crancy-wc__checkbox">
                                <input class="crancy-wc__form-check" id="checkbox" name="checkbox" type="checkbox" />
                                <span>Mã</span>
                                </div>
                            </th>
                            <th
                                class="crancy-table__column-2 crancy-table__h2"
                            >
                                Phần trăm khuyến mãi (%)
                            </th>
                            <th
                                class="crancy-table__column-2 crancy-table__h2"
                            >
                                Mức giá sử dụng khuyến mã
                            </th>
                            <th
                                class="crancy-table__column-3 crancy-table__h3"
                            >
                                Mô tả
                            </th>
                            <th
                                class="crancy-table__column-4 crancy-table__h4"
                            >
                                Tùy chọn
                            </th>
                            </tr>
                        </thead>
                       
                            @foreach ($khuyenmai as $item)
                                <tr style="margin-left:70px ">
                                    <td ><div class="crancy-wc__checkbox">
                                        <input class="crancy-wc__form-check" type="checkbox" name="checkbox[]" value="{{ $item->ma_khuyen_mai }}" style="margin-left:20px;">
                                        <span>{{ $item->ma_khuyen_mai }}</span>
                                    </div></td>
                                    <td ><div style="margin-left:25px;">{{ $item->phan_tram_khuyen_mai }}</div></td>
                                    <td ><div style="margin-left:25px;">từ {{ number_format($item->gia_ap_dung,0,'.','.') }} VNĐ trở lên</div></td>
                                    <td><div style="margin-left:25px;">
                                        {{ $item->mo_ta }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('edit.sale', ['ma_khuyen_mai' => $item->ma_khuyen_mai]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>Sửa</a>
                                        <a href="{{ route('delete.sale', ['ma_khuyen_mai' => $item->ma_khuyen_mai]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Xóa</a>
                                    </td>
                                </tr>
                        @endforeach
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
</script>
