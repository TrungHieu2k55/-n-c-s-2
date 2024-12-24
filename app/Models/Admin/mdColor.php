<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mdColor extends Model
{
    use HasFactory;
    protected $table = 'mausac';
    protected $primaryKey = 'ma_mau'; // Đặt tên khóa chính của bảng 'tours'
    protected $fillable = ['ma_mau', 'mau', 'ma_mau_chi_tiet', 'ngay_tao','ngay_cap_nhat'];
    
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
}
