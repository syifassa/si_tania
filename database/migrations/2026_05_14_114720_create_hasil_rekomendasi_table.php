<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasil_rekomendasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('riwayat_id')
                ->constrained('riwayat_input')
                ->onDelete('cascade');
            $table->foreignId('tanaman_id')
                ->constrained('alternatif_tanaman')
                ->onDelete('cascade');
            $table->double('nilai_vi');
            $table->integer('ranking');
            $table->string('metode_budidaya');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_rekomendasi');
    }
};
