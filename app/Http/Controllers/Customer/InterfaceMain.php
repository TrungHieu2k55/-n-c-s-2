<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Admin\mdProductBT;
use Illuminate\Http\Request;
use App\Models\Admin\mdProduct;
use App\Models\Admin\mdCategory;
use App\Models\Admin\Image;
use App\Models\order;
use App\Models\carts;
use App\Models\orderdetail;
use Illuminate\Support\Facades\Session;


use Illuminate\Support\Facades\Auth;

class InterfaceMain extends Controller
{
    public function indexMain($ma_loai = null)
    {
        $ma_khach_hang = session('ma_khach_hang');
        $carts = carts::where('ma_khach_hang', $ma_khach_hang)
            ->with('productVariant.sanPham.hinhAnhs', 'productVariant.kichThuoc', 'productVariant.mau')
            ->get();
        $rootCategories = mdCategory::tree();
        $query = mdProduct::query();
        $title = "Sản Phẩm";
        $title2 = $this->buildCategoryTitle($ma_loai);

        if ($ma_loai) {
            // Lấy sản phẩm theo mã danh mục nếu tồn tại
            $categoryIds = mdCategory::where('ma_loai', $ma_loai)
                ->orWhere('ma_danh_muc_cha', $ma_loai)
                ->pluck('ma_loai')
                ->toArray();
            $query->whereIn('ma_loai', $categoryIds);
        } else {
            $sanphamYeuThich = $query->orderByDesc('luot_xem')->take(8)->get();
            if (!$sanphamYeuThich->isEmpty()) {
                $title = "Sản Phẩm Bán Chạy";
                $title2 = null;
            }
        }

        $sanpham = $query->with('hinhAnhs')->paginate(8);
        $anh = Image::all();

        // Kiểm tra nếu không có sản phẩm nào thỏa mãn điều kiện luot_xem và ma_loai, lấy tất cả sản phẩm
        if ($sanpham->isEmpty()) {
            $sanpham = mdProduct::with('hinhAnhs')->paginate(6);
            $title2 = null;
        }
        $customer = Auth::guard('customers')->user();
        // dd($customer);
        // Lấy sản phẩm mới
        $productMoi = mdProduct::orderBy('ngay_tao', 'desc')->take(6)->get();

        // Lấy theo lịch sử mua hàng
        $suggestedProducts = $this->suggestProductsBasedOnHistory($ma_khach_hang);
        session()->push('flash_notification', [
            'type' => 'info',
            'message' => 'Welcome to admin',
            'title' => 'Đăng nhập'
        ]);
        return view('customer.contentinter', compact('sanpham', 'anh', 'rootCategories', 'title', 'title2', 'customer', 'productMoi', 'carts', 'suggestedProducts'));
    }

    private function getPurchaseHistory($customerId)
    {
        // Lấy tất cả các đơn hàng của khách hàng
        $orders = Order::where('ma_khach_hang', $customerId)->with('orderDetails.productVariant.sanPham')->get();
        return $orders;
    }

    private function getRelatedCategories($customerId)
    {
        $orders = $this->getPurchaseHistory($customerId);

        $categories = collect();

        foreach ($orders as $order) {
            foreach ($order->orderDetails as $detail) {
                $categories->push($detail->productVariant->sanPham->ma_loai);
            }
        }

        // Lấy danh mục duy nhất
        $uniqueCategories = $categories->unique();

        return $uniqueCategories;
    }

    private function suggestProductsBasedOnHistory($customerId)
    {
        $categories = $this->getRelatedCategories($customerId);

        $suggestedProducts = collect();

        foreach ($categories as $categoryId) {
            $products = mdProduct::where('ma_loai', $categoryId)->with('hinhAnhs')->get();
            $suggestedProducts = $suggestedProducts->merge($products);
        }

        return $suggestedProducts;
    }


    private function buildCategoryTitle($ma_loai)
    {
        $category = mdCategory::where('ma_loai', $ma_loai)->first();
        $titleParts = [];
        while ($category) {
            array_unshift($titleParts, $category->ten_loai); // Sử dụng 'ten_loai' thay vì 'ten_danh_muc'
            $category = mdCategory::where('ma_loai', $category->ma_danh_muc_cha)->first();
        }

        return 'Sản phẩm' . (!empty($titleParts) ? ' > ' . implode(' > ', $titleParts) : '');
    }

    public function increaseView($ma_san_pham)
    {
        $product = mdProduct::find($ma_san_pham);
        if ($product) {
            $product->luot_xem += 1;
            $product->save();
        }
        return redirect()->route('detail', ['ma_san_pham' => $ma_san_pham]);
    }

    public function indexdetail($ma_san_pham)
    {
        $ma_khach_hang = session('ma_khach_hang');
        $carts = carts::where('ma_khach_hang', $ma_khach_hang)->with('productVariant.sanPham.hinhAnhs', 'productVariant.kichThuoc', 'productVariant.mau')->get();
        $rootCategories = mdCategory::tree();
        $sanpham = mdProduct::with('hinhAnhs', 'bienThe.mau', 'bienThe.kichThuoc')
            ->where('ma_san_pham', $ma_san_pham)
            ->firstOrFail();


        $relatedProducts = mdProduct::where('ma_loai', $sanpham->ma_loai)
            ->where('ma_san_pham', '!=', $sanpham->ma_san_pham)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        $customer = Auth::guard('customers')->user();
        return view('customer.detailinter', compact('sanpham', 'rootCategories', 'relatedProducts', 'customer', 'carts'));
    }


    public function searchde(Request $request)
    {
        $ma_khach_hang = session('ma_khach_hang');
        $carts = carts::where('ma_khach_hang', $ma_khach_hang)
            ->with('productVariant.sanPham.hinhAnhs', 'productVariant.kichThuoc', 'productVariant.mau')
            ->get();
        $search = $request->input('search');

        if ($search !== null && strlen($search) >= 3) {
            $sanpham = mdProduct::where('ten_san_pham', 'like', '%' . $search . '%')->get();
        } else {
            $sanpham = mdProduct::all();
        }
        $title = "Kết quả tìm kiếm: {$search}";
        // Assuming $rootCategories needs to be passed to the headerinter view as well
        $rootCategories = mdCategory::all(); // Adjust according to your actual model and data retrieval logic

        return view('customer.searchinter', compact('sanpham', 'rootCategories', 'title', 'carts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'ma_mau' => 'required',
            'ma_kich_thuoc' => 'required',
            'so_luong' => 'required|numeric|min:1',
        ]);



        $product = [
            'ma_mau' => $request->ma_mau,
            'ma_kich_thuoc' => $request->ma_kich_thuoc,
            'so_luong' => $request->so_luong,
        ];

        $cart[] = $product;

        session()->put('cart', $cart);

        // Gửi thông báo thành công
        session()->push('addToCart', [
            'type' => 'success',
            'message' => 'Thêm vào giỏ hàng thành công!',
            'title' => 'Success'
        ]);


        return redirect()->back();
    }
}
