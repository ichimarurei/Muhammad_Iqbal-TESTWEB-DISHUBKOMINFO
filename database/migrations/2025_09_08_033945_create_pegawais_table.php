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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->integer('nip')->unique();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('jabatan_id')->nullable();
            $table->unsignedBigInteger('skpd_id')->nullable();
            $table->unsignedBigInteger('unit_kerja_id')->nullable();
            $table->string('nama_golongan');
            $table->string('nama_pangkat');
            $table->string('alamat_lengkap');
            $table->timestamps();

            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('set null');
            $table->foreign('skpd_id')->references('id')->on('skpd')->onDelete('set null');
            $table->foreign('unit_kerja_id')->references('id')->on('unit_kerja')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
