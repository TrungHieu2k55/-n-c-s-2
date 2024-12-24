<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class mdCategory extends Model
{
    use HasFactory;
    protected $table = 'danhmuc';
    protected $primaryKey = 'ma_loai'; 
    protected $fillable = ['ma_loai', 'ten_loai', 'ma_danh_muc_cha', 'ngay_tao', 'ngay_cap_nhat'];
    const CREATED_AT = 'ngay_tao';
    const UPDATED_AT = 'ngay_cap_nhat';
    public function parent()
    {
        return $this->belongsTo(mdCategory::class, 'ma_danh_muc_cha');
    }

    public function children()
    {
        return $this->hasMany(mdCategory::class, 'ma_danh_muc_cha');
    }
    public static function tree()
    {
        $allCategories = mdCategory::all();
        $rootCategories = $allCategories->where('ma_danh_muc_cha', null);
        self::formatTree($rootCategories, $allCategories);
        return $rootCategories;
    }
    private static function formatTree($categories, $allCategories)
    {
        foreach ($categories as $category) {
            $category->children = $allCategories->where('ma_danh_muc_cha', $category->ma_loai)->values();
            if ($category->children->isNotEmpty()) {
                self::formatTree($category->children, $allCategories);
            }
        }
    }


}
