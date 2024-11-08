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
        Schema::create('pengajuan_izin', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 100)->nullable();
            $table->date('tgl_izin')->nullable();
            $table->char('status', 1)->nullable()->comment('i: Izin, s: Sakit');
            $table->text('keterangan')->nullable();
            $table->integer('status_approved')->nullable()->default(1)->comment('0: Pending, 1: Disetujui, 2: Ditolak');
            $table->date('tgl_approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_izin');
    }
};
