<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataAbsenModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->bigIncrements('Id_Absen');
            $table->unsignedInteger('Id_Kelas')->nullable();
            $table->unsignedInteger('Id_Mapel')->nullable();
            $table->unsignedInteger('Id_Guru')->nullable();
            $table->string('Hari');
            $table->date('Tanggal');
            $table->integer('Sesi')->unsigned();
            $table->longText('Hadir');
            $table->longText('Izin');
            $table->longText('Sakit');
            $table->longText('Alpa');
            $table->timestamps();

            $table->foreign('Id_Kelas')
                ->references('Id_Kelas')
                ->on('kelas')
                ->onDelete('cascade');

            $table->foreign('Id_Mapel')
                ->references('Id_Mapel')
                ->on('matapelajaran')
                ->onDelete('cascade');

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
        Schema::dropIfExists('data_absen_models');
    }
}
