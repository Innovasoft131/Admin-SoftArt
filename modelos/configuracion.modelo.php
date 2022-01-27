<?php


require_once "conexion.php";

class ModeloConfiguracion{
	/*=============================================
	MOSTRAR CONFIGURACION
	=============================================*/

	static public function MdlMostrarConfig($tabla, $item, $valor){
	
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
	EDITAR CONFIGREDES
	=============================================*/

	static public function mdlEditarConfigRedes($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET whatsapp = :whatsapp, email = :email, instagram = :instagram, idUsuario = :idUsuario, facebook = :facebook WHERE id = :id");

		$stmt->bindParam(":whatsapp", $datos["whatsapp"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":instagram", $datos["instagram"], PDO::PARAM_STR);
        $stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":facebook", $datos["facebook"], PDO::PARAM_STR);

		
		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

    /*=============================================
	EDITAR CONFIGINICIO
	=============================================*/

	static public function mdlEditarConfig($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET logo = :logo, logoIcon = :logoIcon, logoPie = :logoPie, tamanioLogoMenu = :tamanioLogoMenu, tamanioLogoPie = :tamanioLogoPie, nombreTienda = :nombreTienda, tamanioNombre = :tamanioNombre, colorCorporativo = :colorCorporativo, colorTexto = :colorTexto, colorPie = :colorPie, colorTextoPie = :colorTextoPie, colorMenu = :colorMenu, colorTextoMenu = :colorTextoMenu, direccion = :direccion, idUsuario = :idUsuario WHERE id = :id");

		$stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
        $stmt->bindParam(":logoIcon", $datos["logoIcon"], PDO::PARAM_STR);
        $stmt->bindParam(":tamanioLogoMenu", $datos["tamanioLogoMenu"], PDO::PARAM_STR);
        $stmt->bindParam(":tamanioLogoPie", $datos["tamanioLogoPie"], PDO::PARAM_STR);
		$stmt->bindParam(":nombreTienda", $datos["nombreTienda"], PDO::PARAM_STR);
        $stmt->bindParam(":colorCorporativo", $datos["colorCorporativo"], PDO::PARAM_STR);
        $stmt->bindParam(":colorTexto", $datos["colorTexto"], PDO::PARAM_STR);
        $stmt->bindParam(":colorPie", $datos["colorPie"], PDO::PARAM_STR);
        $stmt->bindParam(":colorTextoPie", $datos["colorTextoPie"], PDO::PARAM_STR);
        $stmt->bindParam(":colorMenu", $datos["colorMenu"], PDO::PARAM_STR);
        $stmt->bindParam(":colorTextoMenu", $datos["colorTextoMenu"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":tamanioNombre", $datos["tamanioNombre"], PDO::PARAM_STR);
		$stmt->bindParam(":logoPie", $datos["logoPie"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlEditarConfigInicio($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET slogan = :slogan, colorSlogan = :colorSlogan, colorSpan = :colorSpan, tamanioSlogan = :tamanioSlogan, img = :img, parrafoSlogan = :parrafoSlogan, colorParrafo = :colorParrafo, tamanioParrafo = :tamanioParrafo, idUsuario = :idUsuario WHERE id = :id");

		$stmt->bindParam(":slogan", $datos["slogan"], PDO::PARAM_STR);
        $stmt->bindParam(":colorSlogan", $datos["colorSlogan"], PDO::PARAM_STR);
        $stmt->bindParam(":colorSpan", $datos["colorSpan"], PDO::PARAM_STR);
        $stmt->bindParam(":tamanioSlogan", $datos["tamanioSlogan"], PDO::PARAM_STR);
		$stmt->bindParam(":img", $datos["img"], PDO::PARAM_STR);
        $stmt->bindParam(":parrafoSlogan", $datos["parrafoSlogan"], PDO::PARAM_STR);
        $stmt->bindParam(":colorParrafo", $datos["colorParrafo"], PDO::PARAM_STR);
        $stmt->bindParam(":tamanioParrafo", $datos["tamanioParrafo"], PDO::PARAM_STR);
		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}