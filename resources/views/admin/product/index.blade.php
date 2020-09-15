@extends('plantilla.admin')


@section('titulo', 'Productos')

@section('miga')

  <li class="breadcrumb-item active">@yield('titulo')</li>

@endsection

@section('contenido')
  <style type="text/css">

    .table1{
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;
      text-align: center;

    }
    .table1 td, .table1 th{

        padding: .75rem;
        vertical-align: center;
        border-top: 1px solid#dee2e6;

    }


  </style>





  <div  id="confirmareliminar" >        

    <span id="urlbase"  style="display:none" >{{ route('admin.product.index') }}</span>

    @include('custom.modal_eliminar')

    <div class="card">


      <div class="card-header">
        <h3 class="card-title">@yield('titulo')</h3>

          <div class="card-tools" style="margin: auto;">

            <form>

              <div>
                <button type="button" class="btn btn-tool float-right" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                  <i class="fas fa-times"></i>
                </button>

                <button type="button" class="btn btn-tool float-right" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              

              <div class="card-tools " style="margin-right: 30%;">
                
                <div class="input-group input-group" style="widtg: 150px;">
                  <input type="text" name="nombre" class="form-control " placeholder="Buscar" value="{{ request()->get('nombre') }}">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
                </div>
                
              </div>

            </form>

          </div>
      </div>
                      
                      
      <div class="card-body">                    
        <div class="table-responsive">
          <table class="table1 table-head-fixed">
            <thead>
              <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Estado</th>
                <th>Activo</th>
                <th>Precio</th>
                <th colspan="3">
                  <a href="{{ route('admin.product.create') }}" class="btn btn btn-success float-right">
                    Nuevo
                  </a>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($productos as $producto)
              <tr>
                <td>{{ $producto->id }}</td>
                <td>
                
                @if($producto->images->count() <= 0)
                  <img style="height: 100px; width: 100px;" src="/imagenes/default.png" class="rounded-circle">
                @else
                  <img style="height: 100px; width: 100px;" src="{{ $producto->images->first()->url }}" class="rounded-circle">
                @endif
                
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->category->nombre }}</td>
                <td>{{ $producto->estado }}</td>
                <td>{{ $producto->activo }}</td>
                <td>{{ $producto->precio_actual }}€</td>


                <td width="10px">
                  <a href="{{ route('admin.product.show', $producto->slug) }}" class="btn btn-sm btn-default">
                      <i class="far fa-eye"></i>
                  </a>
                </td>


                <td width="10px">
                  <a href="{{ route('admin.product.edit', $producto->slug) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-edit"></i>
                  </a>
                </td>


                <td width="10px">
                  <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-danger"
                  v-on:click.prevent="deseas_eliminar({{ $producto->id }})">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>


              </tr>
              @endforeach
            </tbody>
          </table>
        </div>       
      </div><!--card-->
      
      <div class="card-footer">           
        <div>                 
          {{ $productos->appends($_GET)->links() }}
        </div>                          
      </div><!-- footer-->

    </div><!-- card-->
  </div> <!-- row-->

@endsection