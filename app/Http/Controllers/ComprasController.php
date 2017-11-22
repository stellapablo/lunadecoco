<?php

namespace App\Http\Controllers;

use App\Compra;
use Illuminate\Http\Request;

class ComprasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $compras = Compra::orderBy('id','DESC')->get();

        return view('compras.index',compact('compras'));
    }


}
