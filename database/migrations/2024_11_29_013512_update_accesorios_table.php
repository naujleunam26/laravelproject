<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAccesoriosTable extends Migration
{
    public function up()
    {
        Schema::table('accesorios', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->dropColumn('precio_compra'); 
            $table->dropColumn('precio_venta');
            $table->string('codigo_factura')->nullable(); // Agrega la columna 'codigo_factura'
        });
    }

    public function down()
    {
        
    }
}

