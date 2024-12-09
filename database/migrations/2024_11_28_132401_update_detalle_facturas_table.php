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
    Schema::table('detalle_facturas', function (Blueprint $table) {
        $table->renameColumn('producto_id', 'accesorio_id'); // Cambia el nombre si es necesario
        $table->unsignedBigInteger('accesorio_id')->nullable()->change(); // Permitir null temporalmente si es necesario
    });
}

public function down()
{
    Schema::table('detalle_facturas', function (Blueprint $table) {
        $table->renameColumn('accesorio_id', 'producto_id'); // Cambia a la columna original si haces rollback
    });
}
};
