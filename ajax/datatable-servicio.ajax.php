<?php

require_once "../controladores/service.controlador.php";
require_once "../modelos/service.modelo.php";

class TablaServicos{
 
 	public function mostrarTablaServios(){

 	$item = null;
 	$valor = null;

 	$servicios = ControladorService::ctrMostrarService($item, $valor);
 	
 	if (count($servicios) == 0) {
 	
 		echo '{"data": []}';
 	
 		return;
 	}

 	$datosJson ='{
 	 "data": [';

 	 for($i = 0; $i < count($servicios); $i++){

 	 	/*=============================================
      TRAEMOS LAS ACCIONES
        =============================================*/ 

        $botones =  "<div class='btn-group'><button class='btn btn-primary agregarServisio recuperarBotonServicio' idService='".$servicios[$i]["id"]."'>Agregar</button></div>"; 

         $datosJson .='[
            "'.($i+1).'",
            "'.$servicios[$i]["nombre"].'",
            "'.$servicios[$i]["costo"].'",
            "'.$botones.'"
          ],';

 	 }

 	 $datosJson = substr($datosJson, 0, -1);

     $datosJson .=   '] 

 	}';	
		echo $datosJson; 
 	
 	}

 }

/*=====================================================
ACTIVAR TABLA DE SERVICIOS
=====================================================*/
$activarServicios = new TablaServicos();
$activarServicios -> mostrarTablaServios(); 