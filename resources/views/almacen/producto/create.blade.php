@extends ('layouts.admin')
@section ('contenido')
<div class ="col-md-12">
       <div class="card card-primary">
              <div class="card-header">
                     <h3 class="card-title">Nueva Producto</h3>

              </div>
               <form action="{{ route('producto.store') }}" method="POST" enctype="multipart/form-data" class="form">
                            @csrf
                            <div class="card-body">
                                   <div class="row">
                                          <div class="col-md-6 col-12">
                                    <div class="form-group">
                                           <label for="categoria">Nombre</label>
                                           <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingresa el nombre del producto">
                                    </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <div class="form-group">
                                           <label>Categoria</label>
                                           <select name="id_categoria" class="form-control" id="id_categoria">
                                                 @foreach ($categorias as $cat)
                                                 <option value="{{$cat->id_categoria}}">{{$cat->categoria}}</option>
                                                 @endforeach
                                           </select>
                                    </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    <div class="form-group">
                                            <label for="codigo">Codigo</label>
                                           <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Ingresa el codigo del producto">
                                           </div>
                                   </div>
                                   <div class="col-md-6 col-12">
                                    <div class="form-group">
                                            <label for="stock">Stock</label>
                                           <input type="text" class="form-control" name="stock" id="stock" placeholder="Ingresa el stock del producto">
                                           </div>
                                   </div>
                                  
                                   <div class="col-md-6 col-12">
                                    <div class="form-group">
                                            <label for="descripcion">Descripcion</label>
                                           <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Ingresa la descripcion del producto">
                                           </div>
                                   </div>
                                   <div class="col-md-6 col-12">
                                    <div class="form-group">
                                            <label for="imagen">Imagen</label>
                                           <input type="file" class="form-control"  id="imagen" name="imagen">
                                           </div>
                                   </div>
                                   <div class="card-footer">
                                           <button type="submit" class="btn btn-success me-1 mb-1">Guardar</button>
                                           <button type="reset" class="btn btn-danger me-1 mb-1">Cancelar</button>
                                   </div>


                                   </div>
                            </div>
                     </form>
               
        </div>
</div>
@endsection