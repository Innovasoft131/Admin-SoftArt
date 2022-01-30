<?php

require_once "conexion.php";

class ModeloPreguntas{
    /*=============================================
	REGISTRO DE PREGUNTAS
	=============================================*/

	static public function mdlIngresarPreguntas($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario, pregunta, respuesta) VALUES (:idUsuario, :pregunta, :respuesta)");

		

        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":pregunta", $datos["pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta", $datos["respuesta"], PDO::PARAM_STR);
		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PREGUNTAS
	=============================================*/

	static public function MdlMostrarPreguntas($tabla, $item, $valor){
	
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
	EDITAR PREGUNTAS
	=============================================*/

	static public function mdlEditarPreguntas($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idUsuario = :idUsuario,  pregunta = :pregunta, respuesta = :respuesta WHERE id = :id");


        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":pregunta", $datos["pregunta"], PDO::PARAM_STR);
		$stmt->bindParam(":respuesta", $datos["respuesta"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR PREGUNTA
	=============================================*/

	static public function mdlBorrarPregunta($tabla, $datos){

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