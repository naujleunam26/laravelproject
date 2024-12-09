<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores'; // Nombre de la tabla en la base de datos


    protected $fillable = ['nombre', 'telefono', 'email', 'direccion'];

    public function facturas()
    {
        return $this->hasMany(FacturaCompra::class);
    }
}
