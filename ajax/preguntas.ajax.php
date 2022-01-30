<?php

require_once "../controladores/preguntas.controlador.php";
require_once "../modelos/preguntas.modelo.php";

class AjaxPreguntas{
    public $id;
    // obtener datos de la pregunta para mostrar en model de editar
    public function ajaxObtenerPregunta(){
        $item = "id";
		$valor = $this->id;

		$respuesta = ControladorPreguntas::ctrMostrarPreguntas($item, $valor);

		echo json_encode($respuesta);
    }

}

if(isset($_POST["obtenerPregunta"])){
    $ajaxPregunta = new AjaxPreguntas();
    $ajaxPregunta->id = $_POST["idPregunta"];
    $ajaxPregunta->ajaxObtenerPregunta();

}