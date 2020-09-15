<?php



    
    //00 Saber si un usuario o producto tiene o no una imagen

        $usuario = User::find(1);

        $image = $usuario->image;

        if($image){
            echo 'Si tiene una imagen';
        }else{
            echo 'No tiene una imagen';

        }

        return $image;

    
    //01 Crear una imagen para un usuario utilizando el metodo save

        $imagen = new Image(['url' => 'imagenes/avatar.png']);

        $usuario = User::find(1);

        $usuario->image()->save($imagen);

        return $usuario;


    //02 obtener las imformaciones de las imagenes a traves del usuario

        $usuario = User::find(1);
        return  $usuario->image;
        // return  $usuario->image->url;


    //03 crear varias imagenes para un productto utilizando el metodo savemany

        $producto =   Product::find(2);

        $producto->images()->saveMany([

                new App\Image(['url'=> 'imagenes/avatar.png']),
                new App\Image(['url'=> 'imagenes/avatar2.png']),
                new App\Image(['url'=> 'imagenes/avatar3.png']),


        ]);

        return $producto->images;


    //04 Crear una imagen para un usuario utilizando el metodo create

        $usuario = User::find(1);

        $usuario->image()->create([

            'url' => 'imagenes/avatar.png',
        ]);

        return $usuario;


        /////////////////Otra forma seria asi

            $imagen = [];

            $imagen['url'] = 'imagenes/avatar3.png';

            $usuario = User::find(1);

            $usuario->image()->create($imagen);

            return $usuario;


    //05 Crear varias imagenes para un producto utilizando el metodo createmany

        $imagen = [];

        $imagen[]['url'] = 'imagenes/avatar.png';
        $imagen[]['url'] = 'imagenes/avatar2.png';
        $imagen[]['url'] = 'imagenes/avatar3.png';
        $imagen[]['url'] = 'imagenes/a.png';
        $imagen[]['url'] = 'imagenes/a.png';
        $imagen[]['url'] = 'imagenes/a.png';

        $producto = App\Product::find(1);
        $producto->images()->createMany($imagen);

        return $producto->images;


    //06 actualizar la imagen del usuario

        $usuario = User::find(1);

        $usuario->image->url='images/avatar3.png';

        $usuario->push();

        return $usuario->image;

     
    //07 actualizar una imagen de un producto

        $producto = App\Product::find(2);

        $producto->images[0]->url='imagenes/a.png';

        $producto->push();

        return $producto->images;


    //08 Buscar el registro relacionado con la imagen

        $image = App\Image::find(2);

        return $image->imageable;


    //09 delimitar los registros

        $producto = App\Product::find(1);

        return $producto->images()->where('url', 'imagenes/a.png')->get();


    //10 Ordenar los registros que provienen de la relacion

        $producto = App\Product::find(1);

        return $producto->images()->where('url', 'imagenes/a.png')->orderBy('id', 'asc')->get();


    //11 Contar los registros relacionados

        $usuario = App\User::withCount('image')->get();
        $usuario = $usuario->find(1);

        return $usuario->image_count;


    //12 Contar los registros relacionados a los productos

        $productos = App\Product::withCount('images')->get();
        $productos = $productos->find(2);

        return $productos;


    //13 Contar los registros relacionados a los productos de otra forma mejor

        $productos = App\Product::find(2);

        return $productos->loadCount('images');


    //13 Contar los registros relacionados a los productos de otra forma mejor

        $productos = App\Product::find(2);

        return $productos->loadCount('images');


    //14  lazy loading/carga diferida- crea lentitud ya que hace varias peticiones a la bd

        $producto = App\Product::find(2); //peticion 1

        $imagen = $producto->image;//peticion 2

        $categoria = $producto->category;//peticion 3


    //15  Eager loading/carga previa - es mas conveniente ya que reduce las peticiones a la bd y por tanto es mas rapida la app

        $producto = App\Product::with('images')->get(); //peticion 1 y tenemos los mismos datos que con 2 y se puede ampliar mucho

        return $producto;


    //16  Eager loading para usuarios

        $usuario = App\User::with('image')->get(); 

        return $usuario;

        //16.1  Eager loading para usuarios accediendo a la imagen

            $usuario = App\User::with('image')->find(1); 

            return $usuario->image->url;


    //17  Eager loading/carga previa de multiples relaciones

        $producto = App\Product::with('images', 'category')->get(); //peticion 1 y tenemos los mismos datos que con 3 

        return $producto;


    //18  Eager loading/carga previa de multiples relaciones de un producto en especifico

        $producto = App\Product::with('images', 'category')->find(2); //peticion 1 y tenemos los mismos datos que con 3 

        return $producto;


    //19  Eager loading/carga previa - filtrado en el with para delimitar que es lo que queremos que nos traiga de una relacion, 
    // y es  preciso agregar la Pk aparte de los datos que queramos obtener( hay que indicar el FK en caso de que la relacion no este hecha desde la propia tabla principal)

        $producto = App\Product::with('images:id,imageable_id,url', 'category:id,nombre,slug')->find(2); //peticion 1 y tenemos los mismos datos que con 3 

        return $producto;


    //20 eliminar una image

        $producto = App\Product::find(2);

        $producto->images[0]->delete();

        return $producto;

    
    //21 eliminar todas las imagenes

    $producto = App\Product::find(2);

    $producto->images()->delete();

    return $producto;
    
        


























?>