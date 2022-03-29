<?php

class ControladorProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	MOSTRAR DETALLE DE LOS PRODUCTOS
	=============================================*/

	static public function ctrMostrarDetalleProductos($item, $valor){

		$tabla = "detallesProducto";

		$respuesta = ModeloProductos::mdlMostrarDetalleProductos($tabla, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	CREAR PRODUCTO
	=============================================*/

	static public function ctrCrearProducto($datos){
		
		
		if(isset($datos["nombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["idSubCategoria"]) ){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/
				
			   	$ruta = "vistas/img/inventario/default/1.jpg";
				$rutabd = "vistas/img/inventario/default/1.jpg";

			   	if(isset($datos["imgName"])){
					
					list($ancho, $alto) = getimagesize($datos["imgName"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/
					
					$directorio = "../vistas/img/inventario/".$datos["nombre"];

					if(!file_exists($directorio)){
						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($datos["imagenType"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						
						$aleatorio = mt_rand(100,999);

						$ruta = "../vistas/img/inventario/".$datos["nombre"]."/".$aleatorio.".jpg";
						$rutabd = "vistas/img/inventario/".$datos["nombre"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($datos["imgName"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($datos["imagenType"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						
						$aleatorio = mt_rand(100,999);

						$ruta = "../vistas/img/inventario/".$datos["nombre"]."/".$aleatorio.".png";
						$rutabd = "vistas/img/inventario/".$datos["nombre"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($datos["imgName"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tablas = array(
					"tabla1" => "productos"
				);


				$datosInsert = array(
					"idCategoria" => $datos["idCategoria"],
					"idSubCategoria" => $datos["idSubCategoria"],
					"nombre" => $datos["nombre"],
					"descripcion" => $datos["descripcion"],
					"img" => $rutabd,
					"precio" => $datos["precio"],
					"oferta" => $datos["oferta"]
				);
				
				
				$respuesta = ModeloProductos::mdlIngresarProducto($tablas, $datosInsert);

				return $respuesta;


			}else{
				


				return "error_interno";

				  
			}
		}
		

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/

	static public function ctrEditarProducto(){

		if(isset($_POST["txtproducto"])){

		   		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			   	$ruta = $_POST["fotoActualProducto"];

			   	if(isset($_FILES["editarImagenI"]["tmp_name"]) && !empty($_FILES["editarImagenI"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarImagenI"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/inventario/".$_POST["editarNombreProductoDetalle"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualProducto"]) && $_POST["fotoActualProducto"] != "vistas/img/inventario/default/1.png"){

						unlink($_POST["fotoActualProducto"]);

					}else{
						if(file_exists($directorio)){
							mkdir($directorio, 0755);	
						}
						
					
					}
					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["editarImagenI"]["type"] == "image/jpeg"){
						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/inventario/".$_POST["editarNombreProductoDetalle"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarImagenI"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["editarImagenI"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/inventario/".$_POST["editarNombreProductoDetalle"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagenI"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "productos";

				$datos = array("idCategoria" => $_POST["editarCategoria"],
							   "id" => $_POST["txtproducto"],
							   "idSubCategoria" => $_POST["editSubCategoriaP"],
							   "nombre" => $_POST["editarNombreProductoDetalle"],
							   "descripcion" => $_POST["summernoteEditar"],
							   "precio" => $_POST["editarPrecio"],
							   "oferta" => $_POST["editarOferta"],
							   "imagen" => $ruta);
			
				$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

				if($respuesta == "ok"){
					
					echo'<script>

					Swal.fire({
							  type: "success",
							  icon: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then((result) => {
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';

						

				}


			
		}

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/
	static public function ctrEliminarProducto(){

		if(isset($_GET["idProducto"])){

			$tabla ="productos";
			$datos = $_GET["idProducto"];

			if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/inventario/default/1.png"){

				unlink($_GET["imagen"]);
			/*	rmdir('vistas/img/inventario/'.$_GET["codigo"]); */

			}

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			if($respuesta == "ok"){


				echo'<script>

				Swal.fire({
					icon: "success",
					title: "El producto ha sido borrado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"
					}).then(function(result){
								if (result.value) {

								window.location = "productos";
								}
							})

				</script>';

			}		
		}


	}

	/*=============================================
	EDITAR DETALLE DE PRODUCTO
	=============================================*/
	static public function ctrEditarEdetalleProducto($datos){
		/*
		if(preg_match('/[a-zA-Z0-9.,]+/', $datos["tamanio"]) && preg_match('/[a-zA-Z0-9.,]+/', $datos["medidas"]) &&
		preg_match('/[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9., ]+/', $datos["material"]) && preg_match('/[0-9]+/', $datos["cantidad"]) &&
		preg_match('/[0-9$.,]+/', $datos["precio_venta"])  ){
			*/
			$tabla = "detallesProducto";

			$respuesta = ModeloProductos::mdlEditarDetalleProducto($tabla , $datos);
			return $respuesta;
		/*
		}else{
			return 'error_sintaxis';
		}
		*/
	}

	/*=============================================
	GUARDAR DETALLE DE PRODUCTO
	=============================================*/
	static public function ctrGuardardetalleProducto($datos){
		if(preg_match('/[a-zA-Z0-9.,]+/', $datos["tamanio"]) && preg_match('/[a-zA-Z0-9.,]+/', $datos["medidas"]) &&
		preg_match('/[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9., ]+/', $datos["material"]) && preg_match('/[0-9]+/', $datos["cantidad"]) &&
		preg_match('/[0-9$.,]+/', $datos["precio_venta"])  ){
			$tabla = "detallesProducto";

			$respuesta = ModeloProductos::mdlInsertDetalleProducto($tabla , $datos);
			return $respuesta;

		}else{
			return 'error_sintaxis';
		}
	}


	/*=============================================
	BORRAR DETALLE DEL PRODUCTO
	=============================================*/
	static public function ctrEliminarDetalleProducto($valor){

		if(isset($valor)){

			$tabla ="detallesProducto";
			$datos = $valor;

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

			return $respuesta;
		}


	}

}