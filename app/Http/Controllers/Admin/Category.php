<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\mdCategory;
use Flasher\Toastr\Laravel\Facade\Toastr;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $danhmuc = mdCategory::all(); // Lấy tất cả các danh mục từ bảng Category
        // Toastr::success('Welcome to my app!', 'Success');
        return view('administrators.add.addcategory', compact('danhmuc'));
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
                'ten_loai' => 'required|string|max:255',
                'ma_danh_muc_cha' => 'nullable|integer|exists:danhmuc,ma_loai'
            ]);

            $danhmuc = new mdCategory;
            $danhmuc->ten_loai = $validatedData['ten_loai'];
            $danhmuc->ma_danh_muc_cha = $validatedData['ma_danh_muc_cha'];
            $danhmuc->save();
            session()->push('san_Pham', [
                'type' => 'success',
                'message' => 'Thêm thành công',
                'title' => 'Success'
            ]);
            return redirect()->back()->with('success', 'Thêm mới thành công<script>setTimeout(function() { window.location.href = "' . route('Category') . '"; }, 5);</script>');
        } catch (\Exception $e) {
            session()->push('san_Pham', [
                'type' => 'error',
                'message' => 'Thêm thất bại',
                'title' => 'Error'
            ]);
            return redirect()->back()->with('error', 'Thêm mới thất bại: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ma_loai)
    {
        try {
            $danhmuc = mdCategory::findOrFail($ma_loai);
            $danhmucList = mdCategory::all(); // Lấy danh sách danh mục để hiển thị trong dropdown
            return view('administrators.edit.editcategory', compact('danhmuc', 'danhmucList'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không tìm thấy đối tượng: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ma_loai)
    {
        $validatedData = $request->validate([
            'ten_loai' => 'required|string|max:255',
            'ma_danh_muc_cha' => 'nullable|integer|exists:danhmuc,ma_loai',
        ]);
        $danhmuc = mdCategory::findOrFail($ma_loai);
        $danhmuc->update([
            'ten_loai' => $validatedData['ten_loai'],
            'ma_danh_muc_cha' => $validatedData['ma_danh_muc_cha'],
        ]);
        return redirect()->route('Category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ma_loai)
    {
        $danhmuc = mdCategory::findOrFail($ma_loai)->delete();
        return redirect()->route('Category');
    }
    public function search(Request $request)
    {
        $searchdm = $request->input('search');

        $danhmuc = mdCategory::where('ten_loai', 'like', '%' . $searchdm . '%')
            ->orWhere('ma_loai', 'like', '%' . $searchdm . '%')
            ->orWhere('ma_danh_muc_cha', 'like', '%' . $searchdm . '%')
            ->paginate(5);

        // Trả về view với dữ liệu tìm kiếm
        return view('administrators.list.category', compact('danhmuc'));
    }
}
