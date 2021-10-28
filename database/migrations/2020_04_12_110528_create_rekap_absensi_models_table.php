<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapAbsensiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapabsensisiswa', function (Blueprint $table) {
            $table->bigIncrements('Id_Rekap_Absen');
            $table->unsignedBigInteger('Id_Absen')->nullable();
            $table->unsignedInteger('Id_Kelas')->nullable();
            $table->unsignedInteger('Id_Mapel')->nullable();
            $table->unsignedInteger('Id_Guru')->nullable();
            $table->date('Bulan');
            $table->date('Tahun');
            $table->longText('Hadir');
            $table->longText('Izin');
            $table->longText('Sakit');
            $table->longText('Alpa');
            $table->timestamps();

            $table->foreign('Id_Absen')
                ->references('Id_Absen')
                ->on('absensi')
                ->onDelete('cascade');

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
        Schema::dropIfExists('rekap_absensi_models');
    }
}
