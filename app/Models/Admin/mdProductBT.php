<?php

namespace App\Models\Admin;

use App\Models\Cart;
use App\Models\carts;
use App\Models\orderdetail;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mdProductBT extends Model
{
    use HasFactory;
    protected $table = 'bienthe';
    
    protected $primaryKey = 'ma_bien_the'; 
    protected $fillable = [
        'ma_bien_the',
        'ma_san_pham',
        'ma_mau',
        'ma_kich_thuoc',
        'so_luong_ton',
        'ma_nhan_vien',
        'ngay_tao',
        'ngay_cap_nhat'
    ];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function sanPham()
    {
        return $this->belongsTo(mdProduct::class, 'ma_san_pham');
    }

    public function mau()
    {
        return $this->belongsTo(mdColor::class, 'ma_mau');
    }

    public function kichThuoc()
    {
        return $this->belongsTo(mdSize::class, 'ma_kich_thuoc');
    }
    public function nhanVien()
    {
        return $this->belongsTo(User::class, 'ma_nhan_vien');
    }
    public function carts()
    {
        return $this->hasMany(carts::class, 'ma_bien_the');
    }
    public function increaseInventory($quantity)
{
    $this->so_luong_ton += $quantity;
    $this->save();
}
}
