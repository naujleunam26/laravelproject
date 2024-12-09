<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaCompra extends Model
{
    
    use HasFactory;

    protected $table = 'facturas_compras'; 


    protected $fillable = [
        'numero_factura',
        'proveedor_id',
        'fecha',
        'total',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class);
    }
    protected static function booted()
{
    static::creating(function ($factura) {
        if (!$factura->numero_factura) {
            $ultimoNumeroFactura = self::max('numero_factura');
            $factura->numero_factura = $ultimoNumeroFactura ? $ultimoNumeroFactura + 1 : 1;
        }
    });
}

}
