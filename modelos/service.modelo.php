<?php

require_once "conexion.php";

class ModeloService{

	/*--=====================================
        CREAR SERVICOS
  ======================================-->*/
  static public function mdlIngresarService($tabla, $datos){

 		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, costo) VALUES (:nombre, :costo)");

 		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
 		$stmt -> bindParam(":costo", $datos["costo"], PDO::PARAM_STR);


 		if($stmt -> execute()){

 			return "ok";

 		}else{

 			return "error";

 		}

 		$stmt->close();
 		$stmt = null;

  }

  /*--=====================================
        MOSTRAR SERVICIO
  ======================================-->*/
  	static public function mdlMostrarService($tabla, $item, $valor){

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


 /*--=====================================
        EDITAR SERVICIO 	
  ======================================-->*/
  static public function mdlEditarService($tabla, $datos){

 		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, costo = :costo WHERE id = :id");
 		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
 		$stmt -> bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
 		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

	 		if($stmt -> execute()){

	 			return "ok";

	 		}else{

	 			return "error";

	 		}

	 		$stmt->close();
	 		$stmt = null;

  }
 	
 	/*--=====================================
        ELIMINAR SERVICIO
  ======================================-->*/

static public function mdlBorrarService($tabla, $datos){

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


# =============================================================================
# =           METODOS PARA LA ORDEN DEL SERVICIO EN NUESTRO SISTEMA           =
# =============================================================================



 /*--=====================================
        MOSTRAR ORDEN DE SERVICIO 
  ======================================-->*/
  	static public function mdlMostrarOrdenService($tabla, $item, $valor){

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

 # ===============================================
 # =           CREAR ORDEN DE SERVICIO           =
 # ===============================================
 
 
 static public function mdlIngresarOrdenServicio($tablaS, $datosS){

 		$stmt = Conexion::conectar()->prepare("INSERT INTO $tablaS(id_vendedor, id_cliente, codigo, id_tecnico, productos, servicios, comentarios, neto, total, totalP, totalS, codigoV, importe, cambio) VALUES (:id_vendedor, :id_cliente, :codigo, :id_tecnico, :productos, :servicios, :comentarios, :neto, :total, :totalP, :totalS, :codigoV, :importe, :cambio)");

 		$stmt -> bindParam(":id_vendedor", $datosS["id_vendedor"], PDO::PARAM_INT);
 		$stmt -> bindParam(":id_cliente", $datosS["id_cliente"], PDO::PARAM_INT);
 		$stmt -> bindParam(":codigo", $datosS["codigo"], PDO::PARAM_STR);
 		$stmt -> bindParam(":id_tecnico", $datosS["id_tecnico"], PDO::PARAM_INT);
 		$stmt -> bindParam(":productos", $datosS["productos"], PDO::PARAM_STR);
 		$stmt -> bindParam(":servicios", $datosS["servicios"], PDO::PARAM_STR);
 		$stmt -> bindParam(":comentarios", $datosS["comentarios"], PDO::PARAM_STR);
 		$stmt -> bindParam(":neto", $datosS["neto"], PDO::PARAM_STR);
 		$stmt -> bindParam(":total", $datosS["total"], PDO::PARAM_STR);
 		$stmt -> bindParam(":totalP", $datosS["totalP"], PDO::PARAM_STR);
 		$stmt -> bindParam(":totalS", $datosS["totalS"], PDO::PARAM_STR);
 		$stmt -> bindParam(":codigoV", $datosS["codigoV"], PDO::PARAM_INT);
 		$stmt -> bindParam(":importe", $datosS["importe"], PDO::PARAM_STR);
 		$stmt -> bindParam(":cambio", $datosS["cambio"], PDO::PARAM_STR);




 		if($stmt -> execute()){

 			return "ok";

 		}else{

 			return "error";

 		}

 		$stmt->close();
 		$stmt = null;

  }

 # ===============================================
 # =           EDITAR ORDEN DE SERVICIO           =
 # ===============================================
 
  static public function mdlEditarOrdenServicio($tablaS, $datosS){

    $stmt = Conexion::conectar()->prepare("UPDATE $tablaS SET id_vendedor = :id_vendedor, id_cliente = :id_cliente, id_tecnico = :id_tecnico, productos = :productos, servicios = :servicios, comentarios = :comentarios, neto = :neto, total = :total, totalP = :totalP, totalS = :totalS, codigoV = :codigoV, importe =:importe, cambio = :cambio WHERE  codigo = :codigo");

    $stmt -> bindParam(":id_vendedor", $datosS["id_vendedor"], PDO::PARAM_INT);
    $stmt -> bindParam(":id_cliente", $datosS["id_cliente"], PDO::PARAM_INT);
    $stmt -> bindParam(":codigo", $datosS["codigo"], PDO::PARAM_STR);
    $stmt -> bindParam(":id_tecnico", $datosS["id_tecnico"], PDO::PARAM_INT);
    $stmt -> bindParam(":productos", $datosS["productos"], PDO::PARAM_STR);
    $stmt -> bindParam(":servicios", $datosS["servicios"], PDO::PARAM_STR);
    $stmt -> bindParam(":comentarios", $datosS["comentarios"], PDO::PARAM_STR);
    $stmt -> bindParam(":neto", $datosS["neto"], PDO::PARAM_STR);
    $stmt -> bindParam(":total", $datosS["total"], PDO::PARAM_STR);
    $stmt -> bindParam(":totalP", $datosS["totalP"], PDO::PARAM_STR);
    $stmt -> bindParam(":totalS", $datosS["totalS"], PDO::PARAM_STR);
    $stmt -> bindParam(":codigoV", $datosS["codigoV"], PDO::PARAM_INT);
    $stmt -> bindParam(":importe", $datosS["importe"], PDO::PARAM_STR);
    $stmt -> bindParam(":cambio", $datosS["cambio"], PDO::PARAM_STR);




    if($stmt -> execute()){

      return "ok";

    }else{

      return "error";

    }

    $stmt->close();
    $stmt = null;

  }

  # ===============================================
  # =           ELIMINAR ORDEN SERVICIO           =
  # ===============================================
  
  
  static public  function mdBorrarOrdenServicio($tabla, $datos){

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