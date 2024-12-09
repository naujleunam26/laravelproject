<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaIdToAccesoriosTable extends Migration
{
    public function up()
    {
        Schema::table('accesorios', function (Blueprint $table) {
            $table->unsignedBigInteger('categoria_id'); // Clave foránea
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('accesorios', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropColumn('categoria_id');
        });
    }
}
