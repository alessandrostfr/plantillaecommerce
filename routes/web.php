<?php

use Illuminate\Support\Facades\Route;

use App\Product;
use App\Category;
use App\Image;
use App\User;

//Para hacer las pruebas con las imagenes
Route::get('/prueba', function () {

    //20 eliminar una image

        $producto = App\Product::with('images', 'category')->orderBy('id', 'desc')->get();

        

        return $producto;
});


//Mostrar resultados
Route::get('/resultados', function () {

    $image = Image::orderBy('id', 'Desc')->get();

    return $image;

});


Route::get('/', function () {

    // $prod = new Product();

    // $prod->nombre = 'Producto 3';
    // $prod->slug = 'producto-3';
    // $prod->category_id = 2;
    // $prod->descripcion_corta = 'Producto 3';
    // $prod->descripcion_larga = 'Producto 3';
    // $prod->especificaciones = 'Producto 3';
    // $prod->datos_de_interes = 'Producto 3';
    // $prod->estado = 'Nuevo';
    // $prod->activo = 'Si';
    // $prod->sliderprincipal = 'No';
    // $prod->save();
    // return $prod;


    //return view('welcome');

    // $prod = Product::find(1)->first()->category;

    // return $prod;

    return view('tienda.index');


});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/admin', function () {

    return view('plantilla.admin');

})->name('admin')->middleware('auth');

Route::resource('admin/category', 'Admin\AdminCategoryController')->names('admin.category');

Route::resource('admin/product', 'Admin\AdminProductController')->names('admin.product');



Route::get('cancelar/{ruta}', function($ruta){

    return redirect()->route($ruta)->with('cancelar', 'Accion Cancelada!');

})->name('cancelar');



