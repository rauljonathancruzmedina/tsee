<?php

class ControladorServicio{

	/*--=====================================
        CREAR SERVICIO
  ======================================-->*/

	static public function ctrCrearServicio(){

		if(isset($_POST["nuevoServicio"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoServicio"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecio"])){

				$tabla = "sevicios";

				$datos = array("nombre" => $_POST["nuevoServicio"],
							   "intensidad" => $_POST["nuevaVelocidad"],
							   "precio" => $_POST["nuevoPrecio"]);

				$respuesta = ModeloServicio::mdlIngresarServicio($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal.fire({

						type: "success",
						icon: "success",
						title: "¡Bien hecho!",
						text: "¡El servicio de internet fue agregado correctamente.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "serviciosI";

						}

					});
				

					</script>';

				}


			} else {

				echo '<script>

					swal.fire({

						type:"error",
                		icon: "error",
						title: "Oops...!",
						text: "¡El servicio no puede ir vacío o llevar caracteres especiales.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "sevicios";

						}

					});
				

					</script>';

			}

		}

	}


	/*--=====================================
        MOSTRAR SERVICIO
  ======================================-->*/

	static public function CtrMostrarServicio($item, $valor){

		$tabla = "sevicios";

		$respuesta = ModeloServicio::mdlMostrarServicio($tabla, $item, $valor);

		return $respuesta;


	}


	/*--=====================================
        EDITAR SERVICIO
  ======================================-->*/
	static public function ctrEditarServicio(){

		if(isset($_POST["idServic"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarServicio"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecio"])){

				$tabla = "sevicios";
				
				$datos = array("nombre" => $_POST["editarServicio"],
							   "precio" => $_POST["editarPrecio"],
							   "intensidad" => $_POST["EditarVelocidad"],
								"id" => $_POST["idServic"]);

				$respuesta = ModeloServicio::mdlEditarServicio($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal.fire({

						type: "success",
						icon: "success",
						title: "¡Bien hecho!",
						text: "¡El servicio fue editado correctamente.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "serviciosI";

						}

					});
				

					</script>';

				}


			} else {

				echo '<script>

					swal.fire({

						type:"error",
                		icon: "error",
						title: "Oops...!",
						text: "¡El servicio no puedo ser editado correctamente.!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "seviciosI";

						}

					});
				

					</script>';

			}

		}

	}


	/*--=====================================
        BORRAR SERVICIO 
  ======================================-->*/
	static public function ctrBorrarServicio(){

		if(isset($_GET["idservicio"])){

			$tabla ="sevicios";
			$datos = $_GET["idservicio"];

			$respuesta = ModeloServicio::mdlBorrarServicio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal.fire({
						  type: "success",
						  icon: "success",
						  title: "¡Bien hecho!",
						  text: "¡El servicio ha sido borrado correctamente!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "serviciosI";

									}
								})

					</script>';
			}
			
		}
		
	}

	}



	
