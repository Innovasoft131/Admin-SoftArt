<?php
class ControladorPedidos{

    /* mostrar los pedidos */

    public static function ctrMostrarPedidos(){

        $respuesta = ModeloPedidos::MdlMostrarPedidos();
	
		return $respuesta;
    }


    /* mostrar pedidos por id */

    public static function ctrMostrarPedidoId($pedido){

        $respuesta = ModeloPedidos::MdlMostrarPedidoId($pedido);
	
		return $respuesta;
    }

    


    /* mostrar los pedidos con rescricciones */

    public static function ctrMostrarPedido($item, $valor){

        $tabla = "pedidos";

        $respuesta = ModeloPedidos::MdlMostrarPedido($tabla, $item, $valor);

        return $respuesta;
    }

    /* mostrar las tallas del pedido con rescricciones */

    public static function ctrMostrarSubCategoria($item, $valor){

        $tabla = "subCategorias";

        $respuesta = ModeloPedidos::MdlMostrarPedido($tabla, $item, $valor);

        return $respuesta;
    }


    /* mostrar cliente por pedido */

    public static function ctrMostrarClientePedido($valor){

        $tabla = "pedidos";
    
        $respuesta = ModeloPedidos::MdlMostrarClientePedido($tabla, $valor);
    
        return $respuesta;
    }


    /* mostrar cliente por pedido */

    public static function ctrEditarPedido(){

        $tabla = "pedidos";

        if(isset($_POST["pedido"]) && isset($_POST["slEstado"])){
            $valor = $_POST["slEstado"];
            $pedido = $_POST["pedido"];
        
            $respuesta = ModeloPedidos::MdlEditarPedido($tabla, $valor, $pedido);
    
            if($respuesta == "ok"){
                echo'<script>
    
                Swal.fire({
                      icon: "success",
                      title: "El pedido ha sido editado correctamente",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                                if (result.value) {
    
                                    window.location = "pedidos";
    
                                }
                            })
    
                </script>';
            }
        }

    }

	/*=============================================
	SUMA DE PEDIDOS 
	=============================================*/

	static public function ctrSumaPedidos(){

		$tabla = "pedidos";

		$respuesta = ModeloPedidos::mdlSumaPedidos($tabla);

		return $respuesta;

	}


}