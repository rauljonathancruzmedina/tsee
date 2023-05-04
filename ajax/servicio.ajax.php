<?php

require_once "../controladores/sevicios.controlador.php";
require_once "../modelos/servicio.modelo.php";

class AjaxServicio{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idservicio;

	public function ajaxEditarServicio(){

		$item = "id";
		$valor = $this->idservicio;

		$respuesta = ControladorServicio::CtrMostrarServicio($item, $valor);

		echo json_encode($respuesta);

	}

}	


/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idservicio"])){

	$servicio = new AjaxServicio();
	$servicio -> idservicio = $_POST["idservicio"];
	$servicio -> ajaxEditarServicio();
}

