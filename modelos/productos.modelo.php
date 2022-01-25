<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

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
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$colores = $datos["colores"];
		$tallas = $datos["tallas"];

		$cn = Conexion::conectar();
		
		try {
		
			$cn -> beginTransaction();
			$stmt = $cn -> prepare("INSERT INTO $tabla(id, codigo, id_categoria, id_usuario, nombre, precio_compra, precio_venta, precio_oferta, stock, descripcion, imagen, fecha) VALUES (NULL, :codigo, :id_categoria, :id_usuario, :nombre, :precio_compra, :precio_venta, :precio_oferta, :stock, :descripcion, :imagen, now())");
			
			$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
			$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
			$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
			$stmt->bindParam(":precio_oferta", $datos["precio_oferta"], PDO::PARAM_STR);
			$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
			$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
			
			$stmt -> execute(); 

			$idProducto = $cn -> lastInsertId();

			$stmtTallas = $cn -> prepare("INSERT INTO tallas(id, idProducto, talla)VALUES(NULL, :idProducto, :talla)");
			$stmtTallas->bindParam(":idProducto", $idProducto, PDO::PARAM_INT);
			for ($i=0; $i < count($tallas); $i++) { 
				$stmtTallas->bindParam(":talla", $tallas[$i], PDO::PARAM_STR);
				$stmtTallas -> execute();
			}

			$stmtColores = $cn -> prepare("INSERT INTO colores(id, idProducto, color)Values(NULL, :idProducto, :color)");
			$stmtColores->bindParam(":idProducto", $idProducto, PDO::PARAM_INT);

			for ($i=0; $i < count($colores); $i++) { 
				$stmtColores->bindParam(":color", $colores[$i], PDO::PARAM_STR);

				$stmtColores -> execute();
			}
			
			if($cn -> commit()){

				return "ok";
	
			}else{
	
				return "error";
			
			}

			$cn -> close();
			$cn = null;


		} catch (\Throwable $th) {
			$cn -> rollBack();
		}
		






	

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, descripcion = :descripcion, imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}



}