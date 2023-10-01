<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kahim');
            $table->string('nim_kahim');
            $table->string('kelas_kahim');
            $table->string('nama_wakahim');
            $table->string('nim_wakahim');
            $table->string('kelas_wakahim');
            $table->string('foto_kahim');
            $table->string('foto_wakahim');
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
        Schema::dropIfExists('candidates');
    }
};
