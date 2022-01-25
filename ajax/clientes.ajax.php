<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{
    public $id;
    // obtener datos del cliente para mostrar en model de editar
    public function ajaxObtenerCliente(){
        $item = "id";
		$valor = $this->id;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);
    }


    /*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/	

	public $validarCliente;

	public function ajaxValidarCliente(){

		$item = "usuario";
		$valor = $this->validarCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["obtenerCliente"])){
    $ajaxClientes = new AjaxClientes();
    $ajaxClientes->id = $_POST["idCliente"];
    $ajaxClientes->ajaxObtenerCliente();

}


/*=============================================
VALIDAR NO REPETIR CLIENTE
=============================================*/

if(isset( $_POST["validarCliente"])){

	$ajaxClientes = new AjaxClientes();
	$ajaxClientes -> validarCliente = $_POST["validarCliente"];
	$ajaxClientes -> ajaxValidarCliente();

}