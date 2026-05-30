<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_tanaman', function (Blueprint $table) {
            $table->unsignedTinyInteger('skor')->nullable()->after('nilai_optimal');
        });
    }

    public function down(): void
    {
        Schema::table('detail_tanaman', function (Blueprint $table) {
            $table->dropColumn('skor');
        });
    }
};
