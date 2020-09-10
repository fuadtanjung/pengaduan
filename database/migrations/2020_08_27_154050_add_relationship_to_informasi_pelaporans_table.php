<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipToInformasiPelaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('informasi_pelaporans', function (Blueprint $table) {
            $table->foreign('dampak_id')->references('id_dampak')->on('dampaks');
            $table->foreign('user_id')->references('id_user')->on('usersses');
            $table->foreign('jenis_id')->references('id_jenis')->on('jenis');
            $table->foreign('urgensi_id')->references('id_urgensi')->on('urgensis');
            $table->foreign('prioritas_id')->references('id_prioritas')->on('prioritas');
            $table->foreign('tipe_id')->references('id_tipe')->on('tipes');
            $table->foreign('kategori_id')->references('id_kategori')->on('kategoris');
            $table->foreign('petugas_id')->references('id_petugas')->on('petugas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('informasi_pelaporans', function (Blueprint $table) {
            //
        });
    }
}
