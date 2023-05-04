<?php

require_once "conexion.php";

class ModeloProductos{

	/*=====================================================
					MOSTAR PRODUCTOS
	=====================================================*/


	static public function mdlMostrarProductos($tabla, $item, $valor, $orden){
      
		if ($item != null) {
				
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

			
		} else {
			
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt ->execute();

			return $stmt ->fetchAll();
			  }
	}

/*=====================================================
					REGISTRO DE PRODUCTOS
=====================================================*/

static public function mdlIngresarProductos($tabla, $datos){
 
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, nSerie, descripcion, marca, imagen, stock, medida, precio_compra, precio_venta, precio_ventaa, precio_ventaaa) VALUES (:id_categoria, :codigo, :nSerie, :descripcion, :marca, :imagen, :stock, :medida, :precio_compra, :precio_venta, :precio_ventaa, :precio_ventaaa)");

	$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
	$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
	$stmt->bindParam(":nSerie", $datos["nSerie"], PDO::PARAM_STR);
	$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
	$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
	$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
	$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
	$stmt->bindParam(":medida", $datos["medida"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_ventaa", $datos["precio_ventaa"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_ventaaa", $datos["precio_ventaaa"], PDO::PARAM_STR);

	if ($stmt->execute()) {
		
		return "ok";

	} else {
		return "error";
	
	}
	
	$stmt->close();
	$stmt = null;

}

	/*=====================================================
					EDITAR PRODUCTO
	=====================================================*/
static public function mdlEditarProductos($tabla, $datos){
 
    $stmt = Conexion::conectar()->prepare("UPDATE  $tabla SET id_categoria = :id_categoria, nSerie = :nSerie , descripcion = :descripcion, marca = :marca, imagen = :imagen, stock = :stock, medida = :medida, precio_compra = :precio_compra, precio_venta = :precio_venta, precio_ventaa = :precio_ventaa, precio_ventaaa = :precio_ventaaa WHERE codigo =  :codigo");

	$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
	$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
	$stmt->bindParam(":nSerie", $datos["nSerie"], PDO::PARAM_STR);
	$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
	$stmt->bindParam(":marca", $datos["marca"], PDO::PARAM_STR);
	$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
	$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
	$stmt->bindParam(":medida", $datos["medida"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_ventaa", $datos["precio_ventaa"], PDO::PARAM_STR);
	$stmt->bindParam(":precio_ventaaa", $datos["precio_ventaaa"], PDO::PARAM_STR);

	if ($stmt->execute()) {
		
		return "ok";

	} else {
		return "error";
	
	}
	
	$stmt->close();
	$stmt = null;

}


/*=====================================================
					BORRAR  PRODUCTO
=====================================================*/
static public function mdlEliminarProducto($tabla, $datos){

	$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

	$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

    if ($stmt -> execute()) {

    	return "ok";

    } else {
    	
    	return "error";
    
    }
    
    $stmt -> close();

    $stmt = null;

}

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*===========================================
	=            MOSTRAR SUMA VENTAS            =
	===========================================*/
	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt ->close();

		$stmt = null;
	}
	
	
}

