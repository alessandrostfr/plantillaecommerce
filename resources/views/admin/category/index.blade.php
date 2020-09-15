@extends('plantilla.admin')


@section('titulo', 'Categorias')

@section('miga')

  <li class="breadcrumb-item active">@yield('titulo')</li>

@endsection

@section('contenido')

  <div  id="confirmareliminar" >        

    <span id="urlbase"  style="display:none" >{{ route('admin.category.index') }}</span>

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
          <table class="table table-head-fixed">
            <thead>
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>SLUG</th>
                <th>DESCRIPCION</th>
                <th>CREADO</th>
                <th>ACTUALIZADO</th>
                <th colspan="3">
                  <a href="{{ route('admin.category.create') }}" class="btn btn btn-primary float-right">
                    Nueva
                  </a>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach($categorias as $categoria)
              <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->slug }}</td>
                <td>{{ $categoria->descripcion }}</td>
                <td>{{ $categoria->created_at }}</td>
                <td>{{ $categoria->updated_at }}</td>


                <td width="10px">
                  <a href="{{ route('admin.category.show', $categoria->id) }}" class="btn btn-sm ">
                      <i class="far fa-eye"></i>
                  </a>
                </td>


                <td width="10px">
                  <a href="{{ route('admin.category.edit', $categoria->slug) }}" class="btn btn-sm btn-default">
                    <i class="fas fa-edit"></i>
                  </a>
                </td>


                <td width="10px">
                  <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-danger"
                  v-on:click.prevent="deseas_eliminar({{ $categoria->id }})">
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
          {{ $categorias->appends($_GET)->links() }}
        </div>                          
      </div><!-- footer-->

    </div><!-- card-->
  </div> <!-- row-->

@endsection