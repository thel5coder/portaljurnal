<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePjJurnalDetailPenulis extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_jurnal_detail_penulis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jurnal_id');
            $table->string('unik_id',20);
            $table->string('nama_penulis',100);
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
        Schema::drop('pj_jurnal_detail_penulis');
    }
}
