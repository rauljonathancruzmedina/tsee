<?php

class ControladorClientesI{
	/*--=====================================
        CREAR CLIENTES 
  ======================================-->*/

  	static public function ctrCrearClienteI(){
  
  		if (isset($_POST["nuevClientI"])) {
  			
  			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevClientI"]) &&
  					preg_match('/^[()\-0-9 ]+$/', $_POST["nuevTelClientI"]) &&
  					preg_match('/^[#\/,.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDireccionI"])){
  				
  				$tabla = "clientes";

  				$datos =  array("nombre"=>$_POST["nuevClientI"],
													"telefono"=>$_POST["nuevTelClientI"],
													"direccion"=>$_POST["nuevaDireccionI"],
													"servicio"=>$_POST["nuevoServicioI"],
													"contratacion"=>$_POST["nuevaFechaCont"],
													"mensualidad"=>$_POST["nuevaFechaMes"]);

  				$respuesta = ModeloClientesI::mdlIngresarClienteI($tabla, $datos);

  				if($respuesta == "ok"){

  					$itemCli = null;
  					$valorClie = null;


  					$respuestCliente = ControladorClientesI::ctrMostrarClientesI($itemCli, $valorClie);
  					var_dump($respuestCliente);
  						foreach ($respuestCliente as $key => $value) {
  							
  						}

  						$id_cliente = $value["id"];

  						$tablaMPago = "meses";


  						$datosMes = array("id_cliente"=> $id_cliente,
  															"Enero"=> "Pendiente",
  															"Febrero"=> "Pendiente",
  															"Marzo"=> "Pendiente",
  															"Abril"=> "Pendiente",
  															"Mayo"=> "Pendiente",
  															"Junio"=> "Pendiente",
  															"Julio"=> "Pendiente",
  															"Agosto"=> "Pendiente",
  															"Septiembre"=> "Pendiente",
  															"Octubre"=> "Pendiente",
  															"Noviembre"=> "Pendiente",
  															"Diciembre"=> "Pendiente");

  						$respuestaMesPa = ModeloMeses::mdlIngresarMesCliente($tablaMPago, $datosMes);

					echo '<script>

										Swal.fire({
												  type: "success",
												  icon: "success",
												  title: "¡Bien hecho!",
												 	text: "¡El cliente ha sido agregado correctamente!",
												  showConfirmButton: true,
												  confirmButtonText: "Cerrar"

											}).then(function(result){

											if(result.value){
											
												window.location = "clientesI";

											}

										})
				

								</script>';

				} 

  			} 

  		}
  	}
	/*--=====================================
        MOSTRAR CLIENTES
  ======================================-->*/  	
  static public function ctrMostrarClientesI($item, $valor){

  	$tabla = "clientes";

  	$respuesta = ModeloClientesI::mdlMostrarClientesI($tabla, $item, $valor);

  	return $respuesta;

  }

  /*=====================================
    EDITAR CLIENTE 
  ======================================*/
    static public function ctrEditarClienteI(){

    	if (isset($_POST["editaClientI"])) {
  			
  			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaClientI"]) &&
	  				preg_match('/^[()\-0-9 ]+$/', $_POST["editaTelClientI"]) &&
	  				preg_match('/^[#\/,.\-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editaDireccionI"])){
  				
  				$tabla = "clientes";

  				$datos =  array("id"=>$_POST["idClienI"],
  												"nombre"=>$_POST["editaClientI"],
													"telefono"=>$_POST["editaTelClientI"],
													"direccion"=>$_POST["editaDireccionI"],
													"servicio"=>$_POST["editaServicioI"],
													"contratacion"=>$_POST["editaFechaCont"],
													"mensualidad"=>$_POST["editaFechaMes"]);

  				$respuesta = ModeloClientesI::mdlEditarClienteI($tabla, $datos);

  				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({
							  type: "success",
							  icon: "success",
							  title: "¡Bien hecho!",
							  text: "¡El cliente ha sido editado correctamente.!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientesI";

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
							  text: "¡EL cliente no puede ir vacío o llevar caracteres especiales.!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "clientesI";

						}

					})
				

					</script>';
  			}

  		}
		

	}

  /*=====================================
    ELIMINAR CLIENTE
  ======================================*/

  static public function ctrEliminarClienteI(){

  	if (isset($_GET["idClientI"])) {
  		
  		$tabla ="clientes";
  		$datos = $_GET["idClientI"];
  									
  		$respuesta = ModeloClientesI::mdlEliminarClienteI($tabla, $datos);

  		if ($respuesta == "ok") {
  				echo '<script>

					Swal.fire({
							  type: "success",
							  icon: "success",
							  title: "¡Bien hecho!",
							  text: "¡El cliente ha sido eliminado correctamente.!",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"

						}).then(function(result){

						if(result.value){
						
							window.location = "clientesI";

						}

					})
				

					</script>';

  		} 
  		
  	} 
  	

  }

}
