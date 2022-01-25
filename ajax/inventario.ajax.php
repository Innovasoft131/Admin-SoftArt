<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";

class AjaxInventario{
    public $id;
    public $talla;
    // obtener datos del producto para mostrar en model de editar
    public function ajaxObtenerProducto(){
        $item = "id";
		$valor = $this->id;

		$respuesta = ControladorInventarios::ctrMostrarInventario($item, $valor);

		echo json_encode($respuesta);
    }


    // obtener datos de tallas para mostrar en model de editar
    public function ajaxObtenerTallas(){
        $item = "idProducto";
		$valor = $this->id;

		$respuesta = ControladorInventarios::ctrMostrarTallas($item, $valor);

		echo json_encode($respuesta);
    }

    // Eliminar talla al momento de editar
    public function ajaxEliminarTalla(){
        $item = "id";
		$valor = $this->id;

		$respuesta = ControladorInventarios::ctrEliminarTalla($item, $valor);

		echo json_encode($respuesta);
    }

    // Insertar talla al momento de editar
    public function ajaxInsertTalla(){
        $datos = array(
            "idProducto" => $this->id,
            "talla" => $this->talla
        );


		$respuesta = ControladorInventarios::ctrInsertTalla($datos);

		echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR PRODUCTO
	=============================================*/	

	public $validarProducto;

	public function ajaxValidarProducto(){

		$item = "nombre";
		$valor = $this->validarProducto;

		$respuesta = ControladorInventarios::ctrMostrarInventario($item, $valor);

		echo json_encode($respuesta);

	}

    /*=============================================
	VALIDAR NO REPETIR TALLA
	=============================================*/	


	public function ajaxValidarTalla(){

		$item = "talla";
		$valor = $this->talla;
        $valorP = $this->id;

		$respuesta = ControladorInventarios::ctrValidar($item, $valor, $valorP);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["buscarProducto"])){
    $ajaxInventario = new AjaxInventario();
    $ajaxInventario->id = $_POST["idProducto"];
    $ajaxInventario->ajaxObtenerProducto();
}

if(isset($_POST["buscarTallas"])){
    $ajaxInventario = new AjaxInventario();
    $ajaxInventario->id = $_POST["idProducto"];
    $ajaxInventario->ajaxObtenerTallas();
}

if(isset($_POST["eliminarTalla"])){
    $ajaxInventario = new AjaxInventario();
    $ajaxInventario->id = $_POST["idTalla"];
    $ajaxInventario->ajaxEliminarTalla();
}

if(isset($_POST["insertarTalla"])){
    $ajaxInventario = new AjaxInventario();
    $ajaxInventario->id = $_POST["idProducto"];
    $ajaxInventario->talla = $_POST["talla"];
    $ajaxInventario->ajaxInsertTalla();
}


/*=============================================
VALIDAR NO REPETIR PRODUCTO
=============================================*/

if(isset( $_POST["validarProducto"])){

	$ajaxInventario = new AjaxInventario();
	$ajaxInventario -> validarProducto = $_POST["validarProducto"];
	$ajaxInventario -> ajaxValidarProducto();

}

/*=============================================
VALIDAR NO REPETIR TALLA
=============================================*/

if(isset( $_POST["validarTalla"])){

	$ajaxInventario = new AjaxInventario();
	$ajaxInventario -> talla = $_POST["validarTalla"];
    $ajaxInventario -> id = $_POST["idProducto"];
	$ajaxInventario -> ajaxValidarTalla();

}