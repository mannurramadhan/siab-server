<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataJurnalGuruModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnalguru', function (Blueprint $table) {
            $table->bigIncrements('Id_Jurnal_Guru');
            $table->unsignedInteger('Id_Kelas')->nullable();
            $table->unsignedInteger('Id_Mapel')->nullable();
            $table->unsignedInteger('Id_Guru')->nullable();
            $table->string('Hari');
            $table->date('Tanggal');
            $table->integer('Sesi')->unsigned();
            $table->string('Materi_Mapel');
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
        Schema::dropIfExists('data_jurnal_guru_models');
    }
}
