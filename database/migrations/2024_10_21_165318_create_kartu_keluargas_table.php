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
        Schema::create('kartu_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('no_kk',16)->unique();
            $table->date('tanggal_dokumen'); 
            $table->string('nama_kepala_keluarga');
            $table->string('rt',10);
            $table->string('rw',10);
            $table->string('kodepos',10);
            $table->string('desa',150);
            $table->string('kecamatan',150);
            $table->string('kabupaten',150);
            $table->string('provinsi',150); 
            $table->string('nama_pejabat',150);
            $table->string('nip',150);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_keluargas');
    }
};
