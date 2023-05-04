<?php
require_once "conexion.php";

 class ModeloEmpresa{

/* ======================================== 
            MOSTRAR DATOS DE LA EMPRESA
  ========================================*/

  static public function mdlMostrarEmpresa($tabla, $item, $valor){
  	if ($item != null) {

  		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

  		$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

  		$stmt -> execute();

  		return $stmt -> fetch();

  	} else {

  		$stmt =Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

  		$stmt -> execute();

  		return $stmt -> fetchAll();

  	}

  	$stmt -> close();

  	$stmt = null;
  	
  }

/* ======================================== 
            EDITAR DATOS DE LA EMPRESA
  ========================================*/

 static public function mdlEditarEmpresa($tabla, $datos){

 	 $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
    nombre =:nombre, correo = :correo, telefono = :telefono, propietario = :propietario, RFC = :RFC, direccion = :direccion, foto= :foto WHERE  id = :id");
   
   $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
 	 $stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
 	 $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
 	 $stmt -> bindParam(":propietario", $datos["propietario"], PDO::PARAM_STR);
 	 $stmt -> bindParam(":RFC", $datos["RFC"], PDO::PARAM_STR);
 	 $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
 	 $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
   $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);

 	 if ($stmt -> execute()) {
 	 	
 	 	return "ok";

 	 } else {

 	 	return "error";
 	 
 	 }

 	 $stmt -> close();

 	 $stmt = null;

 }  


    /* ======================================== 
            CAMBIAR COLOR
  ========================================*/

  static public function modelCambioColor($tabla, $datos){

      $ruso = Conexion::conectar()->prepare("UPDATE $tabla SET color = :color WHERE id = :id");

      $ruso->bindParam(":id", $datos["id"], PDO::PARAM_INT);
      $ruso->bindParam(":color", $datos["color"], PDO::PARAM_STR);

      if ($ruso->execute()) {
        
        return "ok";

      } else {

        return "error";

      }

      $ruso->close();

      $ruso = null;

    }

	 /* ======================================== 
            GUARDAR DINERO DE CAJA
  ========================================*/

  static public function modelDineroCaja($tabla, $datos){

	$ruso = Conexion::conectar()->prepare("UPDATE $tabla SET caja = :caja, fecha = :fecha WHERE id = :id");

	$ruso->bindParam(":id", $datos["id"], PDO::PARAM_INT);
	$ruso->bindParam(":caja", $datos["caja"], PDO::PARAM_STR);
	$ruso->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

	if ($ruso->execute()) {
	  
	  return "ok";

	} else {

	  return "error";

	}

	$ruso->close();

	$ruso = null;

  }


 } 