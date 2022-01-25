  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cotizaciones</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Cotizaciones</li>
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
          
          <button class="btn btn-primary" data-toggle="modal" data-target="#agregarCotizacion"> <i class="fas fa-plus"></i> Agregar Cotización </button>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                $item = null;
                $valor = null;

                $respuesta = Controladorcategorias::ctrMostrarCategorias($item, $valor);

                foreach ($respuesta as $key => $value) {
                    echo '<tr>
                            <td>'.$key.'</td>
                            <td>'.$value["nombre"].'</td>
                            <td><button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'" ><i class="fa fa-trash"></i></button></td>
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
<div class="modal fade" id="agregarCotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" autocomplete="off">
          <div class="modal-header" style="background: #007bff; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Cotización</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Mínimo -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-money-check-alt"></span>
                    </div>
                  </div>
                  <input type="number" class="form-control" name="nuevoMinimo" id="nuevoMinimo" placeholder="Mínimo*" require>
                </div>
              </div>

            <!-- Entrada de Máximo -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-coins"></span>
                        </div>
                  </div>
                  <input type="number" class="form-control" name="nuevoMaximo" id="nuevoMaximo" placeholder="Máximo*" require>
                </div>
            </div>

            <!-- Entrada de Precio -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-dollar-sign"></span>
                        </div>
                  </div>
                  <input type="number" class="form-control" name="nuevoPrecio" id="nuevoPrecio" placeholder="Precio*" require>
                </div>
            </div>

            <!-- Entrada de Estado -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-pallet"></span>
                        </div>
                  </div>
                 <select class="form-control" name="slNuevoEstado" id="slNuevoEstado">
                    <option value="Personalizado">Personalizado</option>
                    <option value="Inventario">Inventario</option>
                 </select>
                </div>
            </div>


 
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary guardarCategorias">Guardar</button>
          </div>

          <?php
        
          $editarCotizacion = new ControladorCotizaciones();
          $editarCotizacion -> ctrInsertCotizacion();

          ?> 

        </form>
    </div>
  </div>
</div>
