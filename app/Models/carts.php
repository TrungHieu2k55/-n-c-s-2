<?php

namespace App\Models;

use App\Models\Admin\mdProduct;
use App\Models\Admin\mdProductBT;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    use HasFactory;
    protected $table = 'giohang';
    protected $primaryKey = 'ma_gio_hang';
    protected $fillable = ['ma_gio_hang', 'ma_khach_hang', 'ma_bien_the', 'so_luong', 'ngay_tao', 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ma_khach_hang');
    }

    public function productVariant()
    {
        return $this->belongsTo(mdProductBT::class, 'ma_bien_the');
    }
}
