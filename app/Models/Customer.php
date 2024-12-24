<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'khachhang'; 
    protected $primaryKey = 'ma_khach_hang';
    protected $fillable = [
        'ma_khach_hang',
        'ten_khach_hang',
        'ngay_sinh',
        'gioi_tinh',
        'dia_chi',
        'email',
        'so_dien_thoai',
        'mat_khau',
        'luu_token',
        'ngay_tao',
        'ngay_cap_nhat'
    ];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    protected $hidden = [
        'mat_khau',
        'luu_token',
    ];

    public function carts()
    {
        return $this->hasMany(carts::class, 'ma_khach_hang');
    }

    public function orders()
    {
        return $this->hasMany(order::class, 'ma_khach_hang');
    }
}
