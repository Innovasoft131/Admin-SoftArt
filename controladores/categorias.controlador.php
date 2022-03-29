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

	static public function ctrMostrarCategoriasEditar($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::MdlMostrarCategoriasEditar($tabla, $item, $valor);
	
		return $respuesta;
	}

	static public function ctrMostrarSubCategoriasEditar($item, $valor){

		$tabla = "subCategorias";

		$respuesta = ModeloCategorias::MdlMostrarCategoriasEditar($tabla, $item, $valor);
	
		return $respuesta;
	}

    static public function ctrDeleteCategoria($datos){

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


	/*=============================================
	REGISTRAR SUBCATEGORIA
	=============================================*/
	static public function ctrInsertSubCategoria($datos){
		if(preg_match('/^[a-zA-Z0-9 ÁÉÍÓÚáéíóúñÑ]+$/', $datos["subCategoria"])){

			$tabla = "subCategorias";
			$respuestar = ModeloCategorias::mdlInsertSubCategoria($tabla, $datos);
			
			return $respuestar;
			

		}

	}

	/*=============================================
	ELIMINAR SUBCATEGORIA
	=============================================*/

	static public function ctrDeleteSubCategorias($datos){

		$tabla = "subCategorias";

		$respuesta = ModeloCategorias::MdlDeleteCategoria($tabla, $datos);
	
		return $respuesta;
	}


	/*=============================================
	EDITAR SUBCATEGORIA
	=============================================*/

	static public function ctrEditarSubCategorias($datos){
		if(isset($datos["subCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["subCategoria"])){
              

		
				$tabla = "subCategorias";


				$respuesta = ModeloCategorias::mdlEditarSubCategoria($tabla, $datos);

				return $respuesta;


			}

		}

	}




}