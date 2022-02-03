  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categorías</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Categorías</li>
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
          <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCategoria"> <i class="fas fa-plus"></i> Agregar Categorías </button>
         
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas" >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Categoría</th>
                  <th>Subcategoría</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                  
                <?php
                $item = null;
                $valor = null;

                $respuesta = Controladorcategorias::ctrMostrarCategorias($item, $valor);

                foreach ($respuesta as $key => $value) {
                  $itemSub = 'idCategoria';
                  $valorSub = $value["id"];

                  $respuestaSub = Controladorcategorias::ctrMostrarSubCategorias($itemSub, $valorSub);
                  
                    echo '<tr>
                            <td>'.$key.'</td>
                            <td>'.$value["nombre"].'</td>
                            <td>
                              <ul>
                              ';
                              foreach ($respuestaSub as $key => $valueSub) {
                                echo '<li>'.$valueSub["nombre"].'</li>';
                              }
                          echo '
                              </ul>
                            </td>
                            <td>
                              <div class="btn-group">
                                <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fas fa-pen"></i></button>
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
  <div class="modal fade" id="agregarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: #007bff; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Categorías</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Nombre -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-spray-can"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoNombre" id="nuevoNombre" placeholder="Nombre" require>
                </div>
              </div>

             <!-- entrada de subCategoria -->
             <div class="form-group col-xs-6">
                <div class="input-group autocompletar">
                  <div class="input-group-text">
                      <span class="fas fa-th"></span>
                  </div>
                  <input type="text" title="Ingresar subcategoría" placeholder="Ingresar subcategoría" class="form-control" name="nuevosubCategoria" id="nuevosubCategoria">
                  
                  <button type="button" class="btn btn-info" title="Agregar subcategoría a tabla" id="btnAgregarsubCategoria" style="background: rgb(255 136 2); border: 0px solid ;"><i class="fas fa-plus"></i> Agregar a tabla </button>
                </div>
              </div> 

              <!-- entrada de colores -->
              <div class="form-group">
              <div class="input-group">
                <table class="table table-striped table-bordered table-hover" id="tbSubCategorias">
                  
                </table>
              </div>
            </div>




 
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary guardarCategorias">Guardar</button>
          </div>

        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off" enctype="multipart/form-data">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar categoría</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Línea -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-tshirt"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                 <input type="hidden"  name="idCategoria" id="idCategoria" required>
                </div>
              </div>





           
      
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" style="background:#3c8dbc;  border: 0px solid">Guardar</button>
          </div>
          <?php
            
            $editarCategoria = new Controladorcategorias();
            $editarCategoria -> ctrEditarCategoria();
            

          ?> 
        </form>
    </div>
  </div>
</div>
