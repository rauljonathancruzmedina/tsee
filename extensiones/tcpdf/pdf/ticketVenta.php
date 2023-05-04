<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

class imprimirTicket{

public $codigoV;

public function traerImpresionTicket(){

$itemVenta = "id";
$valorVentas = $this->codigoV;

$respuestaVentas = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVentas);

$productos = json_decode($respuestaVentas["productos"], true);
$total = number_format($respuestaVentas["total"],2);
$importe = number_format($respuestaVentas["importe"],2);
$neto = number_format($respuestaVentas["neto"],2);
$descuento =number_format( $respuestaVentas["neto"]-$respuestaVentas["total"],2);
$fecha = substr($respuestaVentas["fecha"], 0, -8);

//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVentas["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DE LA EMPRESA

$itemEmpresa = "id";
$valorEmpresa = 1;

$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVentas["id_vendedor"];

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
				Venta N.$respuestaVentas[codigo]

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

	foreach ($productos as $key => $item) {

	$valorUnitario = number_format($item["precio"], 2);

	$precioTotal = number_format($item["total"], 2);	

	$bloque2 = <<<EOF

		<table style="font-size:9px;">
			<hr>
			<tr>

				<td style="width:160px; text-align:left">

					$item[descripcion]

				</td>

			</tr>

			<tr>

				<td style="width:160px; text-align:right">

					$ $valorUnitario Und * $item[cantidad] = $ $precioTotal
					<br>
				</td>

			</tr>

		</table>

	EOF;

	$pdf->writeHTML($bloque2, false, false, false, false, '');

}	

// ---------------------------------------------------------

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:60px;">
			 
		</td>

		<td style="width:100px; text-align:left">
		  Neto: $ $neto
		</td>

	</tr>

	<tr>

		<td style="width:60px;">
			 
		</td>

		<td style="width:100px; text-align:left">
		  Descuento: $ $descuento
		</td>

	</tr>

	<tr>

		<td style="width:60px;">
			 
		</td>
		
		<td style="width:100px; text-align:left">
		  Total: $ $total
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
$Ticket -> codigoV = $_GET["codigoV"];
$Ticket -> traerImpresionTicket();

?>