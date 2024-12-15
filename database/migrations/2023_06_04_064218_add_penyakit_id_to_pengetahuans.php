<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengetahuans', function (Blueprint $table) {
            Schema::table('pengetahuans', function (Blueprint $table) {
                $table->foreignId('penyakit_id')->constrained('penyakits');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengetahuans', function (Blueprint $table) {
            Schema::table('pengetahuans', function (Blueprint $table) {
                $table->dropForeign(['penyakit_id']);
                $table->dropColumn('penyakit_id');
            });
        });
    }
};
