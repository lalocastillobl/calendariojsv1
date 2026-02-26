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
    Schema::create('personas', function (Blueprint $table) {
        $table->id();
        $table->string('num_trabajador');
        $table->year('anio');
        $table->enum('periodo', [1,2,3]);

        $table->time('lunes_in')->nullable();
        $table->time('lunes_out')->nullable();

        $table->time('martes_in')->nullable();
        $table->time('martes_out')->nullable();

        $table->time('miercoles_in')->nullable();
        $table->time('miercoles_out')->nullable();

        $table->time('jueves_in')->nullable();
        $table->time('jueves_out')->nullable();

        $table->time('viernes_in')->nullable();
        $table->time('viernes_out')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personas');
    }
};
