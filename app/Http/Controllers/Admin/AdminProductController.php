<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use App\Image;

class AdminProductController extends Controller
{
    

    public function  __construct(){


        $this->middleware('auth');
    }



    public function index(Request $request)
    {
        $nombre = $request->get('nombre');

        $productos = Product::with('images', 'category')->where('nombre', 'like', "%$nombre%")->orderBy('id', 'desc')->paginate(5);

        return view('admin.product.index', compact('productos'));
    }

    
    public function create()
    {
        $categorias = Category::orderBy('nombre')->get();

        $estados_productos = $this->estados_productos();
        return view('admin.product.create', compact('categorias','estados_productos'));
    }

    

    public function store(Request $request)
    {


        $request->validate([

            'nombre' => 'required|unique:products,nombre',
            'slug' => 'required|unique:products,slug',
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        ]);

        $urlimagenes = [];

        if($request->hasFile('imagenes')){

            $imagenes = $request->file('imagenes');

            // dd ($imagenes);

            foreach($imagenes as $imagen){

                $nombre = time().'_' .$imagen->getClientOriginalName();

                $ruta = public_path(). '/imagenes';

                $imagen->move($ruta,$nombre);

                $urlimagenes[]['url'] = '/imagenes/' . $nombre;

            }

        }


        $producto = new Product;

        $producto->nombre=                   $request->nombre;
        $producto->slug=                     $request->slug;
        $producto->category_id=              $request->category_id;	
        $producto->cantidad=                 $request->cantidad;
        $producto->precio_anterior=          $request->precioanterior;
        $producto->precio_actual=            $request->precioactual;
        $producto->porcentaje_descuento=     $request->porcentajededescuento;
        $producto->descripcion_corta=        $request->descripcion_corta;
        $producto->descripcion_larga=        $request->descripcion_larga;
        $producto->especificaciones=         $request->especificaciones;
        $producto->datos_de_interes=         $request->datos_de_interes;
        $producto->estado=                   $request->estado;
        
        if($request->activo){

            $producto->activo=   'Si';

        }else{
            $producto->activo=   'No';

        }

        if($request->sliderprincipal){

            $producto->sliderprincipal=  'Si';

        }else{
            $producto->sliderprincipal=  'No';

        }

        $producto->save();

        $producto->images()->createMany($urlimagenes);

        return redirect()->route('admin.product.index')->with('datos', 'Registro creado correctamente!');
    }

    
    public function show($slug)
    {
        $producto = Product::with('images', 'category')->where('slug',$slug)->firstOrFail();
    
        $categorias = Category::orderBy('nombre')->get();

        $estados_productos = $this->estados_productos();
        // dd($estados_productos);

        return view('admin.product.show', compact('categorias','producto','estados_productos'));
    
    }

   
    public function edit($slug)
    {
        
        $producto = Product::with('images', 'category')->where('slug',$slug)->firstOrFail();
    
        $categorias = Category::orderBy('nombre')->get();

        $estados_productos = $this->estados_productos();
        // dd($estados_productos);

        return view('admin.product.edit', compact('categorias','producto','estados_productos'));
    
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([

            'nombre' => 'required|unique:products,nombre,' . $id,
            'slug' => 'required|unique:products,slug,' . $id,
            'imagenes.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        ]);

        $urlimagenes = [];

        if($request->hasFile('imagenes')){

            $imagenes = $request->file('imagenes');

            // dd ($imagenes);

            foreach($imagenes as $imagen){

                $nombre = time().'_' .$imagen->getClientOriginalName();

                $ruta = public_path(). '/imagenes';

                $imagen->move($ruta,$nombre);

                $urlimagenes[]['url'] = '/imagenes/' . $nombre;

            }

        }


        $producto = Product::findOrFail($id);

        $producto->nombre=                   $request->nombre;
        $producto->slug=                     $request->slug;
        $producto->category_id=              $request->category_id;	
        $producto->cantidad=                 $request->cantidad;
        $producto->precio_anterior=          $request->precioanterior;
        $producto->precio_actual=            $request->precioactual;
        $producto->porcentaje_descuento=     $request->porcentajededescuento;
        $producto->descripcion_corta=        $request->descripcion_corta;
        $producto->descripcion_larga=        $request->descripcion_larga;
        $producto->especificaciones=         $request->especificaciones;
        $producto->datos_de_interes=         $request->datos_de_interes;
        $producto->estado=                   $request->estado;
        
        if($request->activo){

            $producto->activo=   'Si';

        }else{
            $producto->activo=   'No';

        }

        if($request->sliderprincipal){

            $producto->sliderprincipal=  'Si';

        }else{
            $producto->sliderprincipal=  'No';

        }

        $producto->save();

        $producto->images()->createMany($urlimagenes);

        return redirect()->route('admin.product.edit',$producto->slug)->with('datos', 'Registro actualizado correctamente!');
    
    }


    public function destroy($id)
    {
        $producto = Product::with('images')->findOrFail($id);

        foreach($producto->images as $image){
            $archivo = substr($image->url,1);

            File::delete($archivo);

            $image->delete();
        }
        
        
        
        $producto->delete();
        
        return redirect()->route('admin.product.index')->with('datos', 'Producto eliminado correctamente!');
    }


    public function estados_productos(){

        return[
            '',
            'Nuevo',
            'En Oferta',
            'Popular',

        ];
    }
}
