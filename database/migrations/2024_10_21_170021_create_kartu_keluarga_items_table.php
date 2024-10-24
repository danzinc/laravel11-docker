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
        Schema::create('ktps', function (Blueprint $table) {
            $table->id();
            $table->string('ktp_no')->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->string('rt',10);
            $table->string('rw',10);
            $table->string('kodepos',10);
            $table->string('desa',150);
            $table->string('kecamatan',150);
            $table->string('kabupaten',150);
            $table->string('provinsi',150); 
            $table->string('golongan_darah');
            $table->string('foto',150);
            $table->string('foto_ttd',150);
            $table->string('jenis_kelamin',50);
            $table->string('tempat_lahir',50);
            $table->date('tanggal_lahir');
            $table->string('agama',10);
            $table->string('pendidikan',50);
            $table->string('pekerjaan',50);
            $table->string('jenis_pendidikan',50);
            $table->string('status_perkawinan',50);
            $table->string('kewarganegaraan',150);
            $table->string('no_passport',150);
            $table->string('no_kitap',150);
            $table->string('nama_ayah',150);
            $table->string('nama_ibu',150);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('kartu_keluarga_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kartu_keluarga_id')->constrained()->onDelete('cascade');
            $table->foreignId('ktp_id')->constrained()->onDelete('cascade');
            $table->string('status_hubungan'); 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktps');
        Schema::dropIfExists('kartu_keluarga_items');
    }
};
