  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inventario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Inventario</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto" style="background: rgb(255 136 2); border: 0px solid ;"> <i class="fas fa-plus"></i> Agregar producto</button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped dt-responsive tablaProductos" >
                <thead>
                  <tr>

                    <th style="width:10px">#</th>
                    <th>Imagen</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Precio de compra</th>
                    <th>Precio de venta</th>
                    <th>Agregado</th>
                    <th>Acciones</th>

                  </tr>
                </thead>
              </table>
            </div>
        </div>

      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>


  <!-- modal -->

  <!-- Modal Registro -->
<div class="modal fade" id="modalAgregarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-th"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                  }

                  ?>
  
                </select>
                </div>
              </div>
            <!-- ENTRADA PARA EL CÓDIGO -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-code"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly required>
                  
                </div>
              </div>

              <!-- ENTRADA PARA LA DESCRIPCIÓN -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-keyboard"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control input-lg" name="nuevaNombre" placeholder="Ingresar Nombre" required>
                  
                </div>
              </div>

              <!-- ENTRADA PARA STOCK -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-check"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>
                  
                </div>
              </div>              

              <!-- ENTRADA PARA PRECIO COMPRA -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-arrow-up"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>
                  
                </div>
              </div>    

             <!-- ENTRADA PARA PRECIO VENTA -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-arrow-down"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>
                  
                </div>
              </div>                

             <!-- ENTRADA PARA OFERTA -->
             <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tags"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" id="nuevoPrecioOferta" name="nuevoPrecioOferta" step="any" min="0" placeholder="Precio de oferta (Opcional)" required>
                  
                </div>
              </div> 

             <!-- CHECKBOX PARA PORCENTAJE -->
             <div class="form-group col-xs-6">
                <div class="input-group autocompletar">
                  <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>
                  
                </div>
              </div>  

             <!-- ENTRADA PARA PORCENTAJE -->
             <div class="form-group col-xs-6">
                <div class="input-group autocompletar">
                <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-percent"></span>
                    </div>
                  </div>
                  
                </div>
              </div> 

                
             <!-- entrada de color -->
             <div class="form-group col-xs-6">
                <div class="input-group autocompletar">
                  <input type="color" title="Selecciona color" class="btnColor" name="nuevoColor" id="nuevoColor" value="#2498cb">
                  <label class="labelC">
                    Selecciona color (opcional)
                  </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="button" class="btn btn-info" title="Agregar color a tabla" id="btnAgregarColor" style="background: rgb(255 136 2); border: 0px solid ;"><i class="fas fa-plus"></i> Agregar a tabla </button>
                </div>
              </div> 

              <!-- entrada de colores -->
              <div class="form-group">
              <div class="input-group">
                <table class="table table-bordered table-hover" id="tbProductoColor">
                  
                </table>
              </div>
            </div>

            <!-- Entrada de talla -->
            <div class="form-group">
                <div class="input-group ">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-ruler-horizontal"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control col-9" name="nuevotalla" id="nuevotalla" placeholder="Talla (Opcional)" require="">
                  
                  <button type="button" class="btn btn-info col-2" id="btnagregarTalla" title="Agregar talla a tabla" style="background:#3c8dbc; color:white; border: 0px solid">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              <!-- entrada de tallas -->
              <div class="form-group">
              <div class="input-group">
                <table class="table table-bordered table-hover" id="tbProductoTalla">
                  
                </table>
              </div>
            </div>


              <!-- entrada para la descripción -->
             <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-pencil-alt"></span>
                    </div>
                  </div>
                  <textarea class="form-control" id="nuevoDescripcion" name="nuevoDescripcion" rows="3" placeholder="Descripción del producto" required></textarea>

                  
                </div>
              </div> 

              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir</div>
                <input type="file" class="nuevaImagen" name="nuevaImagenI" id="nuevaImagenI">
                <p class="help-block">Peso máximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" id="imagen" width="100px">
                
              </div> 


            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
            $crearProducto = new ControladorProductos();
            $crearProducto -> ctrCrearProducto();
          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off"  enctype="multipart/form-data">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
              <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-th"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg"  name="editarCategoria" readonly required>
                  
                  <option id="editarCategoria"></option>

                </select>
                </div>
              </div>
            <!-- ENTRADA PARA EL CÓDIGO -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-code"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>
                  
                </div>
              </div>

              <!-- ENTRADA PARA LA DESCRIPCIÓN -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-keyboard"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" required>
                  
                </div>
              </div>

              <!-- ENTRADA PARA STOCK -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-check"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" id="editarStock" name="editarStock" min="0" required>
                  
                </div>
              </div>              

              <!-- ENTRADA PARA PRECIO COMPRA -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-arrow-up"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" step="any" min="0" required>
                  
                </div>
              </div>    

             <!-- ENTRADA PARA PRECIO VENTA -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-arrow-down"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" step="any" min="0" readonly required>
                  
                </div>
              </div>                

             <!-- CHECKBOX PARA PORCENTAJE -->
             <div class="form-group col-xs-6">
                <div class="input-group autocompletar">
                  <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>
                  
                </div>
              </div>  

             <!-- ENTRADA PARA PORCENTAJE -->
             <div class="form-group col-xs-6">
                <div class="input-group autocompletar">
                <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-percent"></span>
                    </div>
                  </div>
                  
                </div>
              </div> 



              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir</div>
                <input type="file" class="nuevaImagen" name="editarImagen" id="editarImagen">
                <p class="help-block">Peso máximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" id="imagen" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div> 


            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
          $editarProducto = new ControladorProductos();
          $editarProducto -> ctrEditarProducto();
          ?>
        </form>
    </div>
  </div>
</div>


<?php
 
 $eliminarProducto = new ControladorProductos();
 $eliminarProducto -> ctrEliminarProducto();

 ?>