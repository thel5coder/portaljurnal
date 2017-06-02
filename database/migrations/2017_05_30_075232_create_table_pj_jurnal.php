<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePjJurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_jurnal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('open_jurnal_id');
            $table->string('judul',100);
            $table->text('abstrak');
            $table->string('jurusan',100);
            $table->string('instansi',100);
            $table->integer('kategori_id');
            $table->string('file_jurnal');
            $table->string('cover_jurnal');
            $table->string('status',50);
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::drop('pj_jurnal');
    }
}
