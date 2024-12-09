<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesServicioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            
            $table->string('modelo_telefono');
            $table->string('marca')->nullable();
            $table->string('imei')->nullable();
            $table->string('codigo_de_bloque')->nullable();
            
            $table->text('problema_reportado');

            $table->enum('estado', ['pendiente', 'en_proceso', 'completado', 'cancelado'])->default('pendiente');
            
            $table->decimal('costo_estimado', 10, 2)->nullable();
            $table->decimal('costo_repuestos', 10, 2)->nullable();
            $table->decimal('abono', 10, 2)->default(0);

            $table->dateTime('fecha_ingreso')->default(now());
            $table->dateTime('fecha_entrega')->nullable();
            
            $table->unsignedBigInteger('user_id');
            
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_servicio');
    }
}
