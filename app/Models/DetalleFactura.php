<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    use HasFactory;

    protected $fillable = ['factura_compra_id', 'accesorio_id' ,'producto_id', 'cantidad', 'precio_unitario', 'subtotal'];

    public function factura()
    {
        return $this->belongsTo(FacturaCompra::class);
    }

    public function producto()
    {
        return $this->belongsTo(Accesorio::class);
    }
    public function accesorio()
    {
        return $this->belongsTo(Accesorio::class, 'accesorio_id');
    }
}
