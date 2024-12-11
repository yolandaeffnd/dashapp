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
        Schema::create('appcharts', function (Blueprint $table) {
            $table->id(); // Creates an auto-increment primary key
            $table->unsignedInteger('idKategori'); // For foreign keys or integer fields
            $table->string('namaChart', 100); // String field with max length of 100
            $table->string('ulrChart', 255); // String field with max length of 255
            $table->unsignedInteger('idFakultas'); // For foreign keys or integer fields
            $table->integer('posisiChart'); // Integer field
            $table->timestamps(); // Adds created_at and updated_at fields
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appcharts');
    }
};
