  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Información del Pedido</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item"><a href="pedidos">Pedidos</a></li>
              <li class="breadcrumb-item active">Información</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Desglose</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <?php
                $item = "id";
                $valor = $_GET["pedido"];
                $mostrarPedido = ControladorPedidos::ctrMostrarPedido($item, $valor);


                $valorPedido = $_GET["pedido"];
                $mostrarPedidoCliente = ControladorPedidos::ctrMostrarClientePedido($valorPedido);

               

            ?>
            <form action="" method="post">
                <div class="row">
                  <div class="form-group">
                    <!-- Mostrar Num. Pedido -->
                    <div class="input-group">
                        <strong>Num. Pedido:</strong> &nbsp;
                        <p><?php echo $mostrarPedido["id"]; ?></p>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <!-- Mostrar info de potencial cliente -->
                    <div class="input-group">
                      
                        <strong>Cliente:</strong> &nbsp;
                        <p class="col-sm-3"><?php echo $mostrarPedidoCliente["nombre"]; ?></p> &nbsp;&nbsp;&nbsp;&nbsp;
               
                      
                        <strong>Correo:</strong> &nbsp;
                        <p class="col-sm-3"><?php echo $mostrarPedidoCliente["correo"]; ?></p> &nbsp;&nbsp;&nbsp;&nbsp;
                      
                      
                        
                
                        
                      </div>
                </div>
                <div class="row">
                  <div class="table-responsive">
                    <table class="table  table-bordered table-striped   tablas " >
                      <thead>
                        <tr>
                          <th style="width:10px">#</th>
                          <th>SubCategoria</th>
                          <th>Producto</th>
                          <th>Precio</th>
                          <th>Cantidad</th>
                          <th>Foto</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $pedidos = ControladorPedidos::ctrMostrarPedidoId($valorPedido);
                        
                        foreach ($pedidos as $key => $value){
                          $item = 'id';
                          $valor = $value["id"];

                          echo ' <tr>
                                  <td>'.$key.'</td>
                                  <td>'.$value["subCategoria"].'</td>
                                  <td>'.$value["producto"].'</td>
                                  <td>'.$value["precio"].'</td>';
                                  
                          echo   '<td>'.$value["cantidad"].'</td>
                                  <td><img src="'.$value["foto"].'" class="img-thumbnail" width="50px"></td>
                                </tr>';
                        }


                      ?> 
                      </tbody>
                    </table>
                    
                  </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Total del pedido</label>
                        <p>$<?php echo $mostrarPedido["total"]; ?>.00</p>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label>Estado</label>
                        <input type="hidden" name="pedido" id="pedido" value="<?php echo $_GET["pedido"]; ?>">
                        <select class="form-control" name="slEstado" id="slEstado">
                          <option value="<?php echo $mostrarPedido["estado"]; ?>"><?php echo $mostrarPedido["estado"]; ?></option>
                          <option value="pendiente">pendiente</option>
                          <option value="visto">visto</option>
                          <option value="entregar">entregar</option>
                        </select>
                      </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-info">Guardar</button>

                <?php
                  $editar = new ControladorPedidos();
                  $editar -> ctrEditarPedido();
                ?>
            </form>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>