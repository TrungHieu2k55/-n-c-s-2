<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = 'donhang';
    protected $primaryKey='ma_don_hang';
    protected $fillable=['ma_don_hang','ma_khach_hang', 'ma_nhan_vien', 'ma_khuyen_mai', 'trang_thai', 'ghi_chu','ngay_tao' , 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'ma_don_hang', 'ma_don_hang');
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'ma_don_hang', 'ma_don_hang');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'ma_khach_hang', 'ma_khach_hang');
    }
}
