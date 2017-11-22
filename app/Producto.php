<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Producto extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'productos';

    protected $fillable = ['nombre','precio','descripcion','imagen','tipo_id','slug','url','imagen2'];


    public function compras(){
        return $this->hasMany(Compra::class,'producto_id');
    }
}
