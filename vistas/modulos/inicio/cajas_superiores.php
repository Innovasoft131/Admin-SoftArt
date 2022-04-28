<?php

    $pedidos = ControladorPedidos::ctrSumaPedidos();
    $totalPedidos = $pedidos[0]["totalPedidos"];
    $item = null; 
    $valor = null;
    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    $totalEmpleados = count($usuarios);



    $clientes = ControladorClientes::ctrMostrarclientes($item, $valor);
    $totalClientes = count($clientes);

    $piezas = ControladorProductos::ctrMostrarProductos($item, $valor);
    $totalPiezas = count($piezas);
?>

<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
        <div class="inner">
            <h3><?php echo number_format($totalPiezas); ?></h3>

            <p>Cantidad de Productos</p>
        </div>
        <div class="icon">
            <i class="fas fa-tshirt"></i>
        </div>
        <a href="productos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
        <div class="inner">
            <h3><?php echo number_format($totalPedidos); ?></h3>
            <p>Pedidos Pendientes</p>
        </div>
        <div class="icon">
            <i class="fas fa-cart-arrow-down"></i>
        </div>
        <a href="pedidos" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>
<!-- ./col -->
 <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-secondary">
        <div class="inner">
            <h3><?php echo number_format($totalClientes); ?></h3>

            <p>Clientes Registrados</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="clientes" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- ./col -->
<!-- ./col -->
<div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
        <div class="inner">
            <h3><?php echo number_format($totalEmpleados); ?></h3>

            <p>Clientes Empleados</p>
        </div>
        <div class="icon">
            <i class="fas fa-users"></i>
        </div>
        <a href="clientes" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- ./col -->