<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'thanhtoan';
    protected $primaryKey='ma_thanh_toan';
    protected $fillable=['ma_thanh_toan','ma_don_hang', 'ngay_thanh_toan', 'phuong_thuc_thanh_toan', 'trang_thai_thanh_toan', 'chiet_khau', 'so_tien','ngay_tao' , 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    public function orders()
    {
        return $this->hasMany(Order::class, 'ma_thanh_toan', 'ma_thanh_toan');
    }   
}
