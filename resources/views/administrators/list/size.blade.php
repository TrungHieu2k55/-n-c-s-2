@extends('administrators.layouts.master')
@section('main-content')
    <section class="crancy-adashboard crancy-show">
        @if (session()->has('size'))
            <script>
                    @foreach (session('size') as $notification)
                        toastr.{{ $notification['type'] }}('{{ $notification['message'] }}', '{{ $notification['title'] }}');
                    @endforeach
                {{ session()->forget('size') }}
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
                            <a href="{{route('index.size')}}" class="crancy-btn crancy-btn__filter">
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
                           Thêm kích thước
                            </a>
                            <!-- End Table Meta Single -->
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="crancy-table-tab-1" role="tabpanel" aria-labelledby="crancy-table-tab-1">
                    <div class="crancy-table crancy-table--v3 mg-top-30"  style="width: 1300px;">
                        <div class="crancy-customer-filter crancy-customer-filter--inline">
                        <div class="crancy-customer-filter__single crancy-customer-filter__search">
                            <div class="crancy-header__form crancy-header__form--customer">
                            <form class="crancy-header__form-inner" action="{{ route('search.size')}} " method="GET">
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
                                <input name="search" value="" type="text" id="search-input" placeholder="Tìm theo tên kích thước..."/>
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
                                <input class="crancy-wc__form-check" id="checkbox" name="checkbox" type="checkbox"/>
                                <span>Mã</span>
                                </div>
                            </th>
                            <th
                                class="crancy-table__column-2 crancy-table__h2"
                            >
                                Màu sắc
                            </th>
                            <th
                                class="crancy-table__column-3 crancy-table__h3"
                            >
                                Tùy chọn
                            </th>
                            </tr>
                        </thead>
                       
                        @foreach ($kt as $item)
                    <tr>
                        <td ><div class="crancy-wc__checkbox">
                            <input class="crancy-wc__form-check" type="checkbox" name="checkbox[]" value="{{ $item->ma_kich_thuoc }}" style="margin-left:20px;">
                            <span>{{ $item->ma_kich_thuoc }}</span>
                        </div></td>
                        <td>{{ $item->kich_thuoc }}</td>
                        <td>
                            <a href="{{ route('edit.size', ['ma_kich_thuoc' => $item->ma_kich_thuoc]) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i>Edit</a>
                            <a href="{{ route('delete.size', ['ma_kich_thuoc' => $item->ma_kich_thuoc]) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>Delete</a>
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
