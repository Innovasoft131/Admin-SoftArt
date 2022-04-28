<?php
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxCategorias
{
	public $categoria;
	public $imgName;
	public $imagenType;

	public function insertCategoria($Json)
	{

		$respuesta = Controladorcategorias::ctrInsertCategorias($Json);

		echo json_encode($respuesta);
	}
	public function deleteCategoria()
	{


		$valor = $this->categoria;

		$respuesta = Controladorcategorias::ctrDeleteCategoria($valor);

		echo json_encode($respuesta);
	}

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/

	public $idCategoria;

	public function ajaxEditarCategoria()
	{

		$item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);
	}
	public $idSubCategoria;
	public function ajaxMostrarSubCategoria()
	{
		$item = "idCategoria";
		$valor = $this->idSubCategoria;

		$respuesta = ControladorCategorias::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);
	}

	public function ajaxValidarSubCategoria()
	{
		$item = "nombre";
		$valor = $this->idSubCategoria;

		$respuesta = ControladorCategorias::ctrMostrarSubCategorias($item, $valor);

		echo json_encode($respuesta);
	}

	public function ajaxGuardarSubCategoria()
	{


		$datos = array(
			"subCategoria" => $this->idSubCategoria,
			"idCategoria" => $this->idCategoria
		);

		$respuesta = ControladorCategorias::ctrInsertSubCategoria($datos);

		echo json_encode($respuesta);
	}

	/*=============================================
	ELIMINAR SUBCATEGORÍA
	=============================================*/
	public function ajaxEliminarSubCategoria()
	{


		$valor = $this->idSubCategoria;

		$respuesta = Controladorcategorias::ctrDeleteSubCategorias($valor);

		echo json_encode($respuesta);
	}

	/*=============================================
	EDITAR SUBCATEGORÍA
	=============================================*/

	public function ajaxEditarSubCategoria()
	{

		$datos = array(
			"subCategoria" => $this->idSubCategoria,
			"idSubCategoria" => $this->idCategoria
		);

		$respuesta = ControladorCategorias::ctrEditarSubCategorias($datos);

		echo json_encode($respuesta);
	}

	/*=============================================
	VALIDAR NO REPETIR CATEGORIA
	=============================================*/
	public $validarCategoria;
	public function ajaxValidarCategoria()
	{

		$item = "nombre";
		$valor = $this->validarCategoria;

		$respuesta = ControladorCategorias::ctrMostrarCategorias($item, $valor);

		echo json_encode($respuesta);
	}
}

if (isset($_POST["guardarCategorias"])) {
	$ajaxCategorias = new AjaxCategorias();
	$Json = json_decode($_POST["categoria"], true);

	$ajaxCategorias->insertCategoria($Json);
}

if (isset($_POST["eliminarCategoria"])) {
	$ajaxCategorias = new AjaxCategorias();
	$ajaxCategorias->categoria = $_POST["idCategoria"];
	$ajaxCategorias->deleteCategoria();
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/
if (isset($_POST["idCategoria"])) {

	$categoria = new AjaxCategorias();
	$categoria->idCategoria = $_POST["idCategoria"];
	$categoria->ajaxEditarCategoria();
}

/*=============================================
MOSTRAR SUBCATEGORIAS
=============================================*/
if (isset($_POST["mostrarSubCategorias"])) {
	$categoria = new AjaxCategorias();
	$categoria->idSubCategoria = $_POST["idCategorias"];
	$categoria->ajaxMostrarSubCategoria();
}

/*=============================================
VALIDAR SUBCATEGORIAS DUPLICADA
=============================================*/
if (isset($_POST["validarDuplicados"])) {
	$categoria = new AjaxCategorias();
	$categoria->idSubCategoria = $_POST["subCategoria"];
	$categoria->ajaxValidarSubCategoria();
}

/*=============================================
GUARDAR SUBCATEGORIA
=============================================*/
if (isset($_POST["guardarSub"])) {
	$categoria = new AjaxCategorias();
	$categoria->idCategoria = $_POST["idCateg"];
	$categoria->idSubCategoria = $_POST["subCateg"];
	$categoria->ajaxGuardarSubCategoria();
}

/*=============================================
Eliminar SUBCATEGORIA
=============================================*/
if (isset($_POST["eliminarSubC"])) {
	$categoria = new AjaxCategorias();
	$categoria->idSubCategoria = $_POST["idSubCat"];
	$categoria->ajaxEliminarSubCategoria();
}


/*=============================================
Editar SUBCATEGORIA
=============================================*/
if (isset($_POST["editarSub"])) {
	$categoria = new AjaxCategorias();
	$categoria->idCategoria = $_POST["idSub"];
	$categoria->idSubCategoria = $_POST["Sub"];
	$categoria->ajaxEditarSubCategoria();
}


/*=============================================
VALIDAR NO REPETIR CATEGORIA
=============================================*/
if (isset($_POST["validarCategoria"])) {
	$valCategoria = new AjaxCategorias();
	$valCategoria->validarCategoria = $_POST["validarCategoria"];
	$valCategoria->ajaxValidarCategoria();
}
