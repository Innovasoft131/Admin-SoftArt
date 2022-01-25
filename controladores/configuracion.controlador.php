<?php
class ControladorConfiguracion{

    /*=============================================
	MOSTRAR CONFIGURACIÓN DE REDES SOCIALES
	=============================================*/

	static public function ctrMostrarConfigRedes($item, $valor){

		$tabla = "configRedes";

		$respuesta = ModeloConfiguracion::MdlMostrarConfig($tabla, $item, $valor);
	
		return $respuesta;
	}

	/*=============================================
	MOSTRAR CONFIGURACIÓN DE PÁGINA DE INICIO 
	=============================================*/

	static public function ctrMostrarConfigInicio($item, $valor){

		$tabla = "configInicio";

		$respuesta = ModeloConfiguracion::MdlMostrarConfig($tabla, $item, $valor);
	
		return $respuesta;
	}

	/*=============================================
	ACTUALIZAR CONFIGURACIÓN DE REDES SOCIALES
	=============================================*/

	static public function ctrEditarConfigRedes(){

		if(isset($_POST["nuevoConfigWhatsapp"])){

			if(preg_match('/^[a-zA-Z0-9@.]+$/', $_POST["nuevoConfigEmail"])){



				$tabla = "configRedes";


				$datos = array("whatsapp" => $_POST["nuevoConfigWhatsapp"],
                               "email" => $_POST["nuevoConfigEmail"],
                               "instagram" => $_POST["nuevoConfigInstagram"],
					           "idUsuario" => $_SESSION["id"],
							   "id" => $_POST["nuevoConfigId"],
							   "passwordEmail" => $_POST["nuevoConfigPassword"]);
				
				$respuesta = ModeloConfiguracion::mdlEditarConfigRedes($tabla, $datos);

		
			
				if($respuesta == "ok"){
				
					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El Cliente ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "configRedes";

						}

					});
				

					</script>';
					


				}	


			}else{
			
				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡la Configuración no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "configRedes";

						}

					});
				

				</script>';


			}


		}


	}


	/*=============================================
	ACTUALIZAR CONFIGURACIÓN DE PAGINA DE INICIO
	=============================================*/

	static public function ctrEditaConfigInicio(){
	
		if(isset($_POST["nuevoConfigInicioId"])){
			
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["nuevoTituloSlogan"]) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["nuevoConfigslogan"]) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["nuevoConfigTitPers"]) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["nuevoConfigsubTitPers"]) &&
			preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["nuevoConfigPers"])){
				
				/*=============================================
				VALIDAR IMAGEN HOMBRE
				=============================================*/

				$rutaHombre = $_POST["fotoActualHombre"];
				
				if(isset($_FILES["fotoHombre"]["tmp_name"]) && !empty($_FILES["fotoHombre"]["tmp_name"])){
					
					list($ancho, $alto) = getimagesize($_FILES["fotoHombre"]["tmp_name"]);

					$nuevoAncho = 800;
					$nuevoAlto = 800;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL HOMBRES
					=============================================*/

					$directorioHombre = "vistas/img/plantilla/hombre";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualHombre"])){

						unlink($_POST["fotoActualHombre"]);

					}else{

						mkdir($directorioHombre, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotoHombre"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaHombre = "vistas/img/plantilla/hombre/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoHombre"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaHombre);

					}

					if($_FILES["fotoHombre"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaHombre = "vistas/img/plantilla/hombre/".$aleatorio.".jpg";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaHombre);

					}

				}

				/*=============================================
				VALIDAR IMAGEN MUJER
				=============================================*/

				$rutaMujer = $_POST["fotoActualMujer"];

				if(isset($_FILES["fotoMujer"]["tmp_name"]) && !empty($_FILES["fotoMujer"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["fotoMujer"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorioMujer = "vistas/img/plantilla/mujer";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualMujer"])){

						unlink($_POST["fotoActualMujer"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotoMujer"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaMujer = "vistas/img/plantilla/mujer/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoMujer"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaMujer);

					}

					if($_FILES["fotoMujer"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaMujer = "vistas/plantilla/mujer/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["fotoMujer"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaMujer);

					}

				}


				/*=============================================
				VALIDAR IMAGEN INFANTE
				=============================================*/

				$rutaInfante = $_POST["fotoActualInfante"];

				if(isset($_FILES["fotoInfante"]["tmp_name"]) && !empty($_FILES["fotoInfante"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["fotoInfante"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorioInfante = "vistas/img/plantilla/infante";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualInfante"])){

						unlink($_POST["fotoActualInfante"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotoInfante"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaInfante = "vistas/img/plantilla/infante/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoInfante"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaInfante);

					}

					if($_FILES["fotoInfante"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaInfante = "vistas/img/plantilla/infante/".$aleatorio.".jpg";

						$origen = imagecreatefrompng($_FILES["fotoInfante"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaInfante);

					}

				}

				/*=============================================
				VALIDAR IMAGEN Personalizado
				=============================================*/

				$rutaPersonalizado = $_POST["fotoActualPersonalizado"];

				if(isset($_FILES["fotoInPersonalizado"]["tmp_name"]) && !empty($_FILES["fotoInPersonalizado"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["fotoInPersonalizado"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorioPersonalizado = "vistas/img/plantilla/personalizado";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualPersonalizado"])){

						unlink($_POST["fotoActualPersonalizado"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotoInPersonalizado"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPersonalizado = "vistas/img/plantilla/personalizado/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoInPersonalizado"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaPersonalizado);

					}

					if($_FILES["fotoInPersonalizado"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaPersonalizado = "vistas/img/plantilla/personalizado/".$aleatorio.".jpg";

						$origen = imagecreatefrompng($_FILES["fotoInPersonalizado"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaPersonalizado);

					}

				}

				$tabla = "configInicio";



				$datos = array("tituloSlogan" => $_POST["nuevoTituloSlogan"],
							   "slogan" => $_POST["nuevoConfigslogan"],
							   "id" => $_POST["nuevoConfigInicioId"],
							   "imgHombre" => $rutaHombre,
							   "imgMujer" => $rutaMujer,
							   "imgInfante" => $rutaInfante,
							   "tituloPers" => $_POST["nuevoConfigTitPers"],
							   "subTituloPers" => $_POST["nuevoConfigsubTitPers"],
							   "textoPers" => $_POST["nuevoConfigPers"],
							   "imgPers" => $rutaPersonalizado,
							   "idUsuario" => $_SESSION["id"]);

				$respuesta = ModeloConfiguracion::mdlEditarConfigInicio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  icon: "success",
						  title: "La Configuración ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "configInicio";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

				Swal.fire({
						  icon: "error",
						  title: "¡En la Configuración no pueden atributos ir vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "configInicio";

							}
						})

			  	</script>';

			}

		}

	}
}