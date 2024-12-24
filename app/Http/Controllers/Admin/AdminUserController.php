<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RolesUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vt = Roles::all();
        return view('administrators.add.addemployee', compact('vt'));
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
                'ten_nhan_vien' => 'required|string|max:255',
                'so_dien_thoai' => 'required|numeric',
                'ngay_sinh' => 'required|date',
                'gioi_tinh' => 'required|string',
                'dia_chi' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:nhanvien',
                'mat_khau' => 'required|string|min:8',
                'role_id' => 'integer',
            ]);

            $validatedData['gioi_tinh'] = $validatedData['gioi_tinh'] === 'Nam' ? 1 : 0;

            // Bắt đầu giao dịch cơ sở dữ liệu
            DB::beginTransaction();

            // Tạo người dùng mới
            $user = User::create([
                'ten_nhan_vien' => $validatedData['ten_nhan_vien'],
                'so_dien_thoai' => $validatedData['so_dien_thoai'],
                'ngay_sinh' => $validatedData['ngay_sinh'],
                'gioi_tinh' => $validatedData['gioi_tinh'],
                'dia_chi' => $validatedData['dia_chi'],
                'email' => $validatedData['email'],
                'mat_khau' => Hash::make($validatedData['mat_khau']),
                'ma_vai_tro' => $validatedData['role_id'],
                'da_duoc_xac_nhan' => true,
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
    public function show()
    {
        $currentUserId = Auth::id();
        $nhanvien = User::where('ma_nhan_vien', '!=', $currentUserId)->with('role')->get();
        return view('administrators.list.employee', compact('nhanvien', 'currentUserId'));
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
    public function update(Request $request, $id)
    {
        //
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

    public function search(Request $request)
    {
        $searchdm = $request->input('search');

        $nhanvien = User::where('ten_nhan_vien', 'like', '%' . $searchdm . '%')
            ->orWhere('ma_nhan_vien', 'like', '%' . $searchdm . '%');
        //  ->paginate(5);

        // Trả về view với dữ liệu tìm kiếm
        return view('administrators.list.employee', compact('nhanvien'));
    }

    public function detail($ma_nhan_vien)
    {
        $per = Permissions::all();
        $detailND = User::where('ma_nhan_vien', $ma_nhan_vien)->first();
        $roles = RolesUser::with('vaitro')->where('ma_nhan_vien', $ma_nhan_vien)->get();
        if ($detailND) {
            return view('administrators.details.employees', compact('detailND', 'roles', 'per'));
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
}
