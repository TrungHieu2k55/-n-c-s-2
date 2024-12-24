<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Admin\mdProduct;
use App\Models\Admin\mdCategory;
use App\Models\Admin\mdSize;
use App\Models\Admin\Image;
use App\Models\order;
use App\Models\Customer;
use App\Models\orderdetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\mdProductBT;
use App\Helper\Cart;
use App\Models\vorcher;
use App\Models\carts;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function Cartindex()
    {
        $rootCategories = mdCategory::tree();
        // Lấy mã khách hàng từ session (nếu bạn lưu mã khách hàng trong session)
        $ma_khach_hang = session('ma_khach_hang');
        if (!$ma_khach_hang) {
            return redirect()->route('login')->with('error', 'Bạn cần phải đăng nhập để xem giỏ hàng.');
        }

        // Lấy các sản phẩm trong giỏ hàng của khách hàng từ cơ sở dữ liệu
        $carts = carts::where('ma_khach_hang', $ma_khach_hang)->with('productVariant.sanPham.hinhAnhs', 'productVariant.kichThuoc', 'productVariant.mau')->get();

        // Tính tổng tiền
        $totalSum = $carts->sum(function ($cart) {
            return $cart->productVariant->sanPham->gia_ban * $cart->so_luong;
        });

        return view('customer.cartinter', compact('carts', 'rootCategories', 'totalSum'));
    }


    public function addcart(Request $request)
    {
        // Lấy ma_khach_hang từ session
        $ma_khach_hang = session('ma_khach_hang');

        // Kiểm tra xem khách hàng đã đăng nhập chưa
        if (!$ma_khach_hang) {
            return redirect()->route('login')->with('error', 'Bạn cần phải đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        // Kiểm tra xem người dùng đã chọn màu sắc và kích thước chưa
        if (empty($request->selected_colors)) {
            return redirect()->back()->with('error', 'Vui lòng chọn màu sắc.');
        }

        if (empty($request->selected_size)) {
            return redirect()->back()->with('error', 'Vui lòng chọn kích thước.');
        }

        $sanpham = mdProduct::find($request->ma_san_pham);
        $selectedColors = $request->selected_colors;
        $selectedSize = $request->selected_size;

        $images = $sanpham->hinhAnhs;
        $duong_dan = $images->isNotEmpty() ? $images->first()->duong_dan : '';
        $quantity = $request->so_luong;
        $mabienthe = $sanpham->bienThe()
            ->where('ma_mau', $selectedColors)
            ->where('ma_kich_thuoc', $selectedSize)
            ->first();

        // Kiểm tra xem biến thể sản phẩm có tồn tại không
        if (!$mabienthe) {
            return redirect()->back()->with('error', 'Biến thể sản phẩm không tồn tại.');
        }

        $ma_bien_the = $mabienthe->ma_bien_the;
        $so_luong_ton = $mabienthe->so_luong_ton;

        // Kiểm tra xem số lượng tồn kho có đủ không
        if ($quantity > $so_luong_ton) {
            return redirect()->back()->with('error', 'Số lượng tồn kho không đủ.');
        }

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $existingCart = carts::where('ma_khach_hang', $ma_khach_hang)
            ->where('ma_bien_the', $ma_bien_the)
            ->first();

        if ($existingCart) {
            return redirect()->back()->with('error', 'Sản phẩm đã có trong giỏ hàng.');
        }

        // Tạo bản ghi giỏ hàng mới
        carts::create([
            'ma_khach_hang' => $ma_khach_hang,
            'ma_bien_the' => $ma_bien_the,
            'so_luong' => $quantity,
            'ngay_tao' => now(),
            'ngay_cap_nhat' => now()
        ]);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
    public function delete($ma_bien_the)
    {
        // Tìm biến thể trong giỏ hàng để xóa
        $cartItem = carts::where('ma_bien_the', $ma_bien_the)->first();
        $cartItem->delete();
        return redirect()->back();
    }

    // Mua ngay
    public function buyNow(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        // $validated = $request->validate([
        //     'ma_san_pham' => 'required|exists:sanphams,ma_san_pham',
        //     'so_luong' => 'required|integer|min:1',
        //     'selected_colors' => 'required',
        //     'selected_size' => 'required',
        // ]);

        // Xử lý mua ngay
        // ... (thêm logic mua hàng của bạn ở đây)

        // Ví dụ: Điều hướng người dùng đến trang thanh toán
        return redirect()->route('customer.oderinter')->with('success', 'Bạn đã mua hàng thành công!');
    }

    //ĐƠN HÀNG
    public function indexOder()
    {
        $rootCategories = mdCategory::tree();
        if (Auth::guard('customers')->check()) {
            $ma_khach_hang = session('ma_khach_hang');
            $customer = Customer::where('ma_khach_hang', $ma_khach_hang)->first();

            if (!$customer) {
                return redirect()->route('login')->with('error', 'Không tìm thấy thông tin khách hàng.');
            }

            // Lấy các sản phẩm trong giỏ hàng của khách hàng từ cơ sở dữ liệu
            $carts = carts::where('ma_khach_hang', $ma_khach_hang)
                ->with('productVariant.sanPham.hinhAnhs', 'productVariant.kichThuoc', 'productVariant.mau')
                ->get();

            // Tính tổng tiền
            $totalSum = $carts->sum(function ($cart) {
                return $cart->productVariant->sanPham->gia_ban * $cart->so_luong;
            });

            $vouchers = Vorcher::where('gia_ap_dung', '<=', $totalSum)->get();

            $discount = 0;
            $voucherId = null;

            if (request()->has('ma_ap_dung')) {
                $inputVoucherCode = request('ma_ap_dung');
                $voucher = Vorcher::where('ma_ap_dung', $inputVoucherCode)->first();
            }
            // Tính tổng cộng sau khi áp dụng chiết khấu
            $totalAfterDiscount = $totalSum - $discount;

            return view('customer.oderinter', compact('customer', 'carts', 'totalSum', 'discount', 'totalAfterDiscount', 'vouchers', 'rootCategories'));
        } else {
            // Nếu chưa đăng nhập, chuyển hướng về trang login và thông báo
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán đơn hàng.');
        }
    }


    public function applyVoucher(Request $request)
    {
        $voucherCode = $request->input('ma_ap_dung'); // Lấy mã áp dụng từ request
        $discount = 0;

        // Tính lại tổng tiền từ giỏ hàng của khách hàng
        $ma_khach_hang = session('ma_khach_hang');
        $carts = carts::where('ma_khach_hang', $ma_khach_hang)
            ->with('productVariant.sanPham')
            ->get();

        $totalSum = $carts->sum(function ($cart) {
            return $cart->productVariant->sanPham->gia_ban * $cart->so_luong;
        });

        // Tìm mã giảm giá từ CSDL dựa trên ma_ap_dung
        $voucher = vorcher::where('ma_ap_dung', $voucherCode)->first();

        if ($voucher) {
            // Lấy ma_khuyen_mai và phan_tram_khuyen_mai từ voucher
            $ma_khuyen_mai = $voucher->ma_khuyen_mai;
            $phan_tram_khuyen_mai = $voucher->phan_tram_khuyen_mai;

            // Tính toán chiết khấu
            $discount = $totalSum * ($phan_tram_khuyen_mai / 100);
        }

        // Tính lại tổng cộng sau khi áp dụng chiết khấu
        $totalAfterDiscount = $totalSum - $discount;

        // Trả về dữ liệu dưới dạng JSON cho view
        return response()->json([
            'discount' => number_format($discount, 0, '.', '.') . ' VNĐ',
            'total' => number_format($totalAfterDiscount, 0, '.', '.') . ' VNĐ',
        ]);
    }

    public function storeOrder(Request $request)
    {
        // Validate and retrieve payment method from request
        $paymentMethod = $request->input('payment_method');


        // Check if payment method is valid
        if (!in_array($paymentMethod, ['vnpay', 'cod'])) {
            // Handle invalid payment method scenario
            return redirect()->back()->with('error', 'Vui lòng chọn phương thức thanh toán!');
        }
        if ($paymentMethod === 'vnpay') {

            return $this->VNP($request);
            //  return redirect()->back()->with('success', 'Lưu đơn hàng vào session thành công!');
        } else {
            // For 'cod' method, proceed to process the order
            return $this->processOrder($request);
        }
    }

    protected function processOrder(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
        $carts = carts::where('ma_khach_hang', auth('customers')->id())->get();
        $maApDung = $request->input('ma_ap_dung');
        $voucher = vorcher::where('ma_ap_dung', $maApDung)->first();

        // Tạo đơn hàng mới
        $order = Order::create([
            'ma_khach_hang' => auth('customers')->id(),
            'ma_nhan_vien' => null,
            'trang_thai' => '0',
            'ghi_chu' => $request->ghi_chu,
            'ma_khuyen_mai' => $voucher ? $voucher->ma_khuyen_mai : null,
        ]);
        //  dd($order);
        // Thêm các chi tiết đơn hàng
        foreach ($carts as $cart) {
            OrderDetail::create([
                'ma_don_hang' => $order->ma_don_hang,
                'ma_bien_the' => $cart->ma_bien_the,
                'so_luong' => $cart->so_luong,
                'tong_tien' => $cart->productVariant->sanPham->gia_ban * $cart->so_luong,
            ]);

            // Cập nhật tồn kho
            $productVariant = mdProductBT::find($cart->ma_bien_the);
            if ($productVariant) {
                $productVariant->so_luong_ton -= $cart->so_luong;
                $productVariant->save();
            }
        }

        $totalAmount = floatval(str_replace(['VNĐ', '.'], '', $request->input('totalPricess')));
        $discountInput = $request->input('chiet_khau');
        $discountAmount = $discountInput ? floatval(str_replace(['VNĐ', '.'], '', $discountInput)) : 0;
        // $discountAmount = floatval(str_replace(['VNĐ', '.'], '', $request->input('chiet_khau')));
        $trangThaiThanhToan = ($paymentMethod === 'vnpay') ? 1 : 0;
        $ngayThanhToan = ($paymentMethod === 'vnpay') ? Carbon::now() : null;
        $payments = Payment::create([
            'ma_don_hang' => $order->ma_don_hang,
            'phuong_thuc_thanh_toan' => $paymentMethod,
            'trang_thai_thanh_toan' => $trangThaiThanhToan,
            'ngay_thanh_toan' => $ngayThanhToan,
            'chiet_khau' => $discountAmount,
            'so_tien' => $totalAmount
        ]);
        // Xóa giỏ hàng sau khi đặt hàng
        carts::where('ma_khach_hang', auth('customers')->id())->delete();

        // Redirect về trang index với thông báo thành công
        return redirect()->away('http://127.0.0.1:8000/cart')->with('success', 'THÀNH CÔNG!');
        //return response()->json(['success' => true, 'message' => 'Đặt hàng thành công và lưu vào cơ sở dữ liệu!']);
    }

    protected function VNP(Request $request)
    {

        try {

            $total = isset($_POST['totalPricess']) ? $_POST['totalPricess'] : 0.00;
            $totalAmount = floatval(str_replace('.', '', $total));
            $discount = isset($_POST['chiet_khau']) ? $_POST['chiet_khau'] : 0.00;
            $discountAmount = floatval(str_replace('.', '', $discount));
            $paymentMethod = $request->input('payment_method');
            $carts = carts::where('ma_khach_hang', auth('customers')->id())->get();
            $maApDung = $request->input('ma_ap_dung');
            $voucher = vorcher::where('ma_ap_dung', $maApDung)->first();
            $trangThaiThanhToan = ($paymentMethod === 'vnpay') ? 1 : 0;
            $ngayThanhToan = ($paymentMethod === 'vnpay') ? Carbon::now() : null;

            // Tạo đơn hàng
            // Tạo đối tượng đơn hàng mà không lưu vào cơ sở dữ liệu
            $order = new Order([
                'ma_khach_hang' => auth('customers')->id(),
                'ma_nhan_vien' => null,
                'trang_thai' => '1',
                'ghi_chu' => $request->ghi_chu,
                'ma_khuyen_mai' => $voucher ? $voucher->ma_khuyen_mai : null,
            ]);

            // Tạo đối tượng chi tiết đơn hàng mà không lưu vào cơ sở dữ liệu
            $orderDetails = [];
            foreach ($carts as $cart) {
                $orderDetail = new OrderDetail([
                    'ma_don_hang' => $order->ma_don_hang,
                    'ma_bien_the' => $cart->ma_bien_the,
                    'so_luong' => $cart->so_luong,
                    'tong_tien' => $cart->productVariant->sanPham->gia_ban * $cart->so_luong,
                ]);
                $orderDetails[] = $orderDetail;
            }

            // Tạo đối tượng thanh toán mà không lưu vào cơ sở dữ liệu
            $payment = new Payment([
                'ma_don_hang' => $order->ma_don_hang,
                'phuong_thuc_thanh_toan' => $paymentMethod,
                'trang_thai_thanh_toan' => $trangThaiThanhToan,
                'ngay_thanh_toan' => $ngayThanhToan,
                'chiet_khau' => $discountAmount,
                'so_tien' => $totalAmount
            ]);

            // Lưu thông tin vào session
            session()->put('order_info', [
                'order' => $order,
                'order_details' => $orderDetails,
                'payment' => $payment
            ]);

            // Để kiểm tra dữ liệu lưu vào session
            //dd(session()->get('order_info'));
            $vnp_TxnRef = time() . '_' . rand(1000, 9999);

            // Thông tin đơn hàng
            $vnp_OrderInfo = 'Thanh toán đơn hàng';
            $vnp_OrderType = 'billpayment';

            $vnp_Amount = $totalAmount * 100;


            // Thông tin thanh toán
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            // TODO: Định nghĩa $vnp_TmnCode và $vnp_HashSecret


            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html"; // TODO: Đặt giá trị chính xác từ VNPAY
            $vnp_Returnurl = route('payment.callback'); // TODO: Đặt giá trị chính xác từ VNPAY
            $vnp_TmnCode = "2L6VPKY5";
            $vnp_HashSecret = "0EKOF153V2QHR4SI1220A4312MS86L7F";

            // Các tham số thanh toán
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,

            );

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";

            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }


            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            );

            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }

            return redirect()->to($vnp_Url);
        } catch (\Exception $e) {
            // Xử lý lỗi và trả về thông báo lỗi
            return redirect()->back()->with(['error' => 'Có lỗi xảy ra trong quá trình chuẩn bị thanh toán. Vui lòng thử lại sau.']);
        }
    }

    protected function callback(Request $request)
    {
        try {
            // Lấy dữ liệu callback từ VNPay
            $vnp_SecureHash = $request->vnp_SecureHash;
            $inputData = $request->all();
            unset($inputData['vnp_SecureHashType']);
            unset($inputData['vnp_SecureHash']);

            // Sắp xếp dữ liệu theo key
            ksort($inputData);
            //  $paymentMethod = $request->input('payment_method');
            $responseCode = $request->vnp_ResponseCode;
            if ($responseCode == '00') {

                // Truy xuất thông tin từ session
                $orderInfo = session()->get('order_info');

                $order = $orderInfo['order'];
                $orderDetails = $orderInfo['order_details'];
                $payment = $orderInfo['payment'];

                // Lưu đơn hàng vào cơ sở dữ liệu
                $order->save();

                // Cập nhật `ma_don_hang` cho các chi tiết đơn hàng và lưu vào cơ sở dữ liệu
                foreach ($orderDetails as $orderDetail) {
                    $orderDetail->ma_don_hang = $order->ma_don_hang;
                    $orderDetail->save();

                    // Cập nhật tồn kho
                    $productVariant = mdProductBT::find($orderDetail->ma_bien_the);
                    if ($productVariant) {
                        $productVariant->so_luong_ton -= $orderDetail->so_luong;
                        $productVariant->save();
                    }
                }

                // Cập nhật `ma_don_hang` cho thông tin thanh toán và lưu vào cơ sở dữ liệu
                $payment->ma_don_hang = $order->ma_don_hang;
                $payment->save();

                // Xóa thông tin khỏi session sau khi đã lưu vào cơ sở dữ liệu
                session()->forget('order_info');
                //carts::where('ma_khach_hang', auth()->id())->delete();
                carts::where('ma_khach_hang', auth('customers')->id())->delete();
                // Trả về kết quả thành công cho VNPay
                return redirect()->away('http://127.0.0.1:8000/cart')->with('success', 'THÀNH CÔNG!');
            } else {
                // Xử lý thanh toán thất bại
                return redirect()->away('http://127.0.0.1:8000/cart')->with('error', 'Lỗi!');
            }
        } catch (\Exception $e) {
            // Xử lý khi có lỗi xảy ra
            return redirect()->away('http://127.0.0.1:8000/cart')->with('error', 'Lỗi!');
        }
    }


    public function cancelOrder($ma_don_hang)
    {
        $order = Order::findOrFail($ma_don_hang);
        $order->trang_thai = 3; // Đánh dấu trạng thái hủy đơn hàng
        $order->save();

        // Cập nhật số lượng tồn kho (nếu cần)
        foreach ($order->orderDetails as $orderDetail) {
            $productBT = $orderDetail->productVariant;
            $productBT->increaseInventory($orderDetail->so_luong);
        }

        return redirect()->back()->with('success', 'Bạn đã hủy thành công 1 đơn hàng.');
    }
}
