<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\mdCategory;
use App\Models\carts;
use App\Models\order;
class signup extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer.signupcus');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate dữ liệu
            $validatedData = $request->validate([
                'ten_khach_hang' => 'required|string|max:255',
                'so_dien_thoai' => 'required|numeric',
                'ngay_sinh' => 'required|date',
                'gioi_tinh' => 'required|string',
                'dia_chi' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'mat_khau' => 'required|string|min:8',
            ]);
            
            $validatedData['gioi_tinh'] = $validatedData['gioi_tinh'] === 'Nam' ? 1 : 0;
        
            // Bắt đầu giao dịch cơ sở dữ liệu
            DB::beginTransaction();
            
            // Tạo người dùng mới
            $user = Customer::create([
                'ten_khach_hang' => $validatedData['ten_khach_hang'],
                'so_dien_thoai' => $validatedData['so_dien_thoai'],
                'ngay_sinh' => $validatedData['ngay_sinh'],
                'gioi_tinh' => $validatedData['gioi_tinh'],
                'dia_chi' => $validatedData['dia_chi'],
                'email' => $validatedData['email'],
                'mat_khau' => Hash::make($validatedData['mat_khau']),
            ]);
            // Hoàn tất giao dịch
            DB::commit();
            // Chuyển hướng và hiển thị thông báo thành công
            return redirect()->route('login')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            // Hủy bỏ giao dịch nếu có lỗi
            DB::rollBack();
            // Chuyển hướng và hiển thị thông báo lỗi
            return redirect()->back()->with('success', 'Thêm mới thất bại: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ma_khach_hang)
    {
       // dd($ma_khach_hang);
        $rootCategories = mdCategory::tree();
            // Lấy thông tin khách hàng
            $customer = Customer::where('ma_khach_hang', $ma_khach_hang)->first();
            // Lấy đơn hàng của khách hàng
            $orders = Order::where('ma_khach_hang', $ma_khach_hang)
                ->with('orderDetails', 'payment')
                ->get();
            // Lấy giỏ hàng của khách hàng
            $carts = carts::where('ma_khach_hang', $ma_khach_hang)
                ->with('productVariant.sanPham.hinhAnhs', 'productVariant.kichThuoc', 'productVariant.mau')
                ->get();
            return view('customer.account', compact('rootCategories', 'carts', 'customer', 'orders'));
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ma_khach_hang)
    {
      //  dd($request->all());
        // Tìm khách hàng theo ID và cập nhật thông tin
        $customer = Customer::find($ma_khach_hang);
    
        if (!$customer) {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng.');
        }
    
        $customer->update([
            'ten_khach_hang' => $request->ten_khach_hang,
            'email' => $request->email,
            'so_dien_thoai' => $request->so_dien_thoai,
            'ngay_sinh' => $request->ngay_sinh,
            'dia_chi' => $request->dia_chi,
        ]);
    
        // Redirect về trang thông tin cá nhân với thông báo thành công
        return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công!');
    }

    public function updatemk(Request $request, $ma_khach_hang)
    {
      //  dd($request->all());
        // Tìm khách hàng theo ID và cập nhật thông tin
        $customer = Customer::find($ma_khach_hang);
    
        if (!$customer) {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng.');
        }
    
        $customer->update([
            'mat_khau' => Hash::make($request->mat_khau),
        ]);
    
        // Redirect về trang thông tin cá nhân với thông báo thành công
        return redirect()->back()->with('success', 'Thông tin cá nhân đã được cập nhật thành công!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
