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
        Schema::create('ref_semesters', function (Blueprint $table) {
            $table->id();
            $table->enum('semIsAktif', ['0', '1'])->default('0'); // Kolom ENUM untuk status
            $table->string('semNama',25);
            $table->string('semTahun',5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ref_semesters');
    }
};
