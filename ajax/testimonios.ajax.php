<?php

require_once "../controladores/testimonios.controlador.php";
require_once "../modelos/testimonios.modelo.php";

class AjaxTestimonios{
	/*=============================================
	EDITAR TESTIMONIO
	=============================================*/	

	public $id;

	public function ajaxEditarTestimonio(){

		$item = "id";
		$valor = $this->id;

		$respuesta = ControladorTestimonios::ctrMostrarTestimonios($item, $valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	ACTIVAR TESTIMONIO
	=============================================*/	

	public $activarTestimonio;
	public $activarId;


	public function ajaxActivarTestimonio(){

		$tabla = "testimoniosTienda";

		$item1 = "estado";
		$valor1 = $this->activarTestimonio;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModeloTestimonios::mdlActualizarTestimonio($tabla, $item1, $valor1, $item2, $valor2);

	}


}

/*=============================================
EDITAR TESTIMONIO
=============================================*/
if(isset($_POST["idTestimonio"])){

	$editar = new AjaxTestimonios();
	$editar -> id = $_POST["idTestimonio"];
	$editar -> ajaxEditarTestimonio();

}


/*=============================================
ACTIVAR TESTIMONIO
=============================================*/	

if(isset($_POST["estadoTestimonio"])){

	$activarTestimonio = new AjaxTestimonios();
	$activarTestimonio -> activarTestimonio = $_POST["estadoTestimonio"];
	$activarTestimonio -> activarId = $_POST["activarId"];
	$activarTestimonio -> ajaxActivarTestimonio();

}