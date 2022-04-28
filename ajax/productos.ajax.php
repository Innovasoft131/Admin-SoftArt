<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class AjaxProductos{


  public $idCategoria;




  /*=============================================
  EDITAR PRODUCTO
  =============================================*/ 

  public $idProducto;
  public $traerProductos;
  public $nombreProducto;

  public function ajaxEditarProducto(){

    if($this->traerProductos == "ok"){

      $item = null;
      $valor = null;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);


    }else if($this->nombreProducto != ""){

      $item = "descripcion";
      $valor = $this->nombreProducto;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);

    }else{

      $item = "id";
      $valor = $this->idProducto;

      $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

      echo json_encode($respuesta);

    }

  }
  public $idSubCategoria;
  public $descripcion;
  public $imgName;
  public $imagenType;
  public $precio;
  public $oferta;
  public function ajaxInsertProducto(){

    $datos = array(
      "idCategoria" => $this -> idCategoria,
      "idSubCategoria" => $this -> idSubCategoria,
      "nombre" => $this -> nombreProducto,
      "descripcion" => $this -> descripcion,
      "imgName" => $this -> imgName,
      "imagenType" =>  $this -> imagenType,
      "precio" => $this -> precio,
      "oferta" => $this->oferta,
    );

    $respuesta = ControladorProductos::ctrCrearProducto($datos);

    echo json_encode($respuesta);

  }
  /*=============================================
    MOSTRAR CATEGORIAS EN EDICION
  =============================================*/ 
  public function ajaxMostrarCategorias(){
    $item = "id";
    $valor = $this -> idCategoria;

    $respuesta = Controladorcategorias::ctrMostrarCategoriasEditar($item, $valor);

    echo json_encode($respuesta);
  }

    /*=============================================
    MOSTRAR SUBCATEGORIAS EN EDICION
  =============================================*/ 
  public function ajaxMostrarSubCategorias(){
    $item = "id";
    $valor = $this -> idCategoria;

    $respuesta = Controladorcategorias::ctrMostrarSubCategoriasEditar($item, $valor);

    echo json_encode($respuesta);
  }

  /*=============================================
    MOSTRAR DETALLE DE PRODUCTOS
  =============================================*/ 
  public function ajaxMostrarDetalleProductos(){
    $item = "idProducto";
    $valor = $this -> idProducto;

    $respuesta = ControladorProductos::ctrMostrarDetalleProductos($item, $valor);

    echo json_encode($respuesta);
  }

  /*=============================================
    EDITAR DETALLE DE PRODUCTOS
  =============================================*/ 
  public $id;
  public $tamanio;
  public $medidas;
  public $material;
  public $cantidad; 
  public $precio_venta;
  public $color;
  public function ajaxEditarDetalleProductos(){
    $datos = array(
      "id" => $this -> id,
      "idProducto" => $this -> idProducto,
      "tamanio" => $this -> tamanio,
      "medidas" => $this -> medidas,
      "material" => $this -> material,
      "cantidad" => $this -> cantidad ,
      "precio_venta" => $this -> precio_venta,
      "color" => $this -> color
    );
    $respuesta = ControladorProductos::ctrEditarEdetalleProducto($datos);
    echo json_encode($respuesta);
  }

  /*=============================================
    GUARDAR DETALLE DE PRODUCTOS
  =============================================*/ 
  public function ajaxInsertDetalleProductos(){
    $datos = array(
      "idProducto" => $this -> idProducto,
      "tamanio" => $this -> tamanio,
      "medidas" => $this -> medidas,
      "material" => $this -> material,
      "cantidad" => $this -> cantidad ,
      "precio_venta" => $this -> precio_venta,
      "color" => $this -> color
    );
    $respuesta = ControladorProductos::ctrGuardardetalleProducto($datos);
    echo json_encode($respuesta);
  }

  public function ajaxEliminarDetalleProductos(){
    
    $valor = $this -> id;
    $respuesta = ControladorProductos::ctrEliminarDetalleProducto($valor);
    echo json_encode($respuesta);

  }

  
  /*=============================================
	VALIDAR NO REPETIR PRODUCTO
	=============================================*/	
  public $validarProducto;
	public function ajaxValidarProducto(){

		$item = "nombre";
		$valor = $this->validarProducto;

		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

		echo json_encode($respuesta);

	}

}



/*=============================================
EDITAR PRODUCTO
=============================================*/ 

if(isset($_POST["idProducto"])){

  $editarProducto = new AjaxProductos();
  $editarProducto -> idProducto = $_POST["idProducto"];
  $editarProducto -> ajaxEditarProducto();

}

/*=============================================
TRAER PRODUCTO
=============================================*/ 

