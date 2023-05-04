<?php

class ControladorProductos{
	 /* ======================================== 
            MOSTRAR PRODUCTOS
     ========================================*/	
  static public function ctrMostrarProductos($item, $valor, $orden){
  	
  	$tabla = "productos";

  	$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

  	return $respuesta;
  }
  	 /* ======================================== 
            CREAR PRODUCTOS
     ========================================*/	
 
 static public function ctrCrearProductos(){
 	if (isset($_POST["nuevaDescripcion"])) {
 		if (preg_match('/^[0-9]+$/', $_POST["nuevaCantidad"]) &&
 				preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"])) {

 			/* ======================================== 
            VALIDAR IMAGEN
            ========================================*/

 			
 			$ruta ="vistas/img/productos/default/anonymous.png";

 			if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
					
					list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*==================================================
							DIRECCTORIO DONDE VAMOS A GUARDAR LA FOTO DE PRODUCTO
					==================================================*/

					$directorio = "vistas/img/productos/".$_POST["nuevoCodig"];

					mkdir($directorio, 0755);

					if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {
						
						/*==================================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						==================================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodig"]."/".$aleatorio.".jpeg";

						$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);


					}

					if ($_FILES["nuevaImagen"]["type"] == "image/png") {
						
						/*==================================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						==================================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["nuevoCodig"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
						

					}

				}


 			$tabla = "productos";

 			$datos = array("id_categoria" => $_POST["nuevaCategoria"],
 					      "codigo" => $_POST["nuevoCodig"],
 					      "nSerie" => $_POST["nuevoNumSerie"],
 					      "descripcion" => $_POST["nuevaDescripcion"],
 					      "marca" => $_POST["nuevaMarca"],
 					      "stock" => $_POST["nuevaCantidad"],
 					      "medida" => $_POST["nuevaUnidadMedida"],
 					      "precio_compra" => $_POST["nuevoPrecioCompra"],
 					      "precio_venta" => $_POST["nuevoPrecioVenta"],
 					      "precio_ventaa" => $_POST["nuevoPrecioMayoreo"],
 					      "precio_ventaaa" => $_POST["nuevoApartir"],
 					      "imagen" => $ruta);
 				   

 			$respuesta = ModeloProductos::mdlIngresarProductos($tabla, $datos);

 			if ($respuesta == "ok") {
 				
 				echo '<script>

						Swal.fire({
							type: "success",
						  icon: "success",
						  title: "¡Bien hecho!",
						  text: "¡El producto ha sido guardado correctamente.!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "productos";

							}

						});

						</script>';
 				}

 		} else{
 			echo '<script>

 						 swal.fire({
                type:"error",
                icon: "error",
                title: "Oops...!",
                text: "¡El producto no puede ir vacío o llevar caracteres especiales.!",
                showConfirmButton: true,
              confirmButtonText: "Cerrar"
              
          }).then(function(result){

              if(result.value){   
                  window.location = "productos";
                } 
          });

					</script>';

 		}
 	}
 }

 /* ======================================== 
            EDITAR PRODUCTOS
     ========================================*/	
 
 static public function ctrEditarProductos(){
 	if (isset($_POST["editarDescripcion"])) {
 		if (preg_match('/^[0-9]+$/', $_POST["editarCantidad"]) &&
 			preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
 			preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])&&
 			preg_match('/^[0-9.]+$/', $_POST["editarPrecioMayoreo"])) {

 			/* ======================================== 
            VALIDAR IMAGEN
            ========================================*/

 			
 			$ruta =$_POST["imagenActual"];

 			if (isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])) {
					
					list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*==================================================
					CREAMOS	DIRECCTORIO DONDE VAMOS A GUARDAR LA FOTO DE USUARIO
					==================================================*/

					$directorio = "vistas/img/productos/".$_POST["editarCodig"];


					/*==================================================
					PRIMERO PREGUNTAMOS SI  EXISTE OTRA IMAGEN EN LA BD
					==================================================*/
					if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

						unlink($_POST["imagenActual"]);

					}else{

						mkdir($directorio, 0755);

					}	


					if ($_FILES["editarImagen"]["type"] == "image/jpeg") {
						
						/*==================================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						==================================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarCodig"]."/".$aleatorio.".jpeg";

						$origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);

						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);


					}

					if ($_FILES["editarImagen"]["type"] == "image/png") {
						
						/*==================================================
							GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						==================================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/productos/".$_POST["editarCodig"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);

						$destino =imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
						

					}

				}


 			$tabla = "productos";

 			$datos = array("id_categoria" => $_POST["editarCategoria"],
 					      "codigo" => $_POST["editarCodig"],
 					      "nSerie" => $_POST["editarNumSerie"],
 					      "descripcion" => $_POST["editarDescripcion"],
 					      "marca" => $_POST["editarMarca"],
 					      "stock" => $_POST["editarCantidad"],
 					      "medida" => $_POST["editarUnidadMedida"],
 					      "precio_compra" => $_POST["editarPrecioCompra"],
 					      "precio_venta" => $_POST["editarPrecioVenta"],
 					      "precio_ventaa" => $_POST["editarPrecioMayoreo"],
 					      "precio_ventaaa" => $_POST["editarApartir"],
 					      "imagen" => $ruta);
 				   

 			$respuesta = ModeloProductos::mdlEditarProductos($tabla, $datos);

 			if ($respuesta == "ok") {
 				
 				echo '<script>

						Swal.fire({
							type: "success",
						  icon: "success",
						  title: "¡Bien hecho!",
						  text: "¡El producto ha sido editado correctamente.!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "productos";

							}

						});

						</script>';
 			}

 		}else{
 			echo '<script>
				   swal.fire({
                type:"error",
                icon: "error",
                title: "Oops...!",
                text: "¡El producto no puede ir vacío o llevar caracteres especiales.!",
                showConfirmButton: true,
              confirmButtonText: "Cerrar"
              
          }).then(function(result){

              if(result.value){   
                  window.location = "productos";
                } 
          });

					</script>';

 		}
 	}
 }


/*==================================================					
BORRAR
==================================================*/
 static	public function ctrEliminarProducto(){

 	if (isset($_GET["idProducto"])) {
 		$tabla = "productos";
 		$datos = $_GET["idProducto"];

 		if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/Recurso.svg") {
 			unlink($_GET["imagen"]);
 			rmdir('vistas/img/productos/'.$_GET["codigo"]);
 		} 

 		$respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

 		if ($respuesta == "ok") {
 				
			echo '<script>

				Swal.fire({
					type: "success",
				  icon: "success",
				  title: "¡Bien hecho!",
				 	text: "¡El producto ha sido borrado correctamente.!",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "productos";

					}

				});

				</script>';
 			}

     	} 
   }

   /*===========================================
   =           MOSTRAR SUMA VENTAS            =
   ===========================================*/
   
   static public function ctrMostrarSumaVentas(){

   		$tabla = "productos";

   		$respuesta =ModeloProductos::mdlMostrarSumaVentas($tabla);

   		return $respuesta;

   }
   

}

  