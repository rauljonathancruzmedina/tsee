<?php

class ControladorClientes{
	/*--=====================================
        CREAR CLIENTES
  ======================================-->*/

  	static public function ctrCrearCliente(){
  
  		if (isset($_POST["nuevoCliente"])) {
  			
  			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"]) &&
  				preg_match('/^[()\-0-9 ]+$/', $_POST["nuevoTelefono"]) &&
  				preg_match('/^[#\/.,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccion"])){
  				
  				$tabla = "clientes";

  				$datos =  array("nombre"=>$_POST["nuevoCliente"],
								"telefono"=>$_POST["nuevoTelefono"],
								"direccion"=>$_POST["nuevaDireccion"]);

  				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

  				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
						type:"success",
						icon: "success",
						title: "¡Bien hecho!",
						text: "¡El cliente fue agregada correctamente.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					})
				

					</script>';

				}

  			} else {
  					echo '<script>

					Swal.fire({
						type:"error",
						icon: "error",
						title: "Oops...!",
						text: "¡El cliente no puede ir vacío o llevar caracteres especiales.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					})
				

					</script>';
  			}

  		}
  	}
	/*--=====================================
        MOSTRAR CLIENTES
  ======================================-->*/  	
  static public function ctrMostrarClientes($item, $valor){

  	$tabla = "clientes";

  	$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

  	return $respuesta;

  }

  /*=====================================
    EDITAR CLIENTE 
  ======================================*/
   static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"]) &&
			   preg_match('/^[()\-0-9 ]+$/', $_POST["editarTelefono"]) && 
			   preg_match('/^[#\/.,\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDireccion"])){

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
			   				   "nombre"=>$_POST["editarCliente"],
					           "telefono"=>$_POST["editarTelefono"],
					           "direccion"=>$_POST["editarDireccion"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					Swal.fire({
						  type:"success",
						  icon: "success",
						  title: "¡Bien hecho!",
						  text: "¡El cliente ha sido cambiado correctamente.!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';

				}

			}else{

				echo'<script>

					Swal.fire({
						  type:"error",
						  icon: "error",
						  title: "Oops...!",
						  text: "¡El cliente no puede ir vacío o llevar caracteres especiales.!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';



			}

		}

	}

  /*=====================================
    ELIMINAR CLIENTE
  ======================================*/

  static public function ctrEliminarCliente(){

  	if (isset($_GET["idCliente"])) {
  		
  		$tabla ="clientes";
  		$datos = $_GET["idCliente"];
  									
  		$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

  		if ($respuesta == "ok") {
  				echo '<script>

					Swal.fire({
						type:"success",
						icon: "success",
						title: "¡Bien hecho!",
						text: "¡El cliente ha sido borrado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientes";

						}

					})
				

					</script>';

  		} 
  		
  	} 
  	

  }

}
