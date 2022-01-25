<?php
$hoy = date("Y-m-d"); 
$pedidosTerminados = ControladorPedidos::ctrPedidosTerminados($hoy);

?>

<div class="table-responsive">
    <table class="table  table-bordered table-striped   tablas " >
        <thead>
            <tr>
                <th style="width:10px">#</th>
                <th>No. Pedido</th>
                <th>Cliente</th>
                <th>Fecha del pedido</th>
                <th>Fecha de termino</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($pedidosTerminados as $key => $value) {
            echo '<tr>
                    <td>'.$key.'</td>
                    <td>'.$value["idPedido"].'</td>
                    <td>'.$value["cliente"].'</td>
                    <td>'.$value["fechainicio"].'</td>
                    <td>'.$value["fechaFin"].'</td>
                    <td><button class="btn btn-dark btnMostrarPedidoInicio" fechaTermino="'.$value["fechaFin"].'" fechaPedido="'.$value["fechainicio"].'" idCliente="'.$value["idCliente"].'" cliente="'.$value["cliente"].'" idPedido="'.$value["idPedido"].'"  style="background: rgb(255 136 2); border: 0px solid ;" data-toggle="modal" data-target="#mostrarPedidopdfpInicio"><i class="fas fa-eye"></i></button></td>
                </tr>';
        }
        ?>
             
        </tbody>
    </table>
</div>

<!-- Modal Mostrar Pedidos -->
<div class="modal fade" id="mostrarPedidopdfpInicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLongTitle"></h5>
        <button type="button" class="close cerrarPdfPedidoInicio" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                
        <object class="PDFdoc" id="mostrarPedidopdfInicio" name="mostrarPedidopdfInicio"  width="100%" height="500px" type="application/pdf" data="#"></object>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary cerrarPdfPedidoInicio" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>