<?php

namespace App\Http\Controllers\Admin;

use Toastr;
use App\Http\Controllers\Controller;
use App\Models\Admin\mdCategory;
use Illuminate\Http\Request;
use App\Models\Admin\Image;
use App\Models\Admin\mdProduct;
use App\Models\Admin\mdProductBT;
use App\Models\Admin\mdSize;
use App\Models\Admin\mdColor;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;


class product extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mausac = mdColor::all();
        $kichthuoc = mdSize::all();
        $danhmuc = mdCategory::tree();
        $sanpham = mdProduct::all();
        return view('administrators.add.addproduct', compact('danhmuc', 'mausac', 'kichthuoc', 'sanpham'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $user = Auth::user();
            $validatedData = $request->validate([
                'ten_san_pham' => 'required|exists:sanpham,ten_san_pham',
                'ma_mau' => 'required|exists:mausac,ma_mau',
                'selected_kich_thuoc' => 'nullable|exists:kichthuoc,ma_kich_thuoc',
                'so_luong_ton' => 'required|integer|min:0',
            ]);

            $sanPham = mdProduct::where('ten_san_pham', $validatedData['ten_san_pham'])->first();
            if (!$sanPham) {
                return response()->json(['error' => 'Sản phẩm không tồn tại.'], 400);
            }

            mdProductBT::create([
                'ma_san_pham' => $sanPham->ma_san_pham,
                'ma_mau' => $validatedData['ma_mau'],
                'ma_kich_thuoc' => $validatedData['selected_kich_thuoc'],
                'so_luong_ton' => $validatedData['so_luong_ton'],
                'ma_nhan_vien' => $user->ma_nhan_vien,
            ]);

            session()->push('flash_notification', [
                'type' => 'success',
                'message' => 'Thêm mới sản phẩm thành công',
                'title' => 'Success'
            ]);
            return redirect()->back();
        } catch (Exception $e) {
            session()->push('flash_notification', [
                'type' => 'error',
                'message' => 'Thêm mới sản phẩm thất bại',
                'title' => 'Error'
            ]);
            // Log::error('Lỗi khi thêm mới sản phẩm:', ['error' => $e->getMessage()]);
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        // dd(session()->all());
        try {
            // Validate form data
            $validatedData = $request->validate([
                'ten_san_pham' => 'required|string|max:255',
                'ma_loai' => 'required|exists:danhmuc,ma_loai',
                'gia_nhap' => 'required|numeric',
                'gia_ban' => 'required|numeric',
                'thuong_hieu' => 'required|string|max:255',
                'chat_lieu' => 'required|string|max:255',
                'mo_ta' => 'required|string',
                'duong_dan.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            ]);

            // 
            $product = mdProduct::create([
                'ten_san_pham' => $validatedData['ten_san_pham'],
                'ma_loai' => $validatedData['ma_loai'],
                'gia_nhap' => $validatedData['gia_nhap'],
                'gia_ban' => $validatedData['gia_ban'],
                'thuong_hieu' => $validatedData['thuong_hieu'],
                'chat_lieu' => $validatedData['chat_lieu'],
                'mo_ta' => $validatedData['mo_ta'],
            ]);

            $ma_san_pham = $product->ma_san_pham;

            // Process images
            if ($request->hasFile('duong_dan')) {
                foreach ($request->file('duong_dan') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $imagePath = $image->move(public_path('storage/images'), $imageName);
                    Image::create([
                        'ma_san_pham' => $ma_san_pham,
                        'duong_dan' => $imageName,
                    ]);
                }
            }
            // Gửi thông báo thành công
            session()->push('flash_notification', [
                'type' => 'success',
                'message' => 'Thêm mới sản phẩm thành công',
                'title' => 'Success'
            ]);

            return redirect()->route('add.product');
        } catch (Exception $e) {
            Log::error('Lỗi khi thêm mới sản phẩm:', ['error' => $e->getMessage()]);

            // Gửi thông báo lỗi
            // Toastr::error('Thêm mới sản phẩm thất bại: ' . $e->getMessage(), ['title' => 'Lỗi'], 'lỗi');
            session()->push('flash_notification', [
                'type' => 'error',
                'message' => 'Thêm mới sản phẩm thất bại',
                'title' => 'Error'
            ]);

            return redirect()->back();
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $danhmuc = mdCategory::all();
        $bienthe = mdProductBT::with(['sanPham', 'mau', 'kichThuoc', 'sanPham.hinhAnhs'])->get();
        //
        return view('administrators.list.product', compact('bienthe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($ma_san_pham, $ma_bien_the)
    {
        $sanpham = mdProduct::findOrFail($ma_san_pham);
        $bienthe = mdProductBT::findOrFail($ma_bien_the);
        $danhmuc = mdCategory::all(); // Giả sử bạn có một model DanhMuc cho danh mục sản phẩm
        $mausac = mdColor::all();
        $kichthuoc = mdSize::all();
        $hinhanh = Image::where('ma_san_pham', $ma_san_pham)->first(); // Lấy ảnh đầu tiên
        return view('administrators.edit.editproduct', compact('sanpham', 'bienthe', 'danhmuc', 'mausac', 'kichthuoc', 'hinhanh'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatesp(Request $request, $ma_san_pham)
    {
        try {
            // Validate form data
            $validatedData = $request->validate([
                'ten_san_pham' => 'required|string|max:255',
                'ma_loai' => 'required|exists:danhmuc,ma_loai',
                'gia_nhap' => 'required|numeric',
                'gia_ban' => 'required|numeric',
                'thuong_hieu' => 'required|string|max:255',
                'chat_lieu' => 'required|string|max:255',
                'mo_ta' => 'required|string',
                'duong_dan.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            ]);

            $product = mdProduct::findOrFail($ma_san_pham);
            $product->update([
                'ten_san_pham' => $validatedData['ten_san_pham'],
                'ma_loai' => $validatedData['ma_loai'],
                'gia_nhap' => $validatedData['gia_nhap'],
                'gia_ban' => $validatedData['gia_ban'],
                'thuong_hieu' => $validatedData['thuong_hieu'],
                'chat_lieu' => $validatedData['chat_lieu'],
                'mo_ta' => $validatedData['mo_ta'],
            ]);
            $product->$ma_san_pham = $product->ma_san_pham;

            // Process images
            if ($request->hasFile('duong_dan')) {
                // Lấy hình ảnh cũ
                $oldImages = Image::where('ma_san_pham', $ma_san_pham)->get();

                // Xóa hình ảnh cũ khỏi server và CSDL
                foreach ($oldImages as $oldImage) {
                    $oldImagePath = public_path('storage/images/' . $oldImage->duong_dan);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath); // Xóa file vật lý
                    }
                    $oldImage->delete(); // Xóa khỏi database
                }

                // Lưu hình ảnh mới
                foreach ($request->file('duong_dan') as $image) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('storage/images'), $imageName);
                    Image::create([
                        'ma_san_pham' => $ma_san_pham,
                        'duong_dan' => $imageName,
                    ]);
                }
            }
            // Gửi thông báo thành công
            session()->push('flash_notification', [
                'type' => 'success',
                'message' => 'Cập nhật sản phẩm thành công! ấy',
                'title' => 'Update'
            ]);
            return redirect()->back()->with('success', 'cập nhật sản phẩm thành công!');
        } catch (Exception $e) {
            Log::error('Lỗi khi thêm mới sản phẩm:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'cập nhật sản phẩm thất bại: ' . $e->getMessage());
            // Gửi thông báo thành công
            session()->push('flash_notification', [
                'type' => 'error',
                'message' => 'cập nhật sản phẩm thất bại',
                'title' => 'Update'
            ]);
        }
    }
    public function updatebt(Request $request, $ma_bien_the)
    {
        try {
            // Validate form data
            $validatedData = $request->validate([
                'so_luong_ton' => 'required|numeric',
                'hinh_anh' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra file hình ảnh
            ]);

            $user = Auth::user();
            $product = mdProductBT::findOrFail($ma_bien_the);

            // Kiểm tra và xử lý việc upload hình ảnh
            if ($request->hasFile('hinh_anh')) {
                // Lưu hình ảnh vào thư mục storage/app/public/hinh_anh_san_pham
                $imagePath = $request->file('hinh_anh')->store('images', 'public');

                // Xóa hình ảnh cũ nếu có (nếu bạn muốn)
                if ($product->hinh_anh) {
                    Storage::delete('public/' . $product->hinh_anh);
                }

                // Cập nhật đường dẫn hình ảnh mới vào cơ sở dữ liệu
                $product->hinh_anh = $imagePath;
            }

            // Cập nhật các thông tin còn lại
            $product->so_luong_ton = $validatedData['so_luong_ton'];
            $product->ma_nhan_vien = $user->ma_nhan_vien;
            $product->save();
            session()->push('flash_notification', [
                'type' => 'success',
                'message' => 'Cập nhật sản phẩm thành công! nè',
                'title' => 'Update'
            ]);
            return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (Exception $e) {
            Log::error('Lỗi khi cập nhật sản phẩm biến thể:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Cập nhật sản phẩm biến thể thất bại: ' . $e->getMessage());
            session()->push('flash_notification', [
                'type' => 'error',
                'message' => 'cập nhật sản phẩm thất bại',
                'title' => 'Update'
            ]);
        }
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
        try {
            // Tìm sản phẩm theo ID
            $product = mdProduct::findOrFail($id);

            // Xóa tất cả các biến thể liên quan
            $product->bienthe()->delete();

            // Xóa sản phẩm
            $product->delete();

            // Gửi thông báo thành công
            session()->flash('success', 'Xóa sản phẩm thành công!');
            return redirect()->route('add.product'); // Chuyển hướng về trang danh sách sản phẩm
        } catch (Exception $e) {
            Log::error('Lỗi khi xóa sản phẩm:', ['error' => $e->getMessage()]);

            // Gửi thông báo lỗi
            session()->flash('error', 'Xóa sản phẩm thất bại: ' . $e->getMessage());
            return redirect()->back(); // Quay lại trang trước
        }
    }
}
