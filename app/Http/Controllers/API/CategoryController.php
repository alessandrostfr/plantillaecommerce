<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    
    public function index()
    {
        // $cat = new Category();

        // $cat->nombre='Hombre';
        // $cat->slug='hombre';
        // $cat->descripcion='Ropa de Hombre';
        // $cat->save();

        // $cat2 = new Category();

        // $cat2->nombre='Mujer';
        // $cat2->slug='mujer';
        // $cat2->descripcion='Ropa de Mujer';
        // $cat2->save();

        return Category::all();



    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show($slug)
    {
        if(Category::where('slug', $slug)->first()){
            
            return 'Slug existe';

        }else{

            return 'Slug Disponible';
        }
        
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
