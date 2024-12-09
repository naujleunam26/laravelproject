<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accesorio extends Model
{
    protected $fillable = ['nombre', 'categoria_id', 'codigo_factura'];


    public function ventas()
{
    return $this->hasMany(Venta::class);
}
public function detallesFacturas()
    {
        return $this->hasMany(DetalleFactura::class, 'accesorio_id');
    }
    public function categoria()
{
    return $this->belongsTo(Categoria::class);
}

}
