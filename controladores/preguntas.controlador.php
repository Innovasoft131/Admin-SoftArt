<?php

class ControladorPreguntas{

    /*=============================================
	REGISTRO DE PREGUNTAS
	=============================================*/

	static public function ctrCrearPreguntas(){

		if(isset($_POST["nuevaPregunta"])){

			if(preg_match('/^[a-zA-Z0-9 áéíóú.,?¿¡!*]+$/', $_POST["nuevaPregunta"]) &&
			   preg_match('/^[a-zA-Z0-9 áéíóú.,?¿¡!*]+$/', $_POST["nuevaRespuesta"]) ){


				$tabla = "preguntas";

				$datos = array("pregunta" => $_POST["nuevaPregunta"],
					           "respuesta" => $_POST["nuevaRespuesta"],
					           "idUsuario" => $_SESSION["id"]);
				
				$respuesta = ModeloPreguntas::mdlIngresarPreguntas($tabla, $datos);

				
			
				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡La pregunta ha sido guardada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "preguntas";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡La pregunta no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "preguntas";

						}

					});
				

				</script>';

			}


		}


	}

    /*=============================================
	MOSTRAR PREGUNTAS
	=============================================*/

	static public function ctrMostrarPreguntas($item, $valor){

		$tabla = "preguntas";

		$respuesta = ModeloPreguntas::MdlMostrarPreguntas($tabla, $item, $valor);
	
		return $respuesta;
	}


	/*=============================================
	ACTUALIZAR DE PREGUNTA
	=============================================*/

	static public function ctrEditarPregunta(){

		if(isset($_POST["editarPregunta"])){

			if(preg_match('/^[a-zA-Z0-9 áéíóú.,?¿¡!*]+$/', $_POST["editarRespuesta"]) &&
                preg_match('/^[a-zA-Z0-9 áéíóú.,?¿¡!*]+$/', $_POST["editarPregunta"])){


				$tabla = "preguntas";


				$datos = array("id" => $_POST["editarId"],
                               "idUsuario" => $_SESSION["id"],
					           "pregunta" => $_POST["editarPregunta"],
					           "respuesta" => $_POST["editarRespuesta"]);
				
				$respuesta = ModeloPreguntas::mdlEditarPreguntas($tabla, $datos);

				
			
				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡La pregunta ha sido editada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "preguntas";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡La pregunta no puede ir vacía o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "preguntas";

						}

					});
				

				</script>';

			}


		}


	}


	/*=============================================
	BORRAR PREGUNTA
	=============================================*/

	static public function ctrBorrarPregunta(){

		if(isset($_GET["idPregunta"])){

			$tabla ="preguntas";
			$datos = $_GET["idPregunta"];


			$respuesta = ModeloPreguntas::mdlBorrarPregunta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "La pregunta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "preguntas";

								}
							})

				</script>';

			}		

		}

	}


}