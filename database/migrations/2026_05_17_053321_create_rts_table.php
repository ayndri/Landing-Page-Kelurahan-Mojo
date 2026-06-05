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
        Schema::create('rts', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('rw_number');
            $table->unsignedTinyInteger('rt_number');
            $table->string('nama_ketua')->nullable();
            $table->string('no_telepon')->nullable();
            $table->unsignedSmallInteger('jumlah_kk')->nullable();
            $table->unsignedSmallInteger('jumlah_penduduk')->nullable();
            $table->timestamps();
            $table->unique(['rw_number', 'rt_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rts');
    }
};
