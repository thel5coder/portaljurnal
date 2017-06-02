<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('unik_id',20)->after('id');
            $table->string('jurusan',50)->after('password');
            $table->string('instansi',50)->after('jurusan');
            $table->text('alamat')->after('instansi');
            $table->enum('user_level',['admin','mitra bestari','tim redaksi','penulis','visitor'])->before('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
