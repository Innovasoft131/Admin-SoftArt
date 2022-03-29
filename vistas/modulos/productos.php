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
            <table class="table table-bordered table-striped dt-responsive tablaProductos">
              <thead>
                <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Subcategoria</th>
                  <th>Imagen</th>
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
    <div class="modal-dialog modal-lg" role="document">
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
                      <span class="fa fa-spray-can"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>

                    <option value="">Selecionar categoría</option>

                    <?php

                    $item = null;
                    $valor = null;

                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    foreach ($categorias as $key => $value) {

                      echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                    }

                    ?>

                  </select>
                </div>
              </div>
              <!-- ENTRADA PARA SELECCIONAR SUBCATEGORÍA -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-th"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" id="nuevaSubCategoriaP" name="nuevaSubCategoriaP" required>

                    <option value="">Selecciona subcategoría</option>



                  </select>
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
                  <input type="text" class="form-control input-lg" name="nuevaNombre" id="nuevaNombre" placeholder="Ingresar Nombre" required>

                </div>
              </div>

              <!-- ENTRADA PARA LA PRECIO -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-arrow-up"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" name="nuevoPrecio" id="nuevoPrecio" placeholder="Ingresar Precio" min="1" required>

                </div>
              </div>
              <!-- ENTRADA PARA LA OFERTA -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-arrow-down"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" name="nuevoOferta" id="nuevoOferta" placeholder="Ingresar Oferta" min="1" required>

                </div>
              </div>
              <!-- Entrada de tamaños -->
              <!-- 
            <div class="form-group">
                <div class="input-group ">

                  <input type="text" class="form-control" name="nuevotamanio" id="nuevotamanio" placeholder="Tamaño (Opcional)" require>
                  <input type="text" class="form-control" name="nuevomedidas" id="nuevomedidas" placeholder="Medidas (Opcional)" require>
                  <input type="text" class="form-control" name="nuevoMaterial" id="nuevoMaterial" placeholder="Material (Opcional)" require>

                </div>
              </div>

            --->
              <!-- Entrada de talla -->
              <!--
            <div class="form-group">
                <div class="input-group">

                  <input type="text" class="form-control" name="nuevoPrecio" id="nuevoPrecio" placeholder="Precio (Opcional)" require>
                  <input type="text" class="form-control" name="nuevoCantidad" id="nuevoCantidad" placeholder="Cantidad (Opcional)" require>
                  
                  
                </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                  <label for="nuevoColor" id= "lbColor">
                    ¿Color?
                    <input type="checkbox" class="ckColor" name="nuevoColor" id="nuevoColor"    data-bootstrap-switch>
                  </label>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="color" hidden  title="Color en palabra de slogan" class="btnColor col-2" name="colorProducto" id="colorProducto" value="#000">
                  
                  <button type="button" class="btn btn-info col-2" id="btnagregarDetalleProducto" title="Agregar detalles del producto" style="background:#3c8dbc; color:white; border: 0px solid">
                    <i class="fas fa-plus"></i>
                  </button>
                </div>
              </div>
              -->
              <!-- entrada de tallas -->
              <!--
              <div class="form-group">
              <div class="input-group">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover" id="tbProductoTalla">
                    <thead>
                      <tr>
                        
                        <th scope="col">Tamaño</th>
                        <th scope="col">Medidas</th>
                        <th scope="col">Material</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Color</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    
                  </table>

                </div>
              </div>
            </div>

             -->
              <!-- entrada para la descripción -->
              <div class="form-group ">
                <div class="input-group autocompletar">

                  <textarea class="form-control" id="summernote">
                      Descripción
                    </textarea>


                </div>
              </div>

              <!-- subir foto -->
              <div class="form-group col-12">
                <div class="panel">Subir</div>
                <input type="file" class="nuevaImagen col-12" name="nuevaImagenI" id="nuevaImagenI">
                <p class="help-block">Peso máximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" id="imagen" width="100px">

              </div>


            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary btnGuardarProducto" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>

        </form>
      </div>
    </div>
  </div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form role="form" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-header" style="background: rgb(255 136 2); color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
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
                      <span class="fa fa-spray-can"></span>
                    </div>
                  </div>
                  <input type="hidden" name="txtproducto" id="txtproducto">
                  <select class="form-control input-lg" id="editarCategoria" name="editarCategoria" required>

                    <option value="">Selecionar categoría</option>

                  </select>
                </div>
              </div>
              <!-- ENTRADA PARA SELECCIONAR SUBCATEGORÍA -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fa fa-th"></span>
                    </div>
                  </div>
                  <select class="form-control input-lg" id="editSubCategoriaP" name="editSubCategoriaP" required>

                    <option value="">Selecciona subcategoría</option>



                  </select>
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
                  <input type="text" class="form-control input-lg" name="editarNombreProductoDetalle" id="editarNombreProductoDetalle" placeholder="Ingresar Nombre" required>

                </div>
              </div>


              <!-- ENTRADA PARA LA PRECIO -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-arrow-up"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" name="editarPrecio" id="editarPrecio" placeholder="Ingresar Precio" min="1" required>

                </div>
              </div>
              <!-- ENTRADA PARA LA OFERTA -->
              <div class="form-group ">
                <div class="input-group autocompletar">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-arrow-down"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control input-lg" name="editarOferta" id="editarOferta" placeholder="Ingresar Oferta" min="1" required>

                </div>
              </div>


              <!-- entrada para la descripción -->
              <div class="form-group ">
                <div class="input-group autocompletar">

                  <textarea class="form-control" id="summernoteEditar" name="summernoteEditar">

                    </textarea>


                </div>
              </div>

              <!-- subir foto -->
              <div class="form-group col-12">
                <div class="panel">Subir</div>
                <input type="file" class="nuevaImagen col-12" name="editarImagenI" id="editarImagenI">
                <p class="help-block">Peso máximo de la foto 6 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" id="imagen" width="100px">
                <input type="hidden" name="fotoActualProducto" id="fotoActualProducto">

              </div>




            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background: rgb(255 136 2); border: 0px solid ;">Guardar</button>
          </div>
          <?php
          $editarProducto = new ControladorProductos();
          $editarProducto->ctrEditarProducto();
          ?>
        </form>
      </div>
    </div>
  </div>


  <?php

  $eliminarProducto = new ControladorProductos();
  $eliminarProducto->ctrEliminarProducto();

  ?>