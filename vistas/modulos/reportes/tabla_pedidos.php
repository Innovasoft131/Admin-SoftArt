<div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Usuario</th>
                  <th>Fecha del pedido</th>
                  <th>Estado</th>
                  <th>Acciones</th>

                  </tr>
                </thead>
                <tbody>
                <?php


$pedidos = ControladorPedidos::ctrMostrarPedidos();

foreach ($pedidos as $key => $value){
 
  echo ' <tr>
          <td>'.$key.'</td>
          <td>'.$value["nombre"].'</td>
          <td>'.$value["usuario"].'</td>
          <td>'.$value["fechaPedido"].'</td>
          <td>'.$value["estado"].'</td>';

          echo '
          <td>

            <div class="btn-group">
                
              <button class="btn btn-warning btnViewPedido" pedido="'.$value["id"].'"><i class="fas fa-eye"></i></button>


            </div>  

          </td>

        </tr>';
}


?> 
                </tbody>
              </table>
            </div>