<?php

require_once "conexion.php";

class ModeloTestimonios{
    /*=============================================
	REGISTRO DE TESTIMONIO
	=============================================*/

	static public function mdlIngresarTestimonio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario, idCliente, nombreCliente, calificacion, testimonio, estado, foto) VALUES (:idUsuario, NULL, :nombreCliente, :calificacion, :testimonio, 1, :foto)");

		
		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
		$stmt->bindParam(":calificacion", $datos["calificacion"], PDO::PARAM_STR);
		$stmt->bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR TESTIMONIOS
	=============================================*/

	static public function mdlMostrarTestimonios($tabla, $item, $valor){
	
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
	EDITAR TESTIMONIOS
	=============================================*/

	static public function mdlEditarTestimonio($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idUsuario = :idUsuario, nombreCliente = :nombreCliente, calificacion = :calificacion, testimonio = :testimonio, foto = :foto WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombreCliente", $datos["nombreCliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":calificacion", $datos["calificacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":testimonio", $datos["testimonio"], PDO::PARAM_STR);
        

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR TESTIMONIO
	=============================================*/

	static public function mdlActualizarTestimonio($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR TESTIMONIO
	=============================================*/

	static public function mdlBorrarTestimonio($tabla, $datos){

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

}