<?php
class ControladorClientes{

    /*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::MdlMostrarClientes($tabla, $item, $valor);
	
		return $respuesta;
	}


    /*=============================================
	REGISTRO DE CLIENTES
	=============================================*/

	static public function ctrCrearClientes(){

		if(isset($_POST["nuevoUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) && 
               preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})+$/', $_POST["nuevoCorreo"])){


				$tabla = "clientes";

				$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("correo" => $_POST["nuevoCorreo"],
					           "usuario" => $_POST["nuevoUsuario"],
					           "password" => $encriptar);
				
				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

				
			
				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El Cliente ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El Cliente no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';

			}


		}


	}


	/*=============================================
	ACTUALIZAR DE CLIENTES
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarUsuario"])){

			if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarUsuario"])){


				$tabla = "clientes";

				if($_POST["editarPassword"] != ""){
					if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){
						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					}else{
						echo'<script>

						Swal.fire({
								  icon: "error",
								  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
								  showConfirmButton: true,
								  confirmButtonText: "Cerrar"
								  }).then(function(result){
									if (result.value) {
	
									window.location = "clientes";
	
									}
								})
	
						  </script>';
					}
					
				}else{
					$encriptar = $_POST["passwordActualCliente"];
				}

			//	$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array("correo" => $_POST["editarCorreo"],
					           "usuario" => $_POST["editarUsuario"],
					           "password" => $encriptar);
				
				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				
			
				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡El Cliente ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

					</script>';


				}	


			}else{

				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El Cliente no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					});
				

				</script>';

			}


		}


	}

	/*=============================================
	BORRAR CLIENTE
	=============================================*/

	static public function ctrBorrarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];


			$respuesta = ModeloClientes::mdlBorrarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
					  icon: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';

			}		

		}

	}

}