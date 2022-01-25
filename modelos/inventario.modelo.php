<?php
require_once "conexion.php";
class ModeloInventario{

    /*=============================================
	MOSTRAR INVENTARIO
	=============================================*/

	static public function MdlMostrarInventario($tabla, $item, $valor){
	
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
	MOSTRAR INVENTARIO EDITAR
	=============================================*/

	static public function MdlMostrarInventarioEditar($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT p.id,  p.codigo, p.idUsuario, p.idCategoria, p.nombre, p.genero, p.precio, p.precioOferta, p.cantidad, p.foto, p.estado, p.descripcion, c.nombre as categoria FROM $tabla p JOIN categorias c ON p.idCategoria = c.id WHERE p.$item = :$item");
           
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
	VALIDAR NO REPETIR 
	=============================================*/

	static public function MdlValidar($tabla, $item, $valor, $valorP ){
	

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idProducto = :idProducto AND $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> bindParam(":idProducto", $valorP, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


		

		$stmt -> close();

		$stmt = null;

	}

    /*=============================================
	MOSTRAR CON ARRAY
	=============================================*/

	static public function MdlMostrarInventarioAll($tabla, $item, $valor){
	
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchALL();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			
			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

    /*=============================================
	REGISTRO DE INVENTARIO Y TALLAS
	=============================================*/

	static public function mdlIngresarInventario($tabla, $datos){

        $cn =  Conexion::conectar();

        try {
            $cn->beginTransaction();
            if($datos["precioOferta"] == ""){
                $stmt = $cn->prepare("INSERT INTO $tabla(codigo, idUsuario, idCategoria, nombre, genero, precio, precioOferta, cantidad, foto, estado, descripcion) VALUES (:codigo, :idUsuario, :idCategoria, :nombre, :genero, :precio, NULL, :cantidad, :foto, :estado, :descripcion)");
           
                $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
                $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
                $stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
                $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
                
                $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
                $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        
                $stmt->execute();
            }else{
                $stmt = $cn->prepare("INSERT INTO $tabla(codigo, idUsuario, idCategoria, nombre, genero, precio, precioOferta, cantidad, foto, estado, descripcion) VALUES (:codigo, :idUsuario, :idCategoria, :nombre, :genero, :precio, :precioOferta, :cantidad, :foto, :estado, :descripcion)");
           
                $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
                $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
                $stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
                $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
                $stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
                $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

                $stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
                
                $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
                $stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
                $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
                $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        
                $stmt->execute();
            }



            $idTalla = $cn->lastInsertId();
            
            $tallas = $datos["tallas"];

            for ($i=0; $i < count($tallas) ; $i++) { 
                $stmtTalla =  $cn->prepare("INSERT INTO tallas(id, idProducto, talla)VALUES
                (NULL, :idProducto, :talla)");

                $stmtTalla -> bindParam(":idProducto", $idTalla, PDO::PARAM_STR);
                $stmtTalla -> bindParam(":talla", $tallas[$i], PDO::PARAM_STR);
                $stmtTalla->execute();
            }

            if($cn->commit()){
    
                return "ok";	
    
            }else{
    
                return "error";
            
            }
    
            $stmt->close();
            
            $stmt = null;
        } catch (\Throwable $th) {
            $cn->rollBack();
        }



	}


    /*=============================================
	BORRAR INVENTARIO
	=============================================*/

	static public function mdlBorrarInventario($tabla, $datos){

        $cn =  Conexion::conectar();

        try {
            $cn->beginTransaction();




            $stmtTallas = $cn->prepare("DELETE FROM tallas WHERE idProducto = :id");

            $stmtTallas -> bindParam(":id", $datos, PDO::PARAM_INT);

            $stmtTallas -> execute();


            $stmt = $cn->prepare("DELETE FROM $tabla WHERE id = :id");

            $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

            $stmt -> execute();
    
            if($cn->commit()){
    
                return "ok";
            
            }else{
    
                return "error";	
    
            }
    
            $stmt -> close();
    
            $stmt = null;
        } catch (\Throwable $th) {
            $cn->rollBack();
        }




	}

    /*=============================================
	BORRAR TALLAS
	=============================================*/

	static public function MdlEliminarTalla($tabla, $datos){

        $cn =  Conexion::conectar();

        try {
            $cn->beginTransaction();


            $stmt = $cn->prepare("DELETE FROM $tabla WHERE id = :id");

            $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

            $stmt -> execute();
    
            if($cn->commit()){
    
                return "ok";
            
            }else{
    
                return "error";	
    
            }
    
            $stmt -> close();
    
            $stmt = null;
        } catch (\Throwable $th) {
            $cn->rollBack();
        }




	}

    /*=============================================
	REGISTRO DE  TALLAS
	=============================================*/

	static public function ctrInsertTalla($tabla, $datos){

        $cn =  Conexion::conectar();

        try {
            $cn->beginTransaction();

                $stmtTalla =  $cn->prepare("INSERT INTO tallas(id, idProducto, talla)VALUES
                (NULL, :idProducto, :talla)");

                $stmtTalla -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_STR);
                $stmtTalla -> bindParam(":talla", $datos["talla"], PDO::PARAM_STR);
                $stmtTalla->execute();

            if($cn->commit()){
    
                return "ok";	
    
            }else{
    
                return "error";
            
            }
    
            $stmt->close();
            
            $stmt = null;
        } catch (\Throwable $th) {
            $cn->rollBack();
        }



	}

	/*=============================================
	EDITAR PRODUCTOS
	=============================================*/

	static public function mdlEditarInventario($tabla, $datos){
        
        if($datos["precioOferta"] == ""){
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, idUsuario = :idUsuario, idCategoria = :idCategoria, nombre = :nombre, genero = :genero,  precio = :precio,  cantidad = :cantidad, foto = :foto, estado = :estado, descripcion = :descripcion WHERE id = :id");
        }else{
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, idUsuario = :idUsuario, idCategoria = :idCategoria, nombre = :nombre, genero = :genero,  precio = :precio, precioOferta = :precioOferta, cantidad = :cantidad, foto = :foto, estado = :estado, descripcion = :descripcion WHERE id = :id");
            $stmt->bindParam(":precioOferta", $datos["precioOferta"], PDO::PARAM_STR);
        }

  
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
        $stmt->bindParam(":idCategoria", $datos["idCategoria"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        
		if($stmt -> execute()){

			return "ok";
            
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}