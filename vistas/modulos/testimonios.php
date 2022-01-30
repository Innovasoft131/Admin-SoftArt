  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Testimonios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Testimonios</li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarTestimonio"> <i class="fas fa-plus"></i> Agregar testimonios </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Cliente</th>
                  <th>Calificación</th>
                  <th>Foto</th>
                  <th>Testimonio</th>
                  <th>Estado</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

$item = null;
$valor = null;

$testimonios = ControladorTestimonios::ctrMostrarTestimonios($item, $valor);

foreach ($testimonios as $key => $value){
 
  echo ' <tr>
          <td>'.$key.'</td>
          <td>'.$value["nombreCliente"].'</td>
          <td>'.$value["calificacion"].'</td>';

          if($value["foto"] != ""){

            echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="40px"></td>';

          }else{

            echo '<td><img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail" width="40px"></td>';

          }

          echo '<td>'.$value["testimonio"].'</td>';

          if($value["estado"] != 0){

            echo '<td><button class="btn btn-success btn-xs btnActivarTestimonio" idTestimonio="'.$value["id"].'" estadoTestimonio="0">Activado</button></td>';

          }else{

            echo '<td><button class="btn btn-danger btn-xs btnActivarTestimonio" idTestimonio="'.$value["id"].'" estadoTestimonio="1">Desactivado</button></td>';

          }             

          echo '
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnEditarTestimonio" idTestimonio="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarTestimonio"><i class="fas fa-pen"></i></button>

              <button class="btn btn-danger btnEliminarTestimonio" idTestimonio="'.$value["id"].'" fotoCliente="'.$value["foto"].'" cliente="'.$value["nombreCliente"].'"><i class="fa fa-times"></i></button>

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
<div class="modal fade" id="agregarTestimonio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background: #007bff; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Testimonio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Nombre del cliente -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoNombreCliente" placeholder="Nombre del cliente" require>
                </div>
              </div>
            <!-- Entrada de Calificación -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-star"></span>
                    </div>
                  </div>
                  <input type="number" min="0" max="5" class="form-control" name="nuevoCalificacion" id="nuevoCalificacion" placeholder="calificación" require>
                </div>
              </div>
            <!-- Entrada de Testimonio -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-comments"></span>
                    </div>
                  </div>
                  <textarea class="form-control" name="nuevoTestimonio" id="nuevoTestimonio" cols="30" rows="5" placeholder="Testimonio" require></textarea>
                </div>
              </div>



              <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="nuevaFoto" id="nuevaFoto" class="foto">
                <p class="help-block">Peso máximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
              </div>
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php

            $crearTestimonio = new ControladorTestimonios();
            $crearTestimonio -> ctrCrearTestimonio();

          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarTestimonio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Testimonio</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Nombre del cliente -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-user"></span>
                    </div>
                  </div>

                  <input type="text" class="form-control" name="editarNombreCliente" id="editarNombreCliente" placeholder="Nombre del cliente" require>
                  <input type="hidden" class="form-control" name="idTestimonio" id="idTestimonio" placeholder="Nombre del cliente" require>
                </div>
              </div>
            <!-- Entrada de calificación -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-star"></span>
                    </div>
                  </div>
                  <input type="number" min="0" max="5" class="form-control" name="editarCalificacion" id="editarCalificacion" placeholder="calificación" require>
                </div>
              </div>
            <!-- Entrada de Contraseña -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-comments"></span>
                    </div>
                  </div>
                  <textarea class="form-control" name="editarTestimonio" id="editarTestimonio" cols="30" rows="5" placeholder="Testimonio" require></textarea>
                </div>
              </div>



            <!-- subir foto -->
              <div class="form-group">
                <div class="panel">Subir Foto</div>
                <input type="file" name="editarFoto" id="editarFoto" class="foto">
                <p class="help-block">Peso máximo de la foto 200 MB</p>
                <img src="vistas/img/usuarios/default/1.jpg" class="img-thumbnail previsualizar" width="100px">
                <input type="hidden" name="fotoActual" id="fotoActual">
              </div>
              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php

          $editarTestimonio = new ControladorTestimonios();
          $editarTestimonio -> ctrEditarTestimonio();

        ?> 

        </form>
    </div>
  </div>
</div>

<?php

  $borrarTestimonio = new ControladorTestimonios();
  $borrarTestimonio -> ctrBorrarTestimonio();

?> 