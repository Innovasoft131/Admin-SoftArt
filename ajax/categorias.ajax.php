<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias{
    public $categoria;
	public $imgName;
    public $imagenType;

    public function insertCategoria(){


		$categoria = $this->categoria;

		$imgName = $this -> imgName;

        $imagenType = $this -> imagenType;

		$datos = array(
			"categoria" => $categoria,
			"imgName" => $imgName,
            "imagenType" => $imagenType
		);

		$respuesta = Controladorcategorias::ctrInsertCategorias($datos);

		echo json_encode($respuesta);

	}
    public function deleteCategoria(){


		$valor = $this->categoria;
		$foto = $this -> imgName;

		$respuesta = Controladorcategorias::ctrDeleteCategoria($valor, $foto);
	
		echo json_encode($respuesta);

	}

    	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxEditarCategoria(){

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);

	}

}

if(isset($_POST["guardarCategorias"])){
    $ajaxCategorias = new AjaxCategorias();
    $ajaxCategorias -> categoria = $_POST["categoria"];
	if(isset($_FILES["img"])){
        $ajaxCategorias -> imgName = $_FILES["img"]['tmp_name'];

        $ajaxCategorias -> imagenType	= $_FILES['img']['type'];
    }else{
        $ajaxCategorias -> imgName = "";

        $ajaxCategorias -> imagenType	= "";
    }
    $ajaxCategorias -> insertCategoria();
}

if(isset($_POST["eliminarCategoria"])){
    $ajaxCategorias = new AjaxCategorias();
    $ajaxCategorias -> categoria = $_POST["idCategoria"];
	$ajaxCategorias -> imgName = $_POST["foto"];
    $ajaxCategorias -> deleteCategoria();
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategorias();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditarCategoria();
}
