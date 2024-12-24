<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaitronguoidungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaitronguoidung', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_vaitro');
            $table->unsignedBigInteger('ma_nguoidung');
      

            $table->foreign('ma_vaitro')->references('ma_vaitro')->on('vaitro')->onDelete('cascade');
            $table->foreign('ma_nguoidung')->references('ma_nguoidung')->on('nguoidung')->onDelete('cascade');
            $table->primary(['ma_vaitro', 'ma_nguoidung']);
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
        Schema::dropIfExists('vaitronguoidung');
    }
}
