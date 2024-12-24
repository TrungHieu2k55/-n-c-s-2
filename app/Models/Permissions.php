<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;

    protected $table = 'quyenhan'; 
    protected $primaryKey = 'ma_quyen';
    protected $fillable = [
        'ma_quyen',
        'ten_quyen',
        'ma_xacnhan',
    ];

    public function PermissionsChid(){
        return $this->hasMany(Permissions::class, 'ma_danhmuccha');
    }
}
