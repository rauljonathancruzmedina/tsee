<?php

require_once "controladores/plantilla.controlador.php";
require_once "controladores/usuarios.controlador.php";
require_once "controladores/categorias.controlador.php";
require_once "controladores/productos.controlador.php";
require_once "controladores/clientes.controlador.php";
require_once "controladores/ventas.controlador.php";
require_once "controladores/sevicios.controlador.php";
require_once "controladores/clientesI.controlador.php";
require_once "controladores/meses.controlador.php";
require_once "controladores/pagos.controlador.php";
require_once "controladores/soporte.controlador.php";
require_once "controladores/contizacion.controlador.php";
require_once "controladores/empresa.controlador.php";
require_once "controladores/service.controlador.php";


require_once "modelos/usuarios.modelo.php";
require_once "modelos/categorias.modelo.php";
require_once "modelos/productos.modelo.php";
require_once "modelos/clientes.modelo.php";
require_once "modelos/ventas.modelo.php";
require_once "modelos/servicio.modelo.php";
require_once "modelos/clientesI.modelo.php";
require_once "modelos/meses.modelo.php";
require_once "modelos/pagos.modelos.php";
require_once "modelos/soporte.modelo.php";
require_once "modelos/cotizacion.modelo.php";
require_once "modelos/service.modelo.php";
require_once "modelos/empresa.modelo.php";








$plantilla = new ControladorPlantilla();
$plantilla -> ctrPlantilla();