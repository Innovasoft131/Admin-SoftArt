<div class="table-responsive">
              <table class="table  table-bordered table-striped   tablas " >
                <thead>
                  <tr>
                  <th style="width:10px">#</th>
                  <th>Nombre</th>
                  <th>Correo sistema</th>
                  <th>Correo paypal</th>
                  <th>Fecha del pedido</th>
                  <th>Total Compra</th>
                  <th>Estado sistema</th>
                  <th>Estado compra</th>
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
          <td>'.$value["correo"].'</td>
          <td>'.$value["correoPaypal"].'</td>
          <td>'.$value["fechaPedido"].'</td>
          <td>$'.$value["total"].'.00</td>
          <td style="color: #228CB4;">'.$value["estado"].'</td>';
          if($value["estadoCompra"] == "COMPLETED"){
           echo '<td><span class="btn btn-success btn-xs">'.$value["estadoCompra"].'</span></td>';
          }else{
            echo '<td><span class="btn btn-danger btn-xs">'.$value["estadoCompra"].'</span></td>';
          }
          

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