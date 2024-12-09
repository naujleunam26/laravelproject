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
    Schema::table('accesorios', function (Blueprint $table) {
        $table->dropColumn('categoria'); // Elimina la columna 'categoria'
    });
}

public function down()
{
    Schema::table('accesorios', function (Blueprint $table) {
        $table->string('categoria')->nullable(); // Vuelve a agregar la columna si es necesario
    });
}

};
