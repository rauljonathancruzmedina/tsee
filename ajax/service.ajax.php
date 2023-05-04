<?php

require_once "../controladores/service.controlador.php";
require_once "../modelos/service.modelo.php";

class AjaxService{

	/*=============================================
	EDITAR SERVICIO
	=============================================*/	

	public $idService;

	public function ajaxEditarService(){

		$item = "id";
		$valor = $this->idService;

		$respuesta = ControladorService::ctrMostrarService($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idService"])){

	$service = new AjaxService();
	$service -> idService = $_POST["idService"];
	$service -> ajaxEditarService();
}
