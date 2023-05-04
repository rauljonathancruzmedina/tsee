<?php

class ControladorEmpresa{
  /* ======================================== 
            REGISTRO DE EMPRESA
  ========================================*/

	static public function ctrCrearEmpresa(){

	 if (isset($_POST["nuevoNombre"])) {
	 
	 	 if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
  		  preg_match('/^[#\/.,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccion"])&&
  		  preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"])){

	  		/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if(isset($_FILES["nuevaFoto"]["tmp_name"]) && !empty($_FILES["nuevaFoto"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/empresa/".$_POST["idEmpresa"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if(!empty($_POST["fotoActual"])){

						unlink($_POST["fotoActual"]);

					}else{

						mkdir($directorio, 0755);

					}	

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresa/".$_POST["idEmpresa"]."/".$aleatorio.".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["nuevaFoto"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100,999);

						$ruta = "vistas/img/empresa/".$_POST["idEmpresa"]."/".$aleatorio.".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				} 
            

		  		$tabla = "empresa";

		  		$datos = array("nombre" => $_POST["nuevoNombre"],
		  					   "correo" => $_POST["nuevoCorreo"],
		  					   "telefono" => $_POST["nuevoTelefono"],
		  					   "propietario" => $_POST["nuevoPropietario"],
		  					   "RFC" => $_POST["nuevoRFC"],
		  					   "direccion" => $_POST["nuevaDireccion"],
		  					   "foto" => $ruta,
		  					   "id" =>$_POST["idEmpresa"]);
		  						
		  		/* ======================================== 
                VALIDACION DE REGISTRO
                ========================================*/	
               
                	$respuesta = ModeloEmpresa::mdlEditarEmpresa($tabla, $datos);

		  		if ($respuesta == "ok") {

		  		echo '<script>

						Swal.fire({
							type: "success",
						  icon: "success",
						  title: "¡Bien hecho!",
						  text: "¡Los datos han sido editados correctamente.!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){

							if(result.value){
							
								window.location = "crear-venta";

							}

						});

						</script>';		

		         } else {

								echo '<script>
							   var Toast = Swal.mixin({
								   toast: true,
								   position: "top-end",
								   showConfirmButton: false,
								   timer: 3000
								   });
								   Toast.fire({
							       icon: "error",
							       title: "No se puedo editar los datos de la empresa."
							      })

								</script>';
                    
                	
              }   
		  		
		} 
		
	}
}

/* ======================================== 
            MOSTRAR DE EMPRESA
  ========================================*/
   static public function ctrMostrarEmpresa($item, $valor){

 	$tabla = "empresa";

 	$respuesta = ModeloEmpresa::mdlMostrarEmpresa($tabla, $item, $valor);

 	return $respuesta;

 }

/* ======================================== 
            CONFIGURACION DE EMPRESA
  ========================================*/

  static public function ctrCambioColor(){

  	if (isset($_POST["nuevoColor"])) {

  		$tabla = "empresa";

		$datos = array("id"=>$_POST["idColor"],
					   "color"=>$_POST["nuevoColor"]);

		$respuesta = ModeloEmpresa::modelCambioColor($tabla, $datos);

		if ($respuesta == "ok") {
			
			echo '<script>

				Swal.fire({
				  title: "¡El color ha sido cambiado correctamente!",
				  type: "success",
				  icon: "success",
					showConfirmButton: true,
					confirmButtonText: "Cerrar"

				}).then(function(result){

					if(result.value){
					
						window.location = "home";

					}

				});

				</script>';	

		}

	}

  	}


/* ======================================== 
          GUARDAR DINERO EN CAJA DE EMPRESA
  ========================================*/

  static public function ctrDineroCaja(){

	if (isset($_POST["DineroCaja"])) {

		$tabla = "empresa";

		  $datos = array("id"=>$_POST["idCaja"],
									  "caja"=>$_POST["DineroCaja"],
									  "fecha"=>$_POST["FechaCaja"]);

		  $respuesta = ModeloEmpresa::modelDineroCaja($tabla, $datos);

		  if ($respuesta == "ok") {
			  
			  echo '<script>

				  Swal.fire({
					title: "¡El dinero en caja se guardo correctamente!",
					type: "success",
					icon: "success",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"

				  }).then(function(result){

					  if(result.value){
					  
						  window.location = "crear-venta";

					  }

				  });

				  </script>';	

		  }

	  }

}


}