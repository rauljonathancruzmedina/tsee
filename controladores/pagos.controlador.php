<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorPagos{


	/*=============================================
	CREAR PAGO
	=============================================*/
	static public function ctrCrearPago(){

		if(isset($_POST["nuevoMes"])){

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tablaPago = "pagos";

			$datos = array("mes" => $_POST["nuevoMes"],
				       "cliente" => $_POST["nuevoCliente"],
				       "servicio" => $_POST["nuevoServicio"],
				       "importe" => $_POST["nuevoPagoS"],
				       "cambio" => $_POST["CambioPago"],
				       "folio" => $_POST["nuevoFolio"],
				       "vendedor" => $_POST["nuevoVendedor"],
				       "comentarios" => $_POST["NuevocomenPag"],
				       "total" => $_POST["nuevoPrecioPago"]);
			
			
			$respuestaPago = ModeloPagos::mdlIngresarPago($tablaPago, $datos);

			
			$tablaMes = "meses";
			$itemMes1 = $_POST["nuevoMes"];
			$valorMes = "Pagado";
			$itemMes = "id_cliente";
			$valorClien = $_POST["nuevoCliente"];

			if($respuestaPago == "ok"){

			   $respuestaMes = ModeloPagos::mdlActualizarMes($tablaMes, $itemMes1, $valorMes, $itemMes, $valorClien);	
				
				echo'<script>

				Swal.fire({

					  type: "success",
					  icon: "success",
					  title: "¡Bien hecho!",
					  text: "¡El cobro ha sido realizado correctamente.!",
					  showConfirmButton: true,
					  
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
						if (result.value) {

						window.location = "pagos";

						}
					})

				</script>';

			}
			

		}

	}




	/*--=====================================
        MOSTRAR MESES 
  ======================================-->*/

	static public function CtrMostrarPagos($item, $valor){

		$tabla = "pagos";

		$respuesta = ModeloPagos::mdlMostrarPagos($tabla, $item, $valor);

		return $respuesta;


	}

	/*=============================================
	TICKET DE VENTAS 
	=============================================*/
	static public function ticket(){

	  if(isset($_GET["idPago"])){
	
	
	    

	  }			

	}

	/*--=====================================
        	BORRAR PAGO
        ======================================-->*/
	static public function ctrBorrarPago(){

	    if(isset($_GET["id"])){

        	$item = "id";
        	$valor = $_GET["id"];

        	$Pago = ControladorPagos::CtrMostrarPagos($item, $valor);

			$tablaMes = "meses";
			$itemMes1 = $Pago["mes"];
			$valorMes = "Pendiente";
			$itemMes = "id_cliente";
			$valorClien = $Pago["cliente"];

			$respuestaMes = ModeloPagos::mdlActualizarMes($tablaMes, $itemMes1, $valorMes, $itemMes, $valorClien);

			$BorrarPago = ControladorPagos::borraPago();
     
			
	     }
			
	}


/*--=====================================
        BORRAR PAGO
  ======================================-->*/
	static public function borraPago(){

		if(isset($_GET["id"])){

			$tabla ="pagos";
			$datos = $_GET["id"];

			$respuesta = ModeloPagos::mdlBorrarPago($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				Swal.fire({
				  type: "success",
				  icon: "success",
				  title: "¡Bien hecho!",
				  text: "¡El pago ha sido borrado correctamente.!",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  }).then(function(result){
					if (result.value) {

					window.location = "pagos";

					}
				   })

				</script>';
			}
			
		}

	}


	/*--=====================================
        BORRAR PAGO 
 	 ======================================-->*/
	static public function ctrBorrarTodPagos(){

	   if(isset($_GET["idCpago"])){

	   	$item = "id";

	   	$valor = $_GET["idCpago"];

	   	$mostrarMes = ControladorMeses::CtrMostrarMeses($item, $valor);

	   	$array = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

	   	$tablaMes = "meses";

	   	$valorMes = "Pendiente";

	   	$itemMes = "id_cliente";

	   	$valorClien = $_GET["idCpago"];

	   	for ($i=0; $i < 12; $i++) { 
                              
	         $itemMes1 = $array[$i];
	         //var_dump($itemMes1);
	         $respuestaMes = ModeloPagos::mdlActualizarMes($tablaMes, $itemMes1, $valorMes, $itemMes, $valorClien);


	        }


	        $itemPa = null;
	        $valorPa = null;

	        $tablaPa = "pagos";

	        $PagosMe = ControladorPagos::CtrMostrarPagos($itemPa, $valorPa);
	        
	        foreach ($PagosMe as $key => $value) {
	        	

	          if ($value["cliente"] == $_GET["idCpago"]) {
	          	
	           $datosPa = $value["id"];
	           
	       	   $respuesta = ModeloPagos::mdlBorrarPago($tablaPa, $datosPa);
	          	
	          }

	        }
		
      
			
	   }
		
	}






}

