<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePjOpenJurnal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_open_jurnal', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tgl_buka');
            $table->date('tgl_tutup');
            $table->string('volume',50);
            $table->string('nomor',50);
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
        Schema::drop('pj_open_jurnal');
    }
}
