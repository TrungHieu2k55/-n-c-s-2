<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Admin\mdProductBT;
use Carbon\Carbon;
use Flasher\Toastr\Laravel\Facade\Toastr;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $totalStock = mdProductBT::sum('so_luong_ton');
        $totalRevenue = Payment::whereMonth('ngay_thanh_toan', $currentMonth)
            ->whereYear('ngay_thanh_toan', $currentYear)
            ->sum('so_tien');

        $totalOrders = Order::whereMonth('ngay_tao', $currentMonth)
            ->whereYear('ngay_tao', $currentYear)
            ->count();

        $successfulOrdersCount = Order::where('trang_thai', 2)
            ->whereMonth('ngay_tao', $currentMonth)
            ->whereYear('ngay_tao', $currentYear)
            ->count();

        $cancelledOrdersCount = Order::where('trang_thai', 3)
            ->whereMonth('ngay_tao', $currentMonth)
            ->whereYear('ngay_tao', $currentYear)
            ->count();

        // Tính toán số lượng đơn hàng cho 12 tháng
        $successfulOrdersCounts = [];
        $cancelledOrdersCounts = [];
        $totalOrdersCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $successfulOrdersCounts[] = Order::where('trang_thai', 2)
                ->whereMonth('ngay_tao', $month)
                ->whereYear('ngay_tao', $currentYear)
                ->count();

            $cancelledOrdersCounts[] = Order::where('trang_thai', 3)
                ->whereMonth('ngay_tao', $month)
                ->whereYear('ngay_tao', $currentYear)
                ->count();

            $totalOrdersCounts[] = Order::whereMonth('ngay_tao', $month)
                ->whereYear('ngay_tao', $currentYear)
                ->count();
        }
        // dòng này sẽ tạo thông báo ngay lập tức trong mã PHP, nhưng không được lưu lại để hiển thị khi trang tải xong. Ngược lại, session()->push('flash_notification', [...])
        // Toastr::success('Welcome to my app!', ['title' => 'success']);
        // session()->push('flash_notification', [
        //     'type' => 'info',
        //     'message' => 'Welcome to admin',
        //     'title' => 'Đăng nhập'
        // ]);

        return view('administrators.layouts.index', compact(
            'user',
            'totalRevenue',
            'totalOrders',
            'totalStock',
            'successfulOrdersCount',
            'cancelledOrdersCount',
            'successfulOrdersCounts',
            'cancelledOrdersCounts',
            'totalOrdersCounts'
        ));
    }

    public function showorder()
    {
        $donhang = Order::with(['payment', 'customer', 'orderDetails'])->get();

        foreach ($donhang as $item) {
            $item->ten_khach_hang = $item->customer->ten_khach_hang;
            $item->tong_tien = $item->payment->chiet_khau + $item->payment->so_tien;

            // Tính tổng số lượng biến thể trong đơn hàng
            $item->tong_so_luong_bien_the = $item->orderDetails->sum('so_luong');
        }

        return view('administrators.list.order', compact('donhang'));
    }

    public function updateStatus(Request $request, $ma_don_hang)
    {
        $donhang = Order::findOrFail($ma_don_hang);
        $trangThaiCu = $donhang->trang_thai;

        $donhang->trang_thai = $request->trang_thai;
        $donhang->ma_nhan_vien = Auth::user()->ma_nhan_vien;
        $donhang->save();

        // Nếu đơn hàng được chuyển sang trạng thái 'Hủy'
        if ($request->trang_thai == 3 && $trangThaiCu != 3) {
            // Lặp qua các chi tiết đơn hàng và tăng số lượng tồn của từng biến thể
            foreach ($donhang->orderDetails as $orderDetail) {
                $productBT = $orderDetail->productVariant;
                $productBT->increaseInventory($orderDetail->so_luong);
            }
        }

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

    // THỐNG KÊ
    public function statistical()
    {
        return view('administrators.list.statistical');
    }
}
