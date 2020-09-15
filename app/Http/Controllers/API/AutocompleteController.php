<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class AutocompleteController extends Controller
{
    public function autocomplete(Request $request)
    {

        $palabraabuscar = $request->get('palabraabuscar');

        $productos = Product::where('nombre','like','%'.$palabraabuscar.'%')
            ->orderBy('nombre')
            ->get();        

        $resultados=[];

        foreach($productos as $producto){

            $encontrartexto = stristr($producto->nombre, $palabraabuscar);
            $producto->encontrar = $encontrartexto;

            $recortarpalabra = substr($encontrartexto, 0, strlen($palabraabuscar));
            $producto->substr = $recortarpalabra;

            $producto->nombrenegrita = str_ireplace($palabraabuscar, "<b>$recortarpalabra</b>", $producto->nombre);

            $resultados[] = $producto; 

        }

        return $resultados;
    }
}
