  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Preguntas frecuentes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Preguntas frecuentes</li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarPregunta"> <i class="fas fa-plus"></i> Agregar pregunta </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Pregunta</th>
                  <th>Respuesta</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

$item = null;
$valor = null;

$pregunta = ControladorPreguntas::ctrMostrarPreguntas($item, $valor);

foreach ($pregunta as $key => $value){
 
  echo ' <tr>
          <td>'.$key.'</td>
          <td>'.$value["pregunta"].'</td>';



          echo '<td>'.$value["respuesta"].'</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnEditarPregunta" idPregunta="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPregunta"><i class="fas fa-pen"></i></button>

              <button class="btn btn-danger btnEliminarPregunta" idPregunta="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
<div class="modal fade" id="agregarPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background: #007bff; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar pregunta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de pregunta -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-question"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevaPregunta" id="nuevaPregunta" placeholder="pregunta" require>
                </div>
              </div>
            <!-- Entrada de respuesta -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-i-cursor"></span>
                    </div>
                  </div>
                    <textarea class="form-control" name="nuevaRespuesta" id="nuevaRespuesta" cols="30" rows="5" placeholder="Respuesta" require></textarea>
                
                </div>
              </div>






           
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php
            
            $crearPregunta = new ControladorPreguntas();
            $crearPregunta -> ctrCrearPreguntas();
            

          ?>
        </form>
    </div>
  </div>
</div>

  <!-- Modal Edicion -->
  <div class="modal fade" id="modalEditarPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <h5 class="modal-title" id="exampleModalLabel">Editar Pregunta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">

            <!-- Entrada de pregunta -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-question"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarPregunta" id="editarPregunta" placeholder="pregunta" require>
                  <input type="hidden" class="form-control" name="editarId" id="editarId" placeholder="editarId" require>
                </div>
              </div>
            <!-- Entrada de respuesta -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-i-cursor"></span>
                    </div>
                  </div>
                  <textarea class="form-control" name="editarRespuesta" id="editarRespuesta" cols="30" rows="5" placeholder="Respuesta" require></textarea>
                  
                </div>
              </div>








              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php
        
          $editarPregunta = new ControladorPreguntas();
          $editarPregunta -> ctrEditarPregunta();

        ?> 

        </form>
    </div>
  </div>
</div>

<?php

  $borrarCliente = new ControladorPreguntas();
  $borrarCliente -> ctrBorrarPregunta();
  

?> 