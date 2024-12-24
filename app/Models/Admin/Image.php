<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'hinhanh';
    protected $primaryKey = 'ma_hinh_anh'; 
    protected $fillable = ['ma_hinh_anh','ma_san_pham', 'duong_dan', 'ngay_tao', 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    public function sanPham()
    {
        return $this->belongsTo(mdProduct::class, 'ma_san_pham');
    }
    public function getFullPathAttribute()
    {
        return asset('storage/' . $this->duong_dan);
    }
}
