<?php
require_once "conexion.php";
class ModeloPedidos{
    /*=============================================
	MOSTRAR PEDIDOS
	=============================================*/

	static public function MdlMostrarPedidos(){
	

		$stmt = Conexion::conectar()->prepare("select p.id, p.idCliente, p.fechaPedido, p.estado, c.usuario, c.nombre from pedidos p join clientes c on p.idCliente = c.id order by p.id desc");


		$stmt -> execute();

		return $stmt -> fetchAll();


		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR PEDIDOS POR ID
	=============================================*/

	static public function MdlMostrarPedidoId($pedido){
	

		$stmt = Conexion::conectar()->prepare("SELECT pd.id, c.nombre AS categoria, pr.nombre AS modelo, pr.genero, pd.precio, pd.cantidad, pr.foto FROM pedidos p JOIN pedidosDesglose pd ON p.id = pd.idPedido JOIN  productos pr ON pr.id = pd.idProducto JOIN categorias c ON c.id = pr.idCategoria WHERE p.id = :pedido");

		$stmt -> bindParam(":pedido", $pedido, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();


		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	mostrar pedidos con restricciones
	=============================================*/

	static public function MdlMostrarPedido($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

    /*=============================================
	mostrar cliente por pedido
	=============================================*/

	static public function MdlMostrarClientePedido($tabla, $pedido){
	

		$stmt = Conexion::conectar()->prepare("SELECT c.* FROM $tabla p JOIN clientes c ON p.idCliente = c.id WHERE p.id = :pedido ");

		$stmt -> bindParam(":pedido", $pedido, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetch();


		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	editar pedido
	=============================================*/

	static public function MdlEditarPedido($tabla, $valor, $id){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET estado = :estado WHERE id = :id");

		$stmt -> bindParam(":estado", $valor, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $id, PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



	/*=============================================
	SUMA DE PEDIDOS 
	=============================================*/

	static public function mdlSumaPedidos($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as totalPedidos FROM $tabla WHERE estado = 'pendiente'");
		
		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

}