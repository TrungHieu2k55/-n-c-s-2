<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vorcher extends Model
{
    use HasFactory;
    protected $table = 'khuyenmai';
    protected $primaryKey = 'ma_khuyen_mai'; // Đặt tên khóa chính của bảng 'tours'
    protected $fillable = ['ma_khuyen_mai', 'phan_tram_khuyen_mai', 'gia_ap_dung', 'mo_ta', 'ma_ap_dung'];
    public $timestamps = false;
}
