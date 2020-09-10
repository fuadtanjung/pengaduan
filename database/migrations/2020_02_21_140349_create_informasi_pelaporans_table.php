<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiPelaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_pelaporans', function (Blueprint $table) {
            $table->bigIncrements('id_pelaporan');
            $table->unsignedBigInteger('dampak_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('jenis_id')->nullable();
            $table->unsignedBigInteger('urgensi_id')->nullable();
            $table->unsignedBigInteger('prioritas_id')->nullable();
            $table->unsignedBigInteger('tipe_id')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('petugas_id')->nullable();
            $table->string('no_tiket')->nullable();
            $table->string('nama_pengguna');
            $table->string('kontak_pengguna');
            $table->string('media_pelaporan')->nullable();
            $table->date('waktu_pelaporan');
            $table->string('deskripsi');
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tgl_pemuktahiran')->nullable();
            $table->string('solusi')->nullable();
            $table->date('tgl_selesai')->nullable();
            $table->string('status_pengguna')->nullable();
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
        Schema::dropIfExists('informasi_pelaporans');
    }
}
