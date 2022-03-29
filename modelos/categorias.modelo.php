<?php
require_once "conexion.php";

class ModeloCategorias{
    static public function MdlMostrarCategorias($tabla, $item, $valor){
	
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

	static public function MdlMostrarCategoriasEditar($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $item = :$item DESC");
		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			
		$stmt -> execute();

		return $stmt -> fetchAll();


		

		$stmt -> close();

		$stmt = null;

	}

	static public function MdlMostrarSubCategorias($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

    // REGISTRO DE CATEGORIAS
    static public function MdlInsertCategorias($tabla, $datos){

		$cn = Conexion::conectar();
		$cn -> beginTransaction();
		$stmt = $cn -> prepare("INSERT INTO $tabla(id, nombre) VALUES (NULL, :nombre)");
	
		
		$stmt->bindParam(":nombre", $datos[0]["categoria"], PDO::PARAM_STR);

		$stmt->execute();

		$idCategoria = $cn -> lastInsertId();

		$stmtSub = $cn -> prepare("INSERT INTO subCategorias(id, idCategoria, nombre) VALUES (NULL, :idCategoria,  :nombre)");
		
		for ($i=0; $i < count($datos); $i++) { 
			$stmtSub->bindParam(":idCategoria", $idCategoria, PDO::PARAM_STR);
			$stmtSub->bindParam(":nombre", $datos[$i]["subCategoria"], PDO::PARAM_STR);

			$stmtSub->execute();
		}

		if($cn -> commit()){

			return "ok";	

		}else{

			return "error";
		
		}

		$stmt->close();
		
		$stmt = null;

	}

    // ELIMINAR CATEGORIA
    static public function MdlDeleteCategoria($tabla, $datos){

		$cn = Conexion::conectar();
		$cn -> beginTransaction();

		$stmtSub = $cn -> prepare("DELETE FROM subCategorias WHERE idCategoria= :id");
		$stmtSub -> bindParam(":id", $datos, PDO::PARAM_INT);
		$stmtSub->execute();

		$stmt = $cn -> prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		$stmt->execute();

		

		if($cn -> commit()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;


	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function mdlEditarCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRAR SUBCATEGORIA
	=============================================*/

	static public function mdlInsertSubCategoria($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idCategoria, nombre)VALUES(:idCategoria, :nombre)");

		$stmt -> bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["subCategoria"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return "error";
		}

		$stmt->close();
		
		$stmt = null;
	}

	/*=============================================
	EDITAR SubCATEGORIA
	=============================================*/

	static public function mdlEditarSubCategoria($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :categoria WHERE id = :id");

		$stmt -> bindParam(":categoria", $datos["subCategoria"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["idSubCategoria"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


}