<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuyennguoidungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quyennguoidung', function (Blueprint $table) {
            $table->unsignedBigInteger('ma_quyen');
            $table->unsignedBigInteger('ma_vaitro');

            $table->foreign('ma_quyen')->references('ma_quyen')->on('quyenhan')->onDelete('cascade');
            $table->foreign('ma_vaitro')->references('ma_vaitro')->on('vaitro')->onDelete('cascade');
            $table->primary(['ma_quyen', 'ma_vaitro']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quyennguoidung');
    }
}
