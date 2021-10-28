<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekapJurnalGuruModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapjurnalguru', function (Blueprint $table) {
            $table->bigIncrements('Id_Rekap_Jurnal_Guru');
            $table->unsignedBigInteger('Id_Jurnal_Guru')->nullable();
            $table->unsignedInteger('Id_Kelas')->nullable();
            $table->unsignedInteger('Id_Mapel')->nullable();
            $table->unsignedInteger('Id_Guru')->nullable();
            $table->date('Bulan');
            $table->date('Tahun');
            $table->timestamps();

            $table->foreign('Id_Jurnal_Guru')
                ->references('Id_Jurnal_Guru')
                ->on('jurnalguru')
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
        Schema::dropIfExists('rekap_jurnal_guru_models');
    }
}
