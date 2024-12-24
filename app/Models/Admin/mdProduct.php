<?php

namespace App\Models\Admin;

use App\Models\orderdetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class mdProduct extends Model
{
    use HasFactory;
    protected $table = 'sanpham';
    protected $primaryKey = 'ma_san_pham'; // Đặt tên khóa chính của bảng 'tours'
    protected $fillable = ['ma_san_pham',
                           'ma_loai',
                           'ten_san_pham',
                           'gia_nhap',
                           'gia_ban',
                           'thuong_hieu',
                           'chat_lieu',
                           'mo_ta',
                           'luot_xem',
                           'ngay_tao',
                           'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function hinhAnhs()
    {
        return $this->hasMany(Image::class, 'ma_san_pham', 'ma_san_pham');

    }
    public function bienThe()
    {
        return $this->hasMany(mdProductBT::class, 'ma_san_pham', 'ma_san_pham');

    }
    public function category()
    {
        return $this->belongsTo(mdCategory::class, 'ma_loai', 'ma_loai');
    }
    
    public function orderDetails()
    {
        return $this->hasMany(orderdetail::class, 'ma_san_pham', 'ma_san_pham');
    }
}
