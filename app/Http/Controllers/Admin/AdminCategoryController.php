<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class AdminCategoryController extends Controller
{
    
    public function  __construct(){


        $this->middleware('auth');
    }




    public function index(Request $request)
    {
        $nombre = $request->get('nombre');
        $categorias = Category::where('nombre', 'like', "%$nombre%")->orderBy('id')->paginate(5);
        return view('admin.category.index', compact('categorias'));
    }

    
    
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //FORMA1 DE GUARDAR

        // $cat                 = new Category();
        // $cat->nombre         = $request->nombre;
        // $cat->slug           = $request->slug;
        // $cat->descripcion    = $request->descripcion;
        // $cat->save();
        
        //return $cat;

        //FORMA2 DE GUARDAR CON LA PROPIEDAD $FILLABLE EN EL MODELO

        // $cat = Category::create($request->all());
        // return redirect('admin/category');

        //FORMA3

        $request->validate([

            'nombre' => 'required|max:50|unique:categories,nombre',
            'slug' => 'required|max:50|unique:categories,slug',
            'descripcion' => 'max:100'


        ]);


        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('datos', 'Registro creado correctamente!');
    
        
    
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $categoria = Category::findOrFail($id)->first();
        $editar = 'Si';
        return view('admin.category.show', compact('categoria', 'editar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cat = Category::where('slug', $slug)->firstOrFail();
        $editar = 'Si';
        return view('admin.category.edit', compact('cat', 'editar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cat = Category::findOrFail($id);

        $request->validate([

            'nombre' => 'required|max:50|unique:categories,nombre,' . $cat->id,
            'slug' => 'required|max:50|unique:categories,slug,' . $cat->id,
            'descripcion' => 'max:100'


        ]);

        $cat->fill($request->all())->save();
        
        // return $cat;

        return redirect()->route('admin.category.index')->with('datos', 'Registro actualizado correctamente!');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::findOrFail($id)->delete();
        
        return redirect()->route('admin.category.index')->with('datos', 'Registro eliminado correctamente!');
    }
}
