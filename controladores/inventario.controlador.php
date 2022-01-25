<?php

class ControladorInventarios
{
    /*=============================================
	MOSTRAR INVENTARIO
	=============================================*/

	static public function ctrMostrarInventario($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloInventario::MdlMostrarInventarioEditar($tabla, $item, $valor);
	
		return $respuesta;
	}
    /*=============================================
	MOSTRAR TALLAS
	=============================================*/

	static public function ctrMostrarTallas($item, $valor){

		$tabla = "tallas";

		$respuesta = ModeloInventario::MdlMostrarInventarioAll($tabla, $item, $valor);
	
		return $respuesta;
	}

	/*=============================================
	VALIDAR NO REPETIR TALLA
	=============================================*/

	static public function ctrValidar($item, $valor, $valorP){

		$tabla = "tallas";

		$respuesta = ModeloInventario::MdlValidar($tabla, $item, $valor, $valorP);
	
		return $respuesta;
	}

    /*=============================================
	ELIMINAR TALLAS
	=============================================*/

	static public function ctrEliminarTalla($item, $valor){

		$tabla = "tallas";
        $datos = $valor;

		$respuesta = ModeloInventario::MdlEliminarTalla($tabla, $datos);
	
		return $respuesta;
	}

    /*=============================================
	INSERT TALLAS
	=============================================*/

	static public function ctrInsertTalla($datos){

		$tabla = "tallas";

		$respuesta = ModeloInventario::ctrInsertTalla($tabla, $datos);
	
		return $respuesta;
	}

    /*=============================================
	REGISTRO DE INVENTARIO
	=============================================*/

	static public function ctrCrearInventaario(){
        
        $tallas = array();
		if(isset($_POST["nuevoNommbreP"]) && isset($_POST["slcCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNommbreP"]) &&
			   preg_match('/^[a-zA-Z0-9.]+$/', $_POST["nuevoPrecio"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoCantidad"]) ){

                $tallas = $_POST["tallas"];
			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL INVENTARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["nuevoNommbreP"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoNommbreP"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoNommbreP"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "productos";

				

				$datos = array("codigo" => $_POST["nuevoCodigo"],
                               "idUsuario" => $_SESSION["id"],
							   "idCategoria" => $_POST["slcCategoria"],
                               "nombre" => $_POST["nuevoNommbreP"],
                               "genero" => $_POST["slcGenero"],
                               "precio" => $_POST["nuevoPrecio"],
					           "precioOferta" => $_POST["nuevoOferta"],
					           "cantidad" => $_POST["nuevoCantidad"],
					           "foto"=>$ruta,
                               "estado" => $_POST["slcEstado"],
                               "tallas" => $tallas,
							   "descripcion" => $_POST["nuevoDescripcion"]);
				
				$respuesta = ModeloInventario::mdlIngresarInventario($tabla, $datos);

            

			
			
				if($respuesta == "ok"){
					
					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El Producto ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "inventario"; 

						}

					});
				

					</script>';
					


				}	
                
                
			}else{
                
				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El nombre del jersey no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "inventario"; 

						}

					});
				

				</script>';
				
                

			}


		}


	}



	/*=============================================
	EDITAR INVENTARIO
	=============================================*/

	static public function ctrEditarInventario(){
	
		if(isset($_POST["editarNommbreP"]) && isset($_POST["slcCategoriaEditar"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNommbreP"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL INVENTARIO
					=============================================*/

					$directorio = "vistas/img/productos/".$_POST["editarNommbreP"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarNommbreP"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarNommbreP"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "productos";


				$datos = array("id" => $_POST["idProducto"],
							   "codigo" => $_POST["EditarCodigo"],
							   "idUsuario" => $_SESSION["id"],
							   "idCategoria" => $_POST["slcCategoriaEditar"],
							   "nombre" => $_POST["editarNommbreP"],
							   "genero" => $_POST["slcGeneroEditar"],
							   "precio" => $_POST["editarPrecio"],
							   "precioOferta" => $_POST["editarOfertaEditar"],
							   "cantidad" => $_POST["editarCantidad"],
							   "foto" => $ruta,
							   "estado" => $_POST["slcEstadoEditar"],
							   "descripcion" => $_POST["editarDescripcion"]);
				
				$respuesta = ModeloInventario::mdlEditarInventario($tabla, $datos);
				

				if($respuesta == "ok"){
		
					echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "El Producto ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "inventario";

									}
								})

					</script>';
					
					
					

				}


			}else{
				
				echo'<script>

				Swal.fire({
						  icon: "error",
						  title: "¡El jersey no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "inventario";

							}
						})

			  	</script>';
				  

			}

		}

	}


    /*=============================================
	BORRAR INVENTARIO
	=============================================*/

	static public function ctrBorrarInventario(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$datos = $_GET["idProducto"];

			if($_GET["fotoProducto"] != ""){

				unlink($_GET["fotoProducto"]);
				rmdir('vistas/img/productos/'.$_GET["nombreProducto"]);

			}

			$respuesta = ModeloInventario::mdlBorrarInventario($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El Producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "inventario";

								}
							})

				</script>';

			}		

		}

	}


    /* mostrar productos */

    public static function ctrMostrarProductos($item, $valor){

        $tabla = "productos";

        $respuesta = ModeloInventario::MdlMostrarInventario($tabla, $item, $valor);

        return $respuesta;
    }

}