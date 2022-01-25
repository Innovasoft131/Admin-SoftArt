<?php

class ControladorCotizaciones{

    /*=============================================
	REGISTRO DE COTIZACIONES
	=============================================*/

	static public function ctrInsertCotizacion(){
        

		if(isset($_POST["nuevoMinimo"]) ){

			if(preg_match('/^[0-9.]+$/', $_POST["nuevoMinimo"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoMaximo"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecio"]) &&
               preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["slNuevoEstado"]) ){



				$tabla = "cotizaciones";

				

				$datos = array("idUsuario" => $_SESSION["id"],
                               "minimo" => $_POST["nuevoMinimo"],
                               "maximo" => $_POST["nuevoMaximo"],
                               "precio" => $_POST["nuevoPrecio"],
                               "estado" => $_POST["slNuevoEstado"]);
				
				$respuesta = ModeloCotizacion::mdlIngresarCotizacion($tabla, $datos);

            

				
			
				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "¡La Cotización ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "cotizaciones"; 

						}

					});
				

					</script>';


				}	
                
                
			}else{
                
				echo '<script>

				Swal.fire({

						icon: "error",
						title: "¡El minimo  no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "cotizaciones"; 

						}

					});
				

				</script>';
                

			}


		}


	}

}