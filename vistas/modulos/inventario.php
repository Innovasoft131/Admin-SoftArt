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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarInventario"> <i class="fas fa-plus"></i> Agregar Inventario </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>genero</th>
                  <th>Foto</th>
                  <th>Precio</th>
                  <th>Cantidad</th>
                  <th>Estado</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

$item = null;
$valor = null;

$inventario = ControladorInventarios::ctrMostrarInventario($item, $valor);



foreach ($inventario as $key => $value){
 
  echo ' <tr>
          <td>'.$key.'</td>
          <td>'.$value["nombre"].'</td>
          <td>'.$value["genero"].'</td>';

          if($value["foto"] != ""){

            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

          }else{

            echo '<td><img src="vistas/img/clientes/default/1.jpg" class="img-thumbnail" width="40px"></td>';

          }


          echo '<td>'.$value["precio"].'</td>
          <td>'.$value["cantidad"].'</td>
          <td>'.$value["estado"].'</td>
          
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnEditarProducto" idProducto="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fas fa-pen"></i></button>

              <button class="btn btn-danger btnEliminarProducto" idProducto="'.$value["id"].'" fotoProducto="'.$value["foto"].'" nombreProducto="'.$value["nombre"].'"><i class="fa fa-times"></i></button>

            </div>  

          </td>

        </tr>';
}


