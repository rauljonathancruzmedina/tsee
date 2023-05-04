<?php

require_once "../controladores/clientesI.controlador.php";
require_once "../modelos/clientesI.modelo.php"; 

class AjaxClientesI{

  /*=====================================
    EDITAR CLIENTE
  ======================================*/

  public $idClientI;

  public function ajaxEditarClienteI(){

    $item = "id";
    $valor = $this->idClientI;

    $respuesta = ControladorClientesI::ctrMostrarClientesI($item, $valor);

    echo json_encode($respuesta);


  }
	
}

/*=====================================
    EDITAR CLIENTE
  ======================================*/

  if(isset($_POST["idClientI"])){

  $clienteI = new AjaxClientesI();
  $clienteI -> idClientI = $_POST["idClientI"];
  $clienteI -> ajaxEditarClienteI();

}