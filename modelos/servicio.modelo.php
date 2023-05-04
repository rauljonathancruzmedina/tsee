<?php

require_once "conexion.php";

class ModeloServicio{

	/*--=====================================
        CREAR CATEGORIAS
  ======================================-->*/
  static public function mdlIngresarServicio($tabla, $datos){

 		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, intensidad, precio) VALUES (:nombre, :intensidad, :precio)");

 		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

 		$stmt -> bindParam(":intensidad", $datos["intensidad"], PDO::PARAM_STR);

 		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_INT);

 		if($stmt -> execute()){

 			return "ok";

 		}else{

 			return "error";

 		}

 		$stmt->close();
 		$stmt = null;

  }


  /*--=====================================
        MOSTRAR CATEGORIAS
  ======================================-->*/

  static public function mdlMostrarServicio($tabla, $item, $valor){

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


  /*--=====================================
        EDITAR SERVICIO
  ======================================-->*/
  static public function mdlEditarServicio($tabla, $datos){

 		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, intensidad = :intensidad, precio = :precio WHERE id = :id");

 		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);

 		$stmt -> bindParam(":intensidad", $datos["intensidad"], PDO::PARAM_STR);

 		$stmt -> bindParam(":precio", $datos["precio"], PDO::PARAM_STR);

 		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

 		if($stmt -> execute()){

 			return "ok";

 		}else{

 			return "error";

 		}

 		$stmt->close();
 		$stmt = null;

  }

  static public function mdlBorrarServicio($tabla, $datos){

  	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

			if ($stmt -> execute()) {
				
				return "ok";

			}else{

				return "error";
			}

		$stmt -> close();

		$stmt = null;

  }


}