?> 
                </tbody>
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
<div class="modal fade" id="agregarInventario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background: #007bff; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Inventario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">

              
            <!-- Entrada de codigo -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-barcode"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoCodigo" placeholder="Código">
                </div>
              </div>
            <!-- Entrada de nombre del producto -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoNommbreP" id="nuevoNommbreP" placeholder="Nombre*" require>
                </div>
              </div>

              <!-- Entrada de categoria -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  <?php
                      $item = null;
                      $valor = null;

                      $categorias = Controladorcategorias::ctrMostrarCategorias($item, $valor);
                  ?>
                  <select name="slcCategoria" class="form-control" id="slcCategoria">
                    <option value="">Seleccionar Categorías</option>
                    <?php
                      foreach ($categorias as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }
                    ?>
                  </select>

                </div>
              </div>

            <!-- Entrada de Genero -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-venus-mars"></span>
                    </div>
                  </div>
                  
                  <select name="slcGenero" class="form-control" id="slcGenero">
                    <option value="">Seleccionar Genero</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Niños">Niños</option>
                  </select>

                </div>
            </div>
            <!-- Entrada de precio -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-money-check-alt"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" autocomplete="off" name="nuevoPrecio" id="nuevoPrecio" placeholder="Precio*" require>
                  
                </div>
              </div>

            <!-- Bootstrap Switch PARA OFERTA -->
            <div class="form-group">
                <div class="input-group" id="divOfera">
                <label for="oferta" id= "lbOferta">
                    
                    ¿Oferta?
                    <input type="checkbox" class="ckOferta" name="oferta" id="oferta"    data-bootstrap-switch>
                    
                </label>
                
                

                </div>
              </div>


            <!-- Entrada de Oferta -->
            <div class="form-group" id="divOferta" hidden>
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-dollar-sign"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" autocomplete="off" name="nuevoOferta" id="nuevoOferta" placeholder="Precio en oferta">
                </div>
              </div>

            <!-- Entrada de Cantidad -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-at"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="nuevoCantidad" id="nuevoCantidad" placeholder="Cantidad*" require>
                </div>
            </div>



            <!-- Entrada de Talla -->
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-hashtag"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoTalla" id="nuevoTalla" placeholder="Talla" require>
                  <button type="button" class="btn btn-info" id="btnAgregarTabla"><i class="fas fa-plus"></i></button>




                </div>
            </div>


            <!-- tabla de talla -->
            <div class="form-group">
                <div class="input-group">
                <div class="table-responsive">
                    <table class="table  table-bordered table-striped    " id="tbInventario">
                        <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <!-- Entrada de Estado -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  
                  <select name="slcEstado" class="form-control" id="slcEstado">
                    <option value="">Seleccionar Estado del producto</option>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Oferta">Oferta</option>
                    <option value="Default">Default</option>
                  </select>

                </div>
            </div>

            <!-- Entrada de Descripción -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-pen"></span>
                    </div>
                  </div>
                  
                  <textarea class="form-control" name="nuevoDescripcion" id="nuevoDescripcion" placeholder="Descripción" ></textarea>

                </div>
            </div>




              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="nuevaFoto" id="nuevaFoto" class="foto">
                <p class="help-block">Peso máximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" id="previsualizar" width="100px">
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php
            
            $crearInventario = new ControladorInventarios();
            $crearInventario -> ctrCrearInventaario();
            

          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Inventario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Codigo -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-barcode"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="EditarCodigo" id="EditarCodigo" placeholder="Código">
                </div>
              </div>
            <!-- Entrada de Nombre del producto -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarNommbreP" id="editarNommbreP" placeholder="Nombre*" require>
                  <input type="hidden" class="form-control" name="idProducto" id="idProducto" placeholder="Nombre*" require>
                </div>
              </div>
              <!-- Entrada de categoria -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  <?php
                      $item = null;
                      $valor = null;

                      $categorias = Controladorcategorias::ctrMostrarCategorias($item, $valor);
                  ?>
                  <select name="slcCategoriaEditar" class="form-control" id="slcCategoriaEditar">
                    <option value="">Seleccionar Categorías</option>
                    <?php
                      foreach ($categorias as $key => $value) {
                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                      }
                    ?>
                  </select>

                </div>
              </div>

            <!-- Entrada de Genero -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-venus-mars"></span>
                    </div>
                  </div>
                  
                  <select name="slcGeneroEditar" class="form-control" id="slcGeneroEditar">
                    <option value="">Seleccionar Genero</option>
                    <option value="Mujer">Mujer</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Niños">Niños</option>
                  </select>

                </div>
            </div>
            <!-- Entrada de precio -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-money-check-alt"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" autocomplete="off" name="editarPrecio" id="editarPrecio" placeholder="Precio*" require>
                  
                </div>
              </div>

            <!-- Bootstrap Switch PARA OFERTA -->
            <div class="form-group">
                <div class="input-group" id="divOfera">
                <label for="ofertaEditar" id= "lbOfertaEditar">
                    
                    ¿Oferta?
                    <input type="checkbox" class="ckOferta" name="ofertaEditar" id="ofertaEditar"    data-bootstrap-switch>
                    
                </label>
                
                

                </div>
              </div>


            <!-- Entrada de Oferta -->
            <div class="form-group" id="divOfertaEditar" hidden>
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-dollar-sign"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" autocomplete="off" name="editarOfertaEditar" id="editarOfertaEditar" placeholder="Precio en oferta">
                </div>
              </div>

            <!-- Entrada de Cantidad -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-at"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="editarCantidad" id="editarCantidad" placeholder="Cantidad*" require>
                </div>
            </div>



            <!-- Entrada de Talla -->
            <div class="form-group">
                <div class="input-group">
                <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-hashtag"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarTalla" id="editarTalla" placeholder="Talla" require>
                  <button type="button" class="btn btn-info" id="btnAgregarTablaEditar"><i class="fas fa-plus"></i></button>




                </div>
            </div>


            <!-- tabla de talla -->
            <div class="form-group">
                <div class="input-group">
                <div class="table-responsive">
                    <table class="table  table-bordered table-striped    " id="tbInventarioEditar">
                        <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <!-- Entrada de Estado -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  
                  <select name="slcEstadoEditar" class="form-control" id="slcEstadoEditar">
                    <option value="">Seleccionar Estado del producto</option>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Oferta">Oferta</option>
                    <option value="Default">Default</option>
                  </select>

                </div>
            </div>

            <!-- Entrada de Descripción -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-pen"></span>
                    </div>
                  </div>
                  
                  <textarea class="form-control" name="editarDescripcion" id="editarDescripcion" placeholder="Descripción" ></textarea>

                </div>
            </div>

            <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="editarFoto" id="editarFoto"  class="foto">
                <p class="help-block">Peso máximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" id=previsualizarEditar class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php
        
          $editarInventario = new ControladorInventarios();
          $editarInventario -> ctrEditarInventario();

        ?> 

        </form>
    </div>
  </div>
</div>

<?php

  $borrarInventario = new ControladorInventarios();
  $borrarInventario -> ctrBorrarInventario();
  

?> 