if(isset($_POST["traerProductos"])){

  $traerProductos = new AjaxProductos();
  $traerProductos -> traerProductos = $_POST["traerProductos"];
  $traerProductos -> ajaxEditarProducto();

}




/*=============================================
GUARDAR PRODUCTO
=============================================*/ 
if(isset($_POST["guardarProducto"])){
  $insertarProductos = new AjaxProductos();
  $insertarProductos -> nombreProducto = $_POST["nombreProducto"];
  $insertarProductos -> idCategoria = $_POST["idCategoria"];
  $insertarProductos -> idSubCategoria = $_POST["idSubCategoria"];
  $insertarProductos -> descripcion = $_POST["descripcion"];
  $insertarProductos -> precio = $_POST["precio"];
  $insertarProductos -> oferta = $_POST["oferta"];
  if(isset($_FILES["img"])){
    $insertarProductos -> imgName = $_FILES["img"]['tmp_name'];

    $insertarProductos -> imagenType	= $_FILES['img']['type'];
  }else{
    $insertarProductos -> imgName = "";

    $insertarProductos -> imagenType	= "";
  }

  $insertarProductos -> ajaxInsertProducto();

}
/*=============================================
MOSTRAR CATEGORIAS EN EDICION
=============================================*/ 
if (isset($_POST["MostrarCategoriasEditar"])) {
  $mostrarCategorias = new AjaxProductos();
  $mostrarCategorias -> idCategoria = $_POST["idCategoria"];
  $mostrarCategorias -> ajaxMostrarCategorias();
}

/*=============================================
MOSTRAR SUBCATEGORIAS EN EDICION
=============================================*/ 
if (isset($_POST["MostrarSubCategoriasEditar"])) {
  $mostrarCategorias = new AjaxProductos();
  $mostrarCategorias -> idCategoria = $_POST["idSubCategoria"];
  $mostrarCategorias -> ajaxMostrarSubCategorias();
}

/*=============================================
MOSTRAR DETALLE DEL PRODUCTO EN EDICION
=============================================*/ 
if(isset($_POST["mostrarDetalleProducto"])){
  $mostrarCategorias = new AjaxProductos();
  $mostrarCategorias -> idProducto = $_POST["idProductos"];
  $mostrarCategorias -> ajaxMostrarDetalleProductos();
}

/*=============================================
EDITAR DETALLE DEL PRODUCTO
=============================================*/ 
if(isset($_POST["editarDetalles"])){
  $editarDetalleProducto = new AjaxProductos();
  $editarDetalleProducto -> id = $_POST['id'];
  $editarDetalleProducto -> idProducto = $_POST['idProductoDetalle'];
  $editarDetalleProducto -> tamanio = $_POST['tamanio'];
  $editarDetalleProducto -> medidas = $_POST['medidas'];
  $editarDetalleProducto -> material = $_POST['material'];
  $editarDetalleProducto -> cantidad = $_POST['cantidad'];
  $editarDetalleProducto -> precio_venta = $_POST['precio_venta'];
  $editarDetalleProducto -> color = $_POST['color'];
  $editarDetalleProducto -> ajaxEditarDetalleProductos();
}


/*=============================================
GUARDAR DETALLE DEL PRODUCTO
=============================================*/ 
if(isset($_POST["guardarDetalles"])){
  $insertDetalleProducto = new AjaxProductos();
  $insertDetalleProducto -> idProducto = $_POST['idProductoInsert'];
  $insertDetalleProducto -> tamanio = $_POST['tamanio'];
  $insertDetalleProducto -> medidas = $_POST['medidas'];
  $insertDetalleProducto -> material = $_POST['material'];
  $insertDetalleProducto -> cantidad = $_POST['cantidad'];
  $insertDetalleProducto -> precio_venta = $_POST['precio_venta'];
  $insertDetalleProducto -> color = $_POST['color'];
  

  $insertDetalleProducto -> ajaxInsertDetalleProductos();
}

/*=============================================
Eliminar DETALLE DEL PRODUCTO
=============================================*/ 
if(isset($_POST["eliminarDetalleProductos"])){
  $eliminarDetalleProducto = new AjaxProductos();
  $eliminarDetalleProducto -> id = $_POST['idEliminar'];
  $eliminarDetalleProducto -> ajaxEliminarDetalleProductos();
}
/*=============================================
VALIDAR NO REPETIR PRODUCTO
=============================================*/
if(isset($_POST["validarProducto"])){
  $valProducto = new AjaxProductos();
	$valProducto -> validarProducto = $_POST["validarProducto"];
	$valProducto -> ajaxValidarProducto();
}




