<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'accesorio_id',
        'cantidad',
        'precio',
        'valor_compra',
        'cliente_id',
        'fecha',
        'user_id',
    ];
    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function accesorio()
    {
        return $this->belongsTo(Accesorio::class, 'accesorio_id');
        return $this->belongsTo(Accesorio::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
public function detalleFactura()
{
    return $this->belongsTo(DetalleFactura::class);
}

}
