<?php

namespace App\Models;

use App\Models\Admin\mdProduct;
use App\Models\Admin\mdProductBT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderdetail extends Model
{
    use HasFactory;
    protected $table = 'chitietdonhang';
    
    protected $fillable = ['ma_don_hang', 'ma_bien_the', 'so_luong', 'tong_tien', 'ngay_tao', 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function order()
    {
        return $this->belongsTo(order::class, 'ma_don_hang', 'ma_don_hang');
    }

    public function productVariant()
    {
        return $this->belongsTo(mdProductBT::class, 'ma_bien_the', 'ma_bien_the');
    }
}
