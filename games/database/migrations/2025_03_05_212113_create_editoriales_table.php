<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('editorials', function (Blueprint $table) {
            $table->id(); // Esto crea un `bigIncrements`, que es de tipo unsignedBigInteger por defecto.
            $table->string('nombre');
            $table->text('direccion')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('editorials');
    }
};
