<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\mdColor;
use Illuminate\Http\Request;

class color extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mausac = mdColor::all();
        return view('administrators.add.addcolor', compact('mausac'));
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
                'mau' => 'required|string|max:255',
                'ma_mau_chi_tiet' => 'required|string|max:255',
            ]);

            $mausac = new mdColor();
            $mausac->mau = $validatedData['mau'];
            $mausac->ma_mau_chi_tiet = $validatedData['ma_mau_chi_tiet'];
            $mausac->save();
            session()->push('color', [
                'type' => 'success',
                'message' => 'Thêm thành công',
                'title' => 'Success'
            ]);
            return redirect()->back()->with('success', 'Thêm mới thành công<script>setTimeout(function() { window.location.href = "' . route('show.color') . '"; }, 1000);</script>');
        } catch (\Exception $e) {
            session()->push('color', [
                'type' => 'success',
                'message' => 'Thêm thất bại',
                'title' => 'Success'
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
    public function show()
    {
        $mausac = mdColor::all();
        return view('administrators.list.color', compact('mausac'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ma_mau)
    {
        $mausac = mdColor::findOrFail($ma_mau);
        return view('administrators.edit.editcolor', compact('mausac'));
        // dd($mausac);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ma_mau)
    {
        $validatedData = $request->validate([
            'mau' => 'required|string|max:255',
            'ma_mau_chi_tiet' => 'required|string|max:255',
        ]);
        $mausac = mdColor::findOrFail($ma_mau);
        $mausac->update([
            'mau' => $validatedData['mau'],
            'ma_mau_chi_tiet' => $validatedData['ma_mau_chi_tiet'],
        ]);
        return redirect()->route('show.color');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ma_mau)
    {
        $danhmuc = mdColor::findOrFail($ma_mau)->delete();
        session()->push('color', [
            'type' => 'success',
            'message' => 'Xóa thành công',
            'title' => 'Success'
        ]);
        return redirect()->route('show.color');
    }

    public function search(Request $request)
    {
        $searchdm = $request->input('search');

        $mausac = mdColor::where('ten_mau', 'like', '%' . $searchdm . '%')
            ->orWhere('ma_mau', 'like', '%' . $searchdm . '%');
        //  ->paginate(5);

        // Trả về view với dữ liệu tìm kiếm
        return view('administrators.list.color', compact('mausac'));
    }
}
