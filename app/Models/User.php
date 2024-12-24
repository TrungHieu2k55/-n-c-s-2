<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'nhanvien'; 
    protected $primaryKey = 'ma_nhan_vien';
    protected $fillable = [
        'ma_nhan_vien',
        'ma_vai_tro',
        'ten_nhan_vien',
        'ngay_sinh',
        'gioi_tinh',
        'dia_chi',
        'anh_dai_dien',
        'email',
        'so_dien_thoai',
        'mat_khau',
        'luu_token',
        'da_duoc_xac_nhan',
        'ngay_tao',
        'ngay_cap_nhat'
    ];

    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    protected $hidden = [
        'mat_khau',
        'luu_token',
    ];
    public function role()
    {
        return $this->belongsTo(Roles::class, 'ma_vai_tro', 'ma_vai_tro');
    }
}
