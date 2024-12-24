<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\mdSize;
use Illuminate\Http\Request;

class size extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kt = mdSize::all();
        return view('administrators.add.addsize', compact('kt'));
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
                'kich_thuoc' => 'required|string|max:255',
            ]);

            $kt = new mdSize();
            $kt->kich_thuoc = $validatedData['kich_thuoc'];
            $kt->save();
            session()->push('size', [
                'type' => 'success',
                'message' => 'Thêm thành công',
                'title' => 'Success'
            ]);
            return redirect()->back()->with('success', 'Thêm mới thành công<script>setTimeout(function() { window.location.href = "' . route('show.size') . '"; }, 1000);</script>');
        } catch (\Exception $e) {
            session()->push('size', [
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
    public function show()
    {
        $kt = mdSize::all();
        return view('administrators.list.size', compact('kt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ma_kich_thuoc)
    {
        $kt = mdSize::findOrFail($ma_kich_thuoc);
        session()->push('size', [
            'type' => 'success',
            'message' => 'Sửa thành công',
            'title' => 'Success'
        ]);
        return view('administrators.edit.editsize', compact('kt'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ma_kich_thuoc)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'kich_thuoc' => 'required|string|max:255',
        ]);
        $kt = mdSize::findOrFail($ma_kich_thuoc);
        $kt->update([
            'kich_thuoc' => $validatedData['kich_thuoc'],
        ]);
        return redirect()->route('show.size');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ma_kich_thuoc)
    {
        $kt = mdSize::findOrFail($ma_kich_thuoc)->delete();
        session()->push('size', [
            'type' => 'success',
            'message' => 'Xóa thành công',
            'title' => 'Success'
        ]);
        return redirect()->route('show.size');
    }

    public function search(Request $request)
    {
        $searchdm = $request->input('search');

        $kt = mdSize::where('kich_thuoc', 'like', '%' . $searchdm . '%')
            ->orWhere('ma_kich_thuoc', 'like', '%' . $searchdm . '%');
        //->paginate(5);

        // Trả về view với dữ liệu tìm kiếm
        return view('administrators.list.size', compact('kt'));
    }
}
