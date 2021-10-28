<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataSiswaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->bigIncrements('Id_Siswa')->unsigned();
            $table->unsignedInteger('Id_Kelas')->nullable();
            $table->integer('NIS')->unsigned();
            $table->bigInteger('NISN')->unsigned();
            $table->string('Nama_Siswa');
            $table->string('Jenis_Kelamin');
            $table->timestamps();

            $table->foreign('Id_Kelas')
                ->references('Id_Kelas')
                ->on('kelas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_siswa_models');
    }
}
