<?php

require_once "conexion.php";

class ModeloCotizacion{

    /*=============================================
	REGISTRO DE COTIZACIÓN 
	=============================================*/

	static public function mdlIngresarCotizacion($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id, idUsuario, minimo, maximo, precio, estado) VALUES (NULL, :idUsuario, :minimo, :maximo, :precio, :estado)");


		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":minimo", $datos["minimo"], PDO::PARAM_STR);
        $stmt->bindParam(":maximo", $datos["maximo"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}
}