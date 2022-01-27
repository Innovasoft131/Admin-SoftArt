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
	MOSTRAR CONFIGURACIÓN DE PÁGINA 
	=============================================*/

	static public function ctrMostrarConfig($item, $valor){

		$tabla = "configTienda";

		$respuesta = ModeloConfiguracion::MdlMostrarConfig($tabla, $item, $valor);
	
		return $respuesta;
	}

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
							   "facebook" => $_POST["nuevoConfigfacebook"]);
				
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
	ACTUALIZAR CONFIGURACIÓN DE PAGINA 
	=============================================*/

	static public function ctrEditaConfigPagina(){
	
		if(isset($_POST["nombreEmpresa"])){
			
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["nombreEmpresa"])){
				
				/*=============================================
				VALIDAR logo
				=============================================*/

				$rutaLogo = $_POST["fotoActuallogo"];
				
				if(isset($_FILES["fotologo"]["tmp_name"]) && !empty($_FILES["fotologo"]["tmp_name"])){
					
					list($ancho, $alto) = getimagesize($_FILES["fotologo"]["tmp_name"]);

					$nuevoAncho = 800;
					$nuevoAlto = 800;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL LOGO
					=============================================*/

					$directorioLogo = "vistas/img/plantilla/logo";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActuallogo"])){

					//	unlink($_POST["fotoActuallogo"]);

					}else{

						mkdir($directorioLogo, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotologo"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaLogo = "vistas/img/plantilla/logo/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotologo"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaLogo);

					}

					if($_FILES["fotologo"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaLogo = "vistas/img/plantilla/logo/".$aleatorio.".jpg";

						$origen = imagecreatefrompng($_FILES["fotologo"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaLogo);

					}

				}

				/*=============================================
				VALIDAR IMAGEN Icono
				=============================================*/

				$rutaIcono = $_POST["fotoActuallogoicon"];

				if(isset($_FILES["fotologoicon"]["tmp_name"]) && !empty($_FILES["fotologoicon"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["fotologoicon"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL ICONO
					=============================================*/

					$directorioIcono = "vistas/img/plantilla/icono";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActuallogoicon"])){

					//	unlink($_POST["fotoActuallogoicon"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotologoicon"]["type"] == "image/x-icon"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaIconoM = "vistas/img/plantilla/icono/".$_FILES["fotologoicon"]["name"];

						if(move_uploaded_file($_FILES["fotologoicon"]["tmp_name"], $rutaIconoM)){
							$rutaIcono = "vistas/img/plantilla/icono/".$_FILES["fotologoicon"]["name"];
						}

						

					}

				

				}

				/*=============================================
				VALIDAR LOGO PARA PIE DE PAGINA
				=============================================*/

				$rutaLogoPie = $_POST["fotoActuallogopie"];
				
				if(isset($_FILES["fotologopie"]["tmp_name"]) && !empty($_FILES["fotologopie"]["tmp_name"])){
					
					list($ancho, $alto) = getimagesize($_FILES["fotologopie"]["tmp_name"]);

					$nuevoAncho = 800;
					$nuevoAlto = 800;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL LOGO
					=============================================*/

					$directorioLogoPie = "vistas/img/plantilla/logoPie";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActuallogopie"])){

					//	unlink($_POST["fotoActuallogopie"]);

					}else{

						mkdir($directorioLogoPie, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotologopie"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaLogoPie = "vistas/img/plantilla/logoPie/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotologopie"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaLogoPie);

					}

					if($_FILES["fotologopie"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaLogoPie = "vistas/img/plantilla/logoPie/".$aleatorio.".jpg";

						$origen = imagecreatefrompng($_FILES["fotologopie"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaLogoPie);

					}

				}



	

				$tabla = "configTienda";



				$datos = array("id" => $_POST["idConfig"],
							   "logo" => $rutaLogo,
							   "logoIcon" => $rutaIcono,
							   "logoPie" => $rutaLogoPie,
							   "tamanioLogoMenu" => $_POST["tamanioLogoMenu"],
							   "tamanioLogoPie" => $_POST["tamanioLogoPie"],
							   "nombreTienda" => $_POST["nombreEmpresa"],
							   "colorCorporativo" => $_POST["colorCorporativo"],
							   "colorTexto" => $_POST["colorTexto"],
							   "colorPie" => $_POST["colorPie"],
							   "colorTextoPie" => $_POST["colorTextoPie"],
							   "colorMenu" => $_POST["colorMenu"],
							   "colorTextoMenu" => $_POST["colorTextoMenu"],
							   "direccion" => $_POST["direccion"],
							   "tamanioNombre" => $_POST["tamanioNombre"],
							   "idUsuario" => $_SESSION["id"]);

				$respuesta = ModeloConfiguracion::mdlEditarConfig($tabla, $datos);

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


	/*=============================================
	ACTUALIZAR CONFIGURACIÓN DE PAGINA  INICIO
	=============================================*/

	static public function ctrEditaConfigInicio(){
		
		if(isset($_POST["fotoActualbanner"])){
			
			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ.,!¡¿?\r\n ]+$/', $_POST["tamanioSlogan"])){
				
				/*=============================================
				VALIDAR banner
				=============================================*/

				$rutaBanner = $_POST["fotoActualbanner"];
				
				if(isset($_FILES["fotoBanner"]["tmp_name"]) && !empty($_FILES["fotoBanner"]["tmp_name"])){
					
					list($ancho, $alto) = getimagesize($_FILES["fotoBanner"]["tmp_name"]);

					$nuevoAncho = 1680;
					$nuevoAlto = 800;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL LOGO
					=============================================*/

					$directorioBanner = "vistas/img/plantilla/banner";

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActualbanner"])){

					//	unlink($_POST["fotoActualbanner"]);

					}else{

						mkdir($directorioLogo, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["fotoBanner"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaBanner = "vistas/img/plantilla/banner/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["fotoBanner"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $rutaBanner);

					}

					if($_FILES["fotoBanner"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$rutaBanner = "vistas/img/plantilla/banner/".$aleatorio.".jpg";

						$origen = imagecreatefrompng($_FILES["fotoBanner"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $rutaBanner);

					}

				}




	

				$tabla = "configInicio";



				$datos = array("id" => $_POST["idConfigInicio"],
							   "slogan" => $_POST["slogan"],
							   "colorSlogan" => $_POST["colorSlogan"],
							   "colorSpan" => $_POST["colorSpan"],
							   "tamanioSlogan" => $_POST["tamanioSlogan"],
							   "img" => $rutaBanner,
							   "parrafoSlogan" => $_POST["nuevoConfigslogan"],
							   "colorParrafo" => $_POST["colorParrafo"],
							   "tamanioParrafo" => $_POST["tamanioParrafo"],
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