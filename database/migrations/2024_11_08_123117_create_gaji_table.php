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
        Schema::create('gaji', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 100);
            $table->date('periode'); // Bulan/Periode penggajian
            $table->integer('gaji_pokok')->default(0);
            $table->integer('tunjangan')->default(0);
            $table->integer('potongan')->default(0);
            $table->integer('gaji_bersih')->default(0);
            $table->enum('status', ['belum dibayar', 'sudah dibayar'])->default('belum dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji');
    }
};
