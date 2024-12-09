<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenServicio extends Model
{
    use HasFactory;
    
    protected $table = 'ordenes_servicio';

    protected $fillable = [
        'cliente_id',
        'modelo_telefono',
        'marca',
        'imei',
        'codigo_de_bloque',
        'problema_reportado',
        'estado',
        'costo_estimado',
        'costo_repuestos',
        'abono',
        'fecha_ingreso',
        'fecha_entrega',
        'user_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
