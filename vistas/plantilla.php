<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FerxoStyle</title>
  <!-- PLUGINS DE CSS -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.css">
  <link rel="icon" href="vistas/img/plantilla/invo.ico">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/plugins/datatables/datatables.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables/DataTables-1.10.23/css/dataTables.bootstrap4.css">
  

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.css">

  <!-- PLUGINS DE JAVASCRIPT -->
   <!-- jQuery -->
   <script src="vistas/plugins/jquery/jquery.min.js"></script>
   <!-- Bootstrap 4 -->
   <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.js"></script>

   
   <!-- AdminLTE App -->
   <script src="vistas/dist/js/adminlte.js"></script>
   <!-- AdminLTE for demo purposes --> 
   <script src="vistas/dist/js/demo.js"></script>

   <!-- DataTables  & Plugins -->
   <script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
   <script src="vistas/plugins/datatables/DataTables-1.10.23/js/dataTables.bootstrap4.js"></script>

   <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
   <script src="vistas/plugins/bootstrap-switch/js/bootstrap-switch.js"></script>
</head>

<!-- Site wrapper -->

    <?php

        if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
            echo '<body class="hold-transition sidebar-collapse layout-fixed sidebar-mini">';
            echo '<div class="wrapper">';
            // menu secundario
            include "modulos/cabezote.php";
            // menu principal
            include "modulos/menu.php";

            // redireccionamiento a cada modulo
            if(isset($_GET["ruta"])){
                if($_GET["ruta"]=="usuarios" || 
                $_GET["ruta"]=="inicio" ||
                $_GET["ruta"]=="categorias" ||
                $_GET["ruta"]=="clientes" ||
                $_GET["ruta"]=="productos" ||
                $_GET["ruta"]=="preguntas" ||
                $_GET["ruta"]=="configRedes" ||
                $_GET["ruta"]=="configInicio" ||
                $_GET["ruta"]=="pedidos" ||
                $_GET["ruta"]=="viewPedido" ||
                $_GET["ruta"]=="testimonios" ||
                $_GET["ruta"]=="salir"){
                    include "modulos/".$_GET["ruta"].".php";
                }else{
                    include "modulos/404.php";
                }
            }else{
                include "modulos/inicio.php";
            }
            
            // pie de pagina
            include "modulos/footer.php";
            echo '</div>';
            
            echo '<script src="vistas/js/plantilla.js"></script>';
            echo '<script src="vistas/js/usuarios.js"></script>';
            echo '<script src="vistas/js/categorias.js"></script>';
            echo '<script src="vistas/js/clientes.js"></script>';
            echo '<script src="vistas/js/inventario.js"></script>';
            echo '<script src="vistas/js/configuracion.js"></script>';
            echo '<script src="vistas/js/pedidos.js"></script>';
            echo '<script src="vistas/js/productos.js"></script>';
            echo '<script src="vistas/js/preguntas.js"></script>';
            echo '<script src="vistas/js/testimonios.js"></script>';
            
            echo '</body>';
        }else{
            echo '<body class="hold-transition  layout-fixed  login-page">';
           
            // login
            include "modulos/login.php";
            echo '</body>';
        }
    
    ?>

<!-- ./wrapper -->



</html>
