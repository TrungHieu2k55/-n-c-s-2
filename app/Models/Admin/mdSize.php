<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mdSize extends Model
{
    use HasFactory;
    protected $table = 'kichthuoc';
    protected $primaryKey='ma_kich_thuoc';
    protected $fillable=['ma_kich_thuoc','kich_thuoc', 'ngay_tao', 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    
}
