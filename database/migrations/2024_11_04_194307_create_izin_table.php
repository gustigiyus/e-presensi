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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 100)->nullable();
            $table->date('tgl_izin')->nullable();
            $table->boolean('status')->nullable()->default(false);
            $table->time('keterangan')->nullable();
            $table->boolean('status_approved')->nullable()->default(false);
            $table->date('tgl_approved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
