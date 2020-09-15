@extends('plantilla.admin')


@section('titulo', 'Ver Categoria')

@section('miga')

<li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Categorias</a></li>
<li class="breadcrumb-item active">@yield('titulo')</li>

@endsection

@section('contenido')



    {{-- <div id="apicategory">
            

        <div class="row">
            <div class="col-md-6">

                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                    <i class="fas fa-text-width"></i>
                    Description
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <dl>
                    <dt>Id</dt>
                    <dd>{{ $categoria->id }}</dd>
                    <dt>Nombre</dt>
                    <dd>{{ $categoria->nombre }}</dd>
                    <dt>Slug</dt>
                    <dd>{{ $categoria->slug }}</dd>
                    <dt>Descripcion</dt>
                    <dd>{{ $categoria->descripcion }}</dd>
                    <dt>Creado</dt>
                    <dd>{{ $categoria->created_at }}</dd>
                    <dt>Actualizado</dt>
                    <dd>{{ $categoria->updated_at }}</dd>
                    </dl>

                </div>

                <div class="card-footer">
                
                    <a href="{{ route('cancelar','admin.category.index') }}" class="btn btn-danger">Cancelar</a>

                    <a href="{{ route('admin.category.edit',
                    $categoria->slug) }}" class="btn btn-success float-right"> <i class="fas fa-edit"></i> </a>
                
                
                    
                    
                </div>
                <!-- /.card-body -->
            </div>

            
                <!-- /.card -->
        </div><!-- ./col -->
            
    </div><!-- /.apicategory --> --}}



    <div id="apicategory">
    <form >
      @csrf
  


      

      <span style="display:none;" id="editar">{{ $editar }}</span>
      <span style="display:none;" id="nombretemp">{{ $categoria->nombre}}</span>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Administración de Categorias</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
              
                
                    
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        
                        <input v-model="nombre" 
    
                            @blur="getCategory" 
                            @focus = "div_aparecer= false"
                            
                        
                        class="form-control" type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }} " readonly>



                        <label for="slug">Slug</label>
                       
                        <input  v-model="generarSLug"  class="form-control" type="text" name="slug" id="slug" value="{{ $categoria->slug }} " readonly>


                        
                        <label for="descripcion">Descripción</label>

                        <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="5" readonly>  {{ $categoria->descripcion }}  </textarea>
                        
                    </div>
                   

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a class="btn btn-danger" href="{{ route('cancelar','admin.category.index') }}">Cancelar</a>
          
            <a class="btn btn-outline-success float-right" href="{{ route('admin.category.edit',$categoria->slug) }}">Editar</a>
          

            
          
                
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    </form>
</div>



@endsection