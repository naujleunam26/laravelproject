<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccesorioRelationToDetalleFacturas extends Migration
{
    public function up()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            if (!Schema::hasColumn('detalle_facturas', 'accesorio_id')) {
                $table->unsignedBigInteger('accesorio_id'); // Campo para la relación
                $table->foreign('accesorio_id')->references('id')->on('accesorios')->onDelete('cascade');
            }
        });
    }

    public function down()
    {
        Schema::table('detalle_facturas', function (Blueprint $table) {
            if (Schema::hasColumn('detalle_facturas', 'accesorio_id')) {
                $table->dropForeign(['accesorio_id']);
                $table->dropColumn('accesorio_id');
            }
        });
    }
}

