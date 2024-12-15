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
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('konsultasi_id');
            $table->integer('penyakit_id');
            $table->double('nilai_akurasi');
            $table->json('json_penyakit')->nullable();
            $table->json('json_gejala')->nullable();
            $table->string('result_penyakit')->nullable();
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
        Schema::dropIfExists('hasils');
    }
};
