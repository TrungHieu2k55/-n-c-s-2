<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\vorcher;

class Sale extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administrators.add.addsale');
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

        vorcher::create([
            'phan_tram_khuyen_mai' => $request->input('phan_tram_khuyen_mai'),
            'gia_ap_dung' => $request->input('gia_ap_dung'),
            'mo_ta' => $request->input('mo_ta'),
            'ma_ap_dung' => $request->input('ma_ap_dung'),
        ]);
        // Gửi thông báo thành công
        session()->push('flash_notification', [
            'type' => 'success',
            'message' => 'Khuyến mãi đã được thêm thành công',
            'title' => 'Thành công'
        ]);
        return redirect()->back()->with('success', 'Khuyến mãi đã được thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $khuyenmai = vorcher::all();
        return view('administrators.list.sale', compact('khuyenmai'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ma_khuyen_mai)
    {
        $khuyenmai = vorcher::findOrFail($ma_khuyen_mai);
        return view('administrators.edit.editsale', compact('khuyenmai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ma_khuyen_mai)
    {

        $khuyenmai = vorcher::findOrFail($ma_khuyen_mai);
        $khuyenmai->update([
            'phan_tram_khuyen_mai' => $request->input('phan_tram_khuyen_mai'),
            'gia_ap_dung' => $request->input('gia_ap_dung'),
            'mo_ta' => $request->input('mo_ta'),
            'ma_ap_dung' => $request->input('ma_ap_dung'),
        ]);
        return redirect()->route('show.sale');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ma_khuyen_mai)
    {
        $khuyenmai = vorcher::findOrFail($ma_khuyen_mai)->delete();
        // Gửi thông báo thành công
        session()->push('flash_notification', [
            'type' => 'success',
            'message' => 'Xóa thành công',
            'title' => 'Thành công'
        ]);
        return redirect()->route('show.sale');
    }

    // public function search(Request $request){
    //     $searchdm = $request->input('search');

    //     $kt = mdSize::where('kich_thuoc', 'like', '%' . $searchdm . '%')
    //         ->orWhere('ma_kich_thuoc', 'like', '%' . $searchdm . '%');
    //        //->paginate(5);

    //     // Trả về view với dữ liệu tìm kiếm
    //     return view('administrators.list.size', compact('kt'));
    // }
}
