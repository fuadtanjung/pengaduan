<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDampaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dampaks', function (Blueprint $table) {
            $table->bigIncrements('id_dampak');
            $table->String('nama_dampak');
            $table->String('sk_dampak');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dampaks');
        Schema::enableForeignKeyConstraints();
    }
}
