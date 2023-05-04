<?php

require_once "conexion.php";

class ModeloPagos{


  /*--=====================================
        MOSTRAR PAGO
  ======================================-->*/

  static public function mdlMostrarPagos($tabla, $item, $valor){

  	if($item != null){

  	 		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

  		}else{

  			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

  			$stmt -> execute();

  			return $stmt -> fetchAll();
  		}

  		$stmt -> close();

  		$stmt = null;


  }


  static public function mdlBorrarPago($tabla, $datos){

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

  /*=============================================
  REGISTRO DE PAGOS 
  =============================================*/

  static public function mdlIngresarPago($tabla, $datos){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(mes, cliente, servicio, importe, cambio, folio,vendedor, comentarios, total) VALUES (:mes, :cliente, :servicio, :importe, :cambio, :folio,:vendedor, :comentarios, :total)");


    $stmt->bindParam(":mes", $datos["mes"], PDO::PARAM_STR);
    $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
    $stmt->bindParam(":servicio", $datos["servicio"], PDO::PARAM_STR);
    $stmt->bindParam(":importe", $datos["importe"], PDO::PARAM_INT);
    $stmt->bindParam(":cambio", $datos["cambio"], PDO::PARAM_STR);
    $stmt->bindParam(":folio", $datos["folio"], PDO::PARAM_STR);
    $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_INT);
    $stmt->bindParam(":comentarios", $datos["comentarios"], PDO::PARAM_STR);
    $stmt->bindParam(":total", $datos["total"], PDO::PARAM_INT);


    if($stmt->execute()){

      return "ok";

    }else{

      return "error";
    
    }

    $stmt->close();
    $stmt = null;

  }


  /*=============================================
  ACTUALIZAR MES
  =============================================*/
                                          
  static public function mdlActualizarMes($tablaMes, $itemMes1, $valorMes, $itemMes, $valorClien){

    $stmt = Conexion::conectar()->prepare("UPDATE $tablaMes SET $itemMes1 = :$itemMes1 WHERE $itemMes = :$itemMes");

    $stmt -> bindParam(":".$itemMes1, $valorMes, PDO::PARAM_STR);
    $stmt -> bindParam(":".$itemMes, $valorClien, PDO::PARAM_STR);

    if($stmt -> execute()){

      return "ok";
    
    }else{

      return "error"; 

    }

    $stmt -> close();

    $stmt = null;

  }

  
}