<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nip')->unique()->index();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp');
            $table->string('tempat_lahir');
            $table->string('alamat_kecamatan');
            $table->string('alamat_kabupaten');
            $table->string('alamat_provinsi');
            $table->text('alamat_lengkap');
            $table->date('tanggal_lahir');
            $table->enum('status_kawin', ['kawin', 'tidak kawin'])->default('tidak kawin');
            $table->integer('jumlah_anak')->default(0);
            $table->date('tanggal_masuk');
            $table->enum('jabatan', ['Manager', 'Staf', 'Magang']);
            $table->enum('departemen', ['Marketing', 'HRD', 'Production', 'Executive', 'Commissioner']);
            $table->integer('usia')->default(0);
            $table->json('pendidikan')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
