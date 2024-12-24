<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNguoidungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->id('ma_nguoidung');
            $table->string('ten_nguoidung');
            $table->string('email')->unique();
            $table->timestamp('email_da_xac_nhan')->nullable();
            $table->integer('so_dienthoai')->unique();
            $table->string('mat_khau');
            $table->rememberToken('ghi_nho');
            $table->boolean('da_duoc_xac_nhan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nguoidung');
    }
}
