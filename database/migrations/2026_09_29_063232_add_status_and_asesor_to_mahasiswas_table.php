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
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->enum('status', ['Menunggu', 'Kompeten', 'Belum Kompeten'])->default('Menunggu')->after('no_hp');
            $table->foreignId('asesor_id')->nullable()->constrained('asesors')->nullOnDelete()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswas', function (Blueprint $table) {
            $table->dropColumn(['status', 'asesor_id']);
        });
    }
};
