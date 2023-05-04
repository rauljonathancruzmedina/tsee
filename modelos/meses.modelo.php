<?php

require_once "conexion.php";

class ModeloMeses{


  /*--=====================================
        MOSTRAR MESES
  ======================================-->*/

  static public function mdlMostrarMeses($tabla, $item, $valor){

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
        AGREGAR MESES A CLIENTES AGRAGADOS
  ======================================-->*/

  static public function mdlIngresarMesCliente($tablaMPago, $datosMes){

    $stmt = Conexion::conectar()->prepare("INSERT INTO $tablaMPago(id_cliente, Enero, Febrero,Marzo, Abril, Mayo, Junio, Julio, Agosto, Septiembre, Octubre, Noviembre, Diciembre) VALUES (:id_cliente, :Enero, :Febrero, :Marzo, :Abril, :Mayo, :Junio, :Julio, :Agosto, :Septiembre, :Octubre, :Noviembre, :Diciembre)");

    $stmt->bindParam(":id_cliente", $datosMes["id_cliente"], PDO::PARAM_STR);
    $stmt->bindParam(":Enero", $datosMes["Enero"], PDO::PARAM_STR);
    $stmt->bindParam(":Febrero", $datosMes["Febrero"], PDO::PARAM_STR);
    $stmt->bindParam("Marzo",$datosMes["Marzo"], PDO::PARAM_STR);
    $stmt->bindParam("Abril",$datosMes["Abril"], PDO::PARAM_STR);
    $stmt->bindParam(":Mayo", $datosMes["Mayo"], PDO::PARAM_STR);
    $stmt->bindParam(":Junio", $datosMes["Junio"], PDO::PARAM_STR);

    $stmt->bindParam(":Julio", $datosMes["Julio"], PDO::PARAM_STR);
    $stmt->bindParam(":Agosto", $datosMes["Agosto"], PDO::PARAM_STR);
    $stmt->bindParam("Septiembre",$datosMes["Septiembre"], PDO::PARAM_STR);
    $stmt->bindParam("Octubre",$datosMes["Octubre"], PDO::PARAM_STR);
    $stmt->bindParam(":Noviembre", $datosMes["Noviembre"], PDO::PARAM_STR);
    $stmt->bindParam(":Diciembre", $datosMes["Diciembre"], PDO::PARAM_STR);

    if($stmt->execute()){

      return "ok";  

    }else{

      return "error";
    
    }

    $stmt->close();
    
    $stmt = null;

  }


  
}