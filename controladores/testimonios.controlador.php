<?php

class ControladorTestimonios{

    /*=============================================
	REGISTRO DE TESTIMONIOS
	=============================================*/

	static public function ctrCrearTestimonio(){

		if(isset($_POST["nuevoNombreCliente"])){
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombreCliente"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoCalificacion"]) &&
			   preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ.,?¿¡!*]+$/', $_POST["nuevoTestimonio"])){

			   	/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/testimonio/".$_POST["nuevoNombreCliente"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/testimonio/".$_POST["nuevoNombreCliente"]."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/testimonio/".$_POST["nuevoNombreCliente"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "testimoniosTienda";

	

				$datos = array("idUsuario" => $_SESSION["id"],
					           "nombreCliente" => $_POST["nuevoNombreCliente"],
                               "calificacion" => $_POST["nuevoCalificacion"],
					           "testimonio" => $_POST["nuevoTestimonio"],
					           "foto"=>$ruta);
				
				$respuesta = ModeloTestimonios::mdlIngresarTestimonio($tabla, $datos);

				
			
				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El testimonio ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "testimonios";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El nombre del cliente no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "testimonios";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR TESTIMONIOS
	=============================================*/

	static public function ctrMostrarTestimonios($item, $valor){

		$tabla = "testimoniosTienda";

		$respuesta = ModeloTestimonios::mdlMostrarTestimonios($tabla, $item, $valor);
	
		return $respuesta;
	}

	/*=============================================
	EDITAR TESTIMONIOS
	=============================================*/

	static public function ctrEditarTestimonio(){
	
		if(isset($_POST["editarNombreCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreCliente"]) &&
            preg_match('/^[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ.,?¿¡!*]+$/', $_POST["editarTestimonio"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

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

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";

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

						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}

				$tabla = "testimoniosTienda";



				$datos = array("id" => $_POST["idTestimonio"],
                               "idUsuario" => $_SESSION["id"],
							   "nombreCliente" => $_POST["editarNombreCliente"],
							   "calificacion" => $_POST["editarCalificacion"],
							   "testimonio" => $_POST["editarTestimonio"],
							   "foto" => $ruta);

				$respuesta = ModeloTestimonios::mdlEditarTestimonio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "El testimonio ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "testimonios";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

				Swal.fire({
						  icon: "error",
						  title: "¡El nombre del cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "testimonios";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR TESTIMONIO
	=============================================*/

	static public function ctrBorrarTestimonio(){

		if(isset($_GET["idTestimonio"])){

			$tabla ="testimoniosTienda";
			$datos = $_GET["idTestimonio"];

			if($_GET["fotoCliente"] != ""){

				
				rmdir('vistas/img/testimonio/'.$_GET["cliente"]);
                unlink($_GET["fotoCliente"]);

			}

			$respuesta = ModeloTestimonios::mdlBorrarTestimonio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El testimonio ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "testimonios";

								}
							})

				</script>';

			}		

		}

	}

}