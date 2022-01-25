  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
          
        <button class="btn btn-primary" data-toggle="modal" data-target="#agregarClientes"> <i class="fas fa-plus"></i> Agregar Clientes </button>

        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Usuario</th>
                  <th>Correo</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php

$item = null;
$valor = null;

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

foreach ($clientes as $key => $value){
 
  echo ' <tr>
          <td>'.$key.'</td>
          <td>'.$value["usuario"].'</td>';



          echo '<td>'.$value["correo"].'</td>
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnEditarClientes" idCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCliente"><i class="fas fa-pen"></i></button>

              <button class="btn btn-danger btnEliminarClientes" idCliente="'.$value["id"].'"  cliente="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

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
<div class="modal fade" id="agregarClientes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="modal-header" style="background: #007bff; color: white;">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Clientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">
            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="nuevoUsuario" id="nuevoCliente" placeholder="Usuario*" require>
                </div>
              </div>
            <!-- Entrada de Contraseña -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <input type="password" class="form-control" autocomplete="off" name="nuevoPassword" placeholder="Contraseña*" require>
                </div>
              </div>

            <!-- Entrada de Correo -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-at"></span>
                    </div>
                  </div>
                  <input type="email" class="form-control" name="nuevoCorreo" placeholder="Correo*" require>
                </div>
            </div>




           
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php
            
            $crearCliente = new ControladorClientes();
            $crearCliente -> ctrCrearClientes();
            

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
            <h5 class="modal-title" id="exampleModalLabel">Editar Clientes</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="card-body">

            <!-- Entrada de Usuario -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-key"></span>
                    </div>
                  </div>
                  <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" placeholder="Usuario*" readonly>
                </div>
              </div>
            <!-- Entrada de Contraseña -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  <input type="password" class="form-control" autocomplete="off" name="editarPasswordCliente" id="editarPasswordCliente" placeholder="Contraseña*" require>
                  <input type="hidden" id="passwordActualCliente" name="passwordActualCliente">
                </div>
              </div>


            <!-- Entrada de Correo -->
            <div class="form-group">
                <div class="input-group">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-at"></span>
                    </div>
                  </div>
                  <input type="email" class="form-control" name="editarCorreo" id="editarCorreo" placeholder="Correo*" require>
                </div>
            </div>





              
            </div>

            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          <?php
        
          $editarCliente = new ControladorClientes();
          $editarCliente -> ctrEditarCliente();

        ?> 

        </form>
    </div>
  </div>
</div>

<?php

  $borrarCliente = new ControladorClientes();
  $borrarCliente -> ctrBorrarCliente();
  

?> 