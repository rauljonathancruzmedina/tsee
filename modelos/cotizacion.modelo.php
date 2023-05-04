<?php 

class ModeloCotiz{


	static public function MdlMostrarCotiz($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlCrearCotiz($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(remitente, codigo, cliente, productos, comentarios, descuento, neto, total) VALUES (:remitente, :codigo, :cliente, :productos, :comentarios, :descuento, :neto, :total)");

		$stmt->bindParam(":remitente", $datos["remitente"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}



	static public function mdlBorrarCotiz($tabla, $dato){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $dato, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	EDITAR COTIZACION
	=============================================*/
	static public function mdlEditVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET remitente = :remitente, codigo = :codigo, fecha = :fecha, cliente = :cliente, productos = :productos, comentarios = :comentarios, descuento = :descuento, neto = :neto, total = :total WHERE id = :id");

		$stmt -> bindParam(":remitente", $datos["remitente"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt -> bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt -> bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
		$stmt -> bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt -> bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);


		if($stmt -> execute()){

 			return "ok";

 		}else{

 			return "error";

 		}

 		$stmt->close();
 		$stmt = null;

	}
	



}


