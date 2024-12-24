<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Roles extends Model
{
    use HasFactory;
    protected $table = 'vaitro'; 
    protected $primaryKey = 'ma_vai_tro';
    protected $fillable = [
        'ma_vai_tro',
        'ten_vai_tro',
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'ma_vai_tro', 'ma_vai_tro');
    }
}
