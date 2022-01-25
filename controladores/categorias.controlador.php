<?php

class Controladorcategorias{

    // REGISTRO DE CATEEGORIAS
    static public function ctrInsertCategorias($datos){
        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["categoria"])){
            $tabla = "categorias";
            $item = "nombre";
            $respuesta = ModeloCategorias::MdlMostrarCategorias($tabla, $item, $datos["categoria"]);

            if($respuesta == null){
                $ruta = "";
                $rutabd = "";

                    /*=============================================
				    Se crea el directorio para la imagen de la pieza
				    =============================================*/

                    $directorio = "../vistas/img/categorias/".$datos["categoria"];
					if(!file_exists($directorio)){
						mkdir($directorio, 0755);
					}
                    

                    // validar imagen 
                if(isset($datos["imgName"]) && $datos["imgName"] != null){

                    list($ancho, $alto) = getimagesize($datos["imgName"]);
                        
                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    

                    if($datos["imagenType"] == "image/jpeg"){

                        /*=============================================
                        Se guarda la imagen en el directorio
                        =============================================*/
    
                        $aleatorio = mt_rand(100,999);
    
                        $ruta = "../vistas/img/categorias/".$datos["categoria"]."/".$aleatorio.".jpg";
                        $rutabd = "vistas/img/categorias/".$datos["categoria"]."/".$aleatorio.".jpg";
    
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
    
                        $ruta = "../vistas/img/productos/".$datos["categoria"]."/".$aleatorio.".png";
                        $rutabd = "vistas/img/productos/".$datos["categoria"]."/".$aleatorio.".png";
    
                        $origen = imagecreatefrompng($datos["imgName"]);
    
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
    
                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
    
                        imagepng($destino, $ruta);
    
                    }
                }
                $datosCategoria = array(
                    "nombre" => $datos["categoria"],
					"foto" => $rutabd
					
                );
                $respuestaInsert = ModeloCategorias::MdlInsertCategorias($tabla, $datosCategoria);

                if($respuestaInsert == "ok"){
                    
                    return "ok";
                }
            }else{
                return "encontrada";
            }

        }else{
            return "datosIncorrectos";
        }

    }

    static public function ctrMostrarCategorias($item, $valor){

		$tabla = "categorias";

		$respuesta = ModeloCategorias::MdlMostrarCategorias($tabla, $item, $valor);
	
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