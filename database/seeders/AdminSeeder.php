<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo tài khoản admin
        $adminId = DB::table('nhanvien')->insertGetId([
            'ten_nhanvien' => 'Admin',
            'email' => 'admin@gmail.com',
            'so_dien_thoai' => 123456789,
            'mat_khau' => Hash::make('123456789'), // sử dụng Hash::make để mã hóa mật khẩu
            'da_duoc_xac_nhan' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tạo vai trò admin
        $roleId = DB::table('vaitro')->insertGetId([
            'ten_vaitro' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Gán vai trò admin cho người dùng admin
        DB::table('vaitronguoidung')->insert([
            'ma_vaitro' => $roleId,
            'ma_nguoidung' => $adminId,
            'kieu_nguoidung' => 'primary', // Ví dụ về kiểu người dùng, bạn có thể thay đổi
        ]);
    }
}
