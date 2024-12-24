<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Image;
use App\Models\Admin\mdCategory;
use App\Models\Admin\mdColor;
use App\Models\Admin\mdProduct;
use App\Models\Admin\mdProductBT;
use App\Models\Admin\mdSize;
use App\Models\order;
use App\Models\orderdetail;
use Illuminate\Http\Request;

class Orders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($ma_don_hang)
    {
        $orderDetails = order::with(['orderDetails.productVariant.sanPham', 'orderDetails.productVariant.mau', 'orderDetails.productVariant.kichThuoc', 'orderDetails.productVariant.sanPham.hinhAnhs'])
            ->where('ma_don_hang', $ma_don_hang)
            ->first();
    
        return view('administrators.list.detailord', compact('orderDetails'));
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
        //
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
}
