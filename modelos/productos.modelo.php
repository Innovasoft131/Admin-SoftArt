<?php

require_once "conexion.php";

class ModeloProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlMostrarDetalleProductos($tabla, $item, $valor)
	{

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tablas, $datos)
	{



		$cn = Conexion::conectar();

		try {


			$cn->beginTransaction();
			//$stmt = $cn -> prepare("INSERT INTO :tabla(id, idSubCategoria, nombre, descripcion, foto) VALUES (NULL, :idSubCategoria, :nombre, :descripcion, :foto)");
			if ($datos["oferta"] == "") {
				$stmt = $cn->prepare("INSERT INTO " . $tablas["tabla1"] . "(id, idCategoria, idSubCategoria, nombre, descripcion, foto, precio_venta, oferta_venta) VALUES (NULL, " . $datos["idCategoria"] . ", " . $datos["idSubCategoria"] . ", '" . $datos["nombre"] . "', '" . $datos["descripcion"] . "', '" . $datos["img"] . "', '" . $datos["precio"] . "', NULL)");
				$stmt->bindParam(":tabla", $tablas["tabla1"], PDO::PARAM_STR);

				$stmt->bindParam(":idSubCategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
				$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
				$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
				$stmt->bindParam(":foto", $datos["img"], PDO::PARAM_STR);
				$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
			} else {
				$stmt = $cn->prepare("INSERT INTO " . $tablas["tabla1"] . "(id, idCategoria, idSubCategoria, nombre, descripcion, foto, precio_venta, oferta_venta) VALUES (NULL, " . $datos["idCategoria"] . ", " . $datos["idSubCategoria"] . ", '" . $datos["nombre"] . "', '" . $datos["descripcion"] . "', '" . $datos["img"] . "', '" . $datos["precio"] . "', '" . $datos["oferta"] . "')");
				$stmt->bindParam(":tabla", $tablas["tabla1"], PDO::PARAM_STR);

				$stmt->bindParam(":idSubCategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
				$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
				$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
				$stmt->bindParam(":foto", $datos["img"], PDO::PARAM_STR);
				$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
				$stmt->bindParam(":oferta", $datos["oferta"], PDO::PARAM_STR);
			}


			$stmt->execute();

			//	$idProducto = $cn -> lastInsertId();





			if ($cn->commit()) {

				return "ok";
			} else {

				return "error";
			}

			$cn->close();
			$cn = null;
		} catch (\Throwable $th) {
			$cn->rollBack();
		}
	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idCategoria = :idCategoria, idSubCategoria = :idSubCategoria, nombre = :nombre, descripcion = :descripcion, foto = :foto,  precio_venta = :precio_venta, oferta_venta = :oferta_venta WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":idSubCategoria", $datos["idSubCategoria"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":oferta_venta", $datos["oferta"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	EDITAR DETALLE DE PRODUCTO
	=============================================*/
	static public function mdlEditarDetalleProducto($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idProducto = :idProducto, tamanio = :tamanio, medidas = :medidas, material = :material, color = :color, cantidad = :cantidad, precio_venta = :precio_venta WHERE id = :id");
		//var_dump("UPDATE $tabla SET idProducto = ".$datos["idProducto"].", tamanio = '".$datos["tamanio"]."', medidas = '".$datos["medidas"]."', material = '".$datos["material"]."', color = '".$datos["color"]."', cantidad = '".$datos["cantidad"]."', precio_venta = '".$datos["precio_venta"]."' WHERE id = ".$datos["id"]);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":tamanio", $datos["tamanio"], PDO::PARAM_STR);
		$stmt->bindParam(":medidas", $datos["medidas"], PDO::PARAM_STR);
		$stmt->bindParam(":material", $datos["material"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	}


	/*=============================================
	GUARDAR DETALLE DE PRODUCTO
	=============================================*/
	static public function mdlInsertDetalleProducto($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, idProducto, tamanio, medidas, material, color, cantidad, precio_venta)VALUES(NULL, :idProducto, :tamanio, :medidas, :material, :color, :cantidad, :precio_venta)");
		//var_dump("INSERT $tabla INTO(id, idProducto, tamanio, medidas, material, color, cantidad, precio_venta)VALUES(NULL, ".$datos["idProducto"].", '".$datos["tamanio"]."', '".$datos["medidas"]."', '".$datos["material"]."', '".$datos["color"]."', '".$datos["cantidad"]."', '".$datos["precio_venta"]."')");
		$stmt->bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_STR);
		$stmt->bindParam(":tamanio", $datos["tamanio"], PDO::PARAM_STR);
		$stmt->bindParam(":medidas", $datos["medidas"], PDO::PARAM_STR);
		$stmt->bindParam(":material", $datos["material"], PDO::PARAM_STR);
		$stmt->bindParam(":color", $datos["color"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos)
	{

		$cn = Conexion::conectar();
		try {
			$cn->beginTransaction();

			$stmt = $cn->prepare("DELETE FROM $tabla WHERE id = :id");

			$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

			$stmt->execute();

			$stmtp = $cn->prepare("DELETE FROM detallesProducto WHERE idProducto = :id");

			$stmtp->bindParam(":id", $datos, PDO::PARAM_INT);

			$stmtp->execute();

			if ($cn->commit()) {

				return "ok";
			} else {

				return "error";
			}
		} catch (\Throwable $th) {
			$cn->rollBack();
		}




		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}


	/*=============================================
	BORRAR DETALLE DEL PRODUCTO
	=============================================*/

	static public function mdlEliminarDetalleProducto($tabla, $datos)
	{

		$cn = Conexion::conectar();
		try {
			$cn->beginTransaction();

			$stmtp = $cn->prepare("DELETE FROM $tabla WHERE id = :id");

			$stmtp->bindParam(":id", $datos, PDO::PARAM_INT);

			$stmtp->execute();

			if ($cn->commit()) {

				return "ok";
			} else {

				return "error";
			}
		} catch (\Throwable $th) {
			$cn->rollBack();
		}




		$stmt->close();

		$stmt = null;
	}
}
