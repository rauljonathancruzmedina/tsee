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

class imprimirFacturaPago{

public $codigo;

public function traerImpresionFacturaPago(){

//TRAEMOS LA INFORMACIÓN DEL PAGO

$itemPago = "id";
$valorPago = $this->codigo;

$respuestaPago = ControladorPagos::CtrMostrarPagos($itemPago, $valorPago);

$fecha = substr($respuestaPago["fecha"],0,-8);
$importe = number_format($respuestaPago["importe"],2);
$cambio = number_format($respuestaPago["cambio"],2);
$folio = $respuestaPago["folio"];

$comentarios = $respuestaPago["comentarios"];
$impuesto = number_format($respuestaPago["impuesto"],2);
$total = number_format($respuestaPago["total"],2);

$itemSer = "id";
$valorSer = $respuestaPago["servicio"];

$servic = ControladorServicio::CtrMostrarServicio($itemSer, $valorSer);
 $pre = number_format($servic["precio"],2);


//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaPago["cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaPago["vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

//TRAEMOS LA INFORMACIÓN DE LA EMPRESA

$itemEmpresa = "id";
$valorEmpresa = 1;
$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

$nombreEm = $respuestaEmpresa["nombre"];  
$direccionEm = $respuestaEmpresa["direccion"]; 
$correoEm = $respuestaEmpresa["correo"]; 
$telefonoEm = $respuestaEmpresa["telefono"];
$logoEM = $respuestaEmpresa["foto"];
//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdfPago = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdfPago -> setPrintHeader(false);
$pdfPago->startPageGroup();

$pdfPago->AddPage();

// ---------------------------------------------------------

$bloque1 = <<<EOF

	 <table >

        <tr>    

            <td style="width:140px"><img src="../../../$logoEM"  width="120"
             height="110"></td>
            
             <td style="background-color:white; width:340px">
                <div style="font-size:17px; line-heigth:15px">

                <label text-aling:center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $nombreEm </label>
                    
                </div>

                <div style="font-size:11px; text-aling:right; line-heigth:15px">

                    Correo: $correoEm

                    <br>
                    Teléfono: $telefonoEm

                    <br>
                    
                    Dirección: $direccionEm


                </div>

            </td>

            <td style="background-color:white; width:80px; text-align:center; color:red"><br>BOLETA N. $respuestaPago[folio]<br>
			</td>

        </tr>
        <tr>

            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style=" background-color:white; width:100px text-align:center"></td>

            <td style=" color:#333; background-color:white; width:100px text-align:center"></td>
    
        </tr>

     </table>

EOF;

$pdfPago->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

$bloque2 = <<<EOF
	
	<table>

		<tr>

			<td style="width:540px"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
		
		<tr> 

			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:100px; text-align:center">

				Apartado

			</td>
			<td style="border: 1px solcodigo #666; background-color:#26a69a; text-align:center; width:160px">
				 Vendedor
			 </td>
			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:160px; text-align:center">
			
				Cliente


			</td>

			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:120px; text-align:center">
			
				Fecha 

			</td>

		</tr>


		<tr>
			
			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">

				MENSUALIDAD
				
			</td>

			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center">

			 $respuestaVendedor[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:160px; text-align:center">

				$respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:120px; text-align:center">
			
				$fecha

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdfPago->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:260px; text-align:center">Servicio</td>
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:80px; text-align:center">Mes</td>
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:100px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:100px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdfPago->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$servic[nombre]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$respuestaPago[mes]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$pre
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
				$pre
			</td>


		</tr>

	</table>


EOF;

$pdfPago->writeHTML($bloque4, false, false, false, false, '');


// ---------------------------------------------------------

$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:#26a69a; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $pre
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:#26a69a; width:100px; text-align:center">
				Impuesto:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $impuesto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:#26a69a; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>

		<tr>
			<br>
			<br>
			<td style="border: 0px solid #666; color:#333; background-color:#bdbdbd; width:540px; text-align:center">
				COMENTARIOS:
			</td>
			
		</tr>
		<tr>
			<td style="border: 0px solid #666; color:#333; background-color:white;height:40px; width:540px; ">
				$comentarios
			</td>
		</tr>

		<tr>

			<td>

			<div style="font-size:22px; text-align:center; line-height:15px;">
			<h4 class="label_gracias">¡Gracias por su preferencia!</h4>
			</div>

			</td>

		</tr>

	</table>


EOF;

$pdfPago->writeHTML($bloque5, false, false, false, false, '');



$pdfPago->Output('pago.pdf', 'I');

}

}

$BoletaPago = new imprimirFacturaPago();
$BoletaPago -> codigo = $_GET["codigo"];
$BoletaPago -> traerImpresionFacturaPago();

?>