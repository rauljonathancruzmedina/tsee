<?php

require_once "../../../controladores/pagos.controlador.php";
require_once "../../../modelos/pagos.modelos.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/meses.controlador.php";
require_once "../../../modelos/meses.modelo.php";

require_once "../../../controladores/sevicios.controlador.php";
require_once "../../../modelos/servicio.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

class imprimirTicket{

public $codigo;

public function traerImpresionTicket(){

//TRAEMOS LA INFORMACIÓN DE LA Cobro

$itemCobro = "id";
$valorCobro = $this->codigo;

$respuestaCobro = ControladorPagos::CtrMostrarPagos($itemCobro, $valorCobro);

$fecha = substr($respuestaCobro["fecha"],0,-8);
$mes = $respuestaCobro["mes"];

$itemServicio = "id";
$valorServicio = $respuestaCobro["servicio"];

$respuestaServicios = ControladorServicio::CtrMostrarServicio($itemServicio, $valorServicio);

$TotalPagar = number_format($respuestaServicios["precio"],2);
$importe = number_format($respuestaCobro["importe"],2);
$cambio = number_format($respuestaCobro["cambio"],2);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaCobro["cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DE LA EMPRESA

$itemEmpresa = "id";
$valorEmpresa = 1;

$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaCobro["vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');

//---------------------------------------------------------

$bloque1 = <<<EOF

<table style="font-size:9px; text-align:center">

	<tr>
		
		<td style="width:160px;">
	
			<div>
			
				Fecha: $fecha

				<br><br>
				$respuestaEmpresa[nombre]
				
				<br>
				$respuestaEmpresa[direccion]

				<br>
				$respuestaEmpresa[telefono]

				<br>
				$respuestaEmpresa[correo]

				<br>
				TICKET N.$respuestaCobro[folio]

				<br><br>					
				Cliente: $respuestaCliente[nombre]

				<br>
				Vendedor: $respuestaVendedor[nombre]

				<br>

			</div>

		</td>

	</tr>


</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------


$bloque2 = <<<EOF

<table style="font-size:9px;">

	<tr>
	
		<td style="width:160px; text-align:left">
		Mes pagado: $mes
		</td>

	</tr>

	<tr>
	
		<td style="width:160px; text-align:right">
		Costo de mensualidad: $TotalPagar
		<br>
		</td>

	</tr>

</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			 Neto:
		</td>

		<td style="width:80px;">
		   $ $TotalPagar
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 Pago con: 
		</td>

		<td style="width:80px;">
			$ $importe
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			 ----------------------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			 Cambio: 
		</td>

		<td style="width:80px;">
			$ $cambio
		</td>

	</tr>

	<tr>
	
		<td style="width:145px;">
			<br>
			<br>
			Muchas gracias por su preferencia
		</td>

	</tr>

</table>



EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$Ticket = new imprimirTicket();
$Ticket -> codigo = $_GET["codigo"];
$Ticket -> traerImpresionTicket();

?>