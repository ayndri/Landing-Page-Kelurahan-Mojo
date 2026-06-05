<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Add nullable first so existing rows don't fail
        Schema::table('plants', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('nama');
        });

        // Populate slug for existing rows
        \DB::table('plants')->orderBy('id')->get()->each(function ($plant) {
            $base = Str::slug($plant->nama);
            $slug = $base;
            $i = 2;
            while (\DB::table('plants')->where('slug', $slug)->where('id', '!=', $plant->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            \DB::table('plants')->where('id', $plant->id)->update(['slug' => $slug]);
        });
    }

    public function down(): void
    {
        Schema::table('plants', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
