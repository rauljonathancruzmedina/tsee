<?php

require_once "conexion.php";

class ModeloClientesI{
	/*--=====================================
        CREAR CLIENTE 
  ======================================-->*/
  	static public function mdlIngresarClienteI($tabla, $datos){
  		
  		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, telefono, direccion, servicio, contratacion, mensualidad) VALUES(:nombre, :telefono, :direccion, :servicio, :contratacion, :mensualidad)");

  		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
  		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
  		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
      $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
      $stmt->bindParam(":contratacion", $datos["contratacion"], PDO::PARAM_STR);
      $stmt->bindParam(":mensualidad", $datos["mensualidad"], PDO::PARAM_STR);

  		if ($stmt->execute()) {

  			return "ok";

  		}else {

  			return "error";

  		}

  		$stmt->close();
  		$stmt = null;
      
  	} 

      /*--=====================================
        MOSTRAR CLIENTE 
  ======================================-->*/

    static public function mdlMostrarClientesI($tabla, $item, $valor){

       if ($item != null) {
         $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
         $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
         $stmt -> execute();

         return $stmt -> fetch();
       } else{

          $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

          $stmt -> execute();

          return $stmt -> fetchAll();
       }
       
       $stmt -> close();

       $stmt = null;
    }

    /*--=====================================
        EDITAR CLIENTE
    =====================================-->*/

    static public function mdlEditarClienteI($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, telefono = :telefono, direccion = :direccion, servicio = :servicio, contratacion = :contratacion, mensualidad = :mensualidad WHERE id = :id");
  
      $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
      $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
      $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
      $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
      $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
      $stmt->bindParam(":contratacion", $datos["contratacion"], PDO::PARAM_STR);
      $stmt->bindParam(":mensualidad", $datos["mensualidad"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";

    }else{

      return "error";
    
    }

    $stmt->close();
    $stmt = null;

  }


    
    /*--=====================================
        ELIMINAR CLIENTE
  ======================================-->*/

  static public function mdlEliminarClienteI($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
    
    $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

    if ($stmt -> execute()) {

        return "ok";

      } else {
      
      return "error";

    }
    
    $stmt -> close();

    $stmt = null;

  }

/*=============================================
  ACTUALIZAR CLIENTE
  =============================================*/

  static public function mdlActualizarClienteI($tabla, $item1, $valor1, $valor){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

    $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
    $stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }

  

}