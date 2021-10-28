<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataMataPelajaranModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matapelajaran', function (Blueprint $table) {
            $table->increments('Id_Mapel')->unsigned();
            $table->unsignedInteger('Id_Guru')->nullable();
            $table->string('Nama_Mapel');
            $table->string('Guru_Pengampu');
            $table->string('Kelas_Mapel');
            $table->string('Jenis_Kelas');

            $table->foreign('Id_Guru')
                ->references('Id_Guru')
                ->on('guru')
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
        Schema::dropIfExists('data_mata_pelajaran_models');
    }
}
