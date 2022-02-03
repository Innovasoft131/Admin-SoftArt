<?php

class Controladorcategorias{

    // REGISTRO DE CATEEGORIAS
    static public function ctrInsertCategorias($datos){
            $tabla = "categorias";
            $respuestaInsert = ModeloCategorias::MdlInsertCategorias($tabla, $datos);

            if($respuestaInsert == "ok"){
                    
                return "ok";
            }


    
    }

    static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::MdlMostrarCategorias($tabla, $item, $valor);
	
		return $respuesta;
	}

	static public function ctrMostrarSubCategorias($item, $valor){

		$tabla = "subCategorias";

		$respuesta = ModeloCategorias::MdlMostrarSubCategorias($tabla, $item, $valor);
	
		return $respuesta;
	}


    static public function ctrDeleteCategoria($datos, $foto){

		if($foto != ""){

			unlink('../'.$foto);
			//rmdir('../vistas/img/categorias/'.$datos);

		}


		$tabla = "categorias";

		$respuesta = ModeloCategorias::MdlDeleteCategoria($tabla, $datos);
	
		return $respuesta;
	}

    	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCategoria(){
		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){
              

		
				$tabla = "categorias";

				$datos = array("categoria"=>$_POST["editarCategoria"],
							   "id"=>$_POST["idCategoria"]);

				$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);

				if($respuesta == "ok"){
					

					echo '<script>

					Swal.fire({

						icon: "success",
						title: "!La categoría ha sido cambiada correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "categorias";

						}

					});

					</script>';
					
					

				}


			}else{


				echo '<script>

				  Swal.fire({
  
						  icon: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
  
					  }).then(function(result){
  
						  if(result.value){
							  window.location = "categorias";
  
						  }
  
					  });
  
				  </script>';

			}

		}

	}
}