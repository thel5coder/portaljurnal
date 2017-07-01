<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBlindReview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pj_blind_review', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jurnal_id');
            $table->enum('format_penulisan1',['sesuai','perbaiki']);
            $table->enum('format_penulisan2',['sesuai','perbaiki']);
            $table->enum('format_penulisan3',['sesuai','perbaiki']);
            $table->enum('format_penulisan4',['sesuai','perbaiki']);
            $table->enum('format_penulisan5',['sesuai','perbaiki']);
            $table->enum('format_penulisan6',['sesuai','perbaiki']);
            $table->enum('format_penulisan7',['sesuai','perbaiki']);
            $table->enum('format_penulisan8',['sesuai','perbaiki']);
            $table->enum('format_penulisan9',['sesuai','perbaiki']);
            $table->enum('format_penulisan10',['sesuai','perbaiki']);
            $table->enum('format_penulisan11',['sesuai','perbaiki']);
            $table->enum('format_penulisan12',['sesuai','perbaiki']);
            $table->enum('format_penulisan13',['sesuai','perbaiki']);
            $table->enum('isi_tulisan1',['1,2,3,4']);
            $table->enum('isi_tulisan2',['1,2,3,4']);
            $table->enum('isi_tulisan3',['1,2,3,4']);
            $table->enum('isi_tulisan4',['1,2,3,4']);
            $table->enum('isi_tulisan5',['1,2,3,4']);
            $table->enum('isi_tulisan6',['1,2,3,4']);
            $table->enum('isi_tulisan7',['1,2,3,4']);
            $table->enum('isi_tulisan8',['1,2,3,4']);
            $table->enum('isi_tulisan9',['1,2,3,4']);
            $table->enum('isi_tulisan10',['1,2,3,4']);
            $table->string('paraf_reviewer');
            $table->enum('hasil',['Acc','Revisi','Reject']);
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
        Schema::drop('pj_blind_review');
    }
}
