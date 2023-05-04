<?php

class ControladorMeses{

	/*--=====================================
        MOSTRAR MESES 
  ======================================-->*/

	static public function CtrMostrarMeses($item, $valor){

		$tabla = "meses";

		$respuesta = ModeloMeses::mdlMostrarMeses($tabla, $item, $valor);

		return $respuesta;

	}

	/*--=====================================
        MOSTRAR MESES PAGADOS 
  ======================================-->*/

	/*--=====================================
        CREAR CLIENTES
  ======================================-->*/

  	static public function ctrCrearCliente(){
  
  		if (isset($_POST["nuevoCliente"])) {
  				
  				$tabla = "clientes";

  				$datos =  array("nombre"=>$_POST["nuevoCliente"],
								"telefono"=>$_POST["nuevoTelefono"],
								"direccion"=>$_POST["nuevaDireccion"],
								"rfc"=>$_POST["nuevoRFC"],
								"cfdi"=>$_POST["nuevoCFDI"]);

  				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

  				if($respuesta == "ok"){

					echo '<script>

					Swal.fire({

						type:"success",
						icon: "success",
						title: "¡Bien hecho!"
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
  		}
  	}


}



	
