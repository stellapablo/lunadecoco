<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    protected $fillable = ['nombre'];


    public function compras(){
        return $this->hasMany(Compra::class,'pedido_id');
    }
}
