<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'movimientos_compras';

    protected $fillable = ['nombre', 'direccion', 'email', 'telefono', 'cantidad', 'entregaInicio', 'entregaFinal',
        'pedido_id', 'producto_id', 'ml_id'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class);

    }
}
