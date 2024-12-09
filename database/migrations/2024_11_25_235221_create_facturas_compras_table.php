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
        Schema::create('facturas_compras', function (Blueprint $table) {
            $table->id();
            $table->string('numero_factura')->unique();
            $table->unsignedBigInteger('proveedor_id');
            $table->date('fecha');
            $table->decimal('total', 10, 2)->default(0);
            $table->timestamps();

            $table->foreign('proveedor_id')->references('id')->on('proveedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_compras');
    }
};
