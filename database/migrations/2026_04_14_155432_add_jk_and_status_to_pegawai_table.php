<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('jenis_kelamin')->after('nama')->nullable();
            $table->enum('status_pegawai', ['tetap', 'kontrak'])->after('jenis_kelamin')->default('kontrak');
        });
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn(['jenis_kelamin', 'status_pegawai']);
        });
    }
};
