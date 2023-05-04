<?php

require_once "../../../controladores/service.controlador.php";
require_once "../../../modelos/service.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

class imprimirOrdenServicio{

public $codigo;

public function traerImpresionOrdenServicio(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemCot = "codigo";
$valorCot = $this->codigo;

$respuestaOrdenS = ControladorService::ctrMostrarOrdenService($itemCot, $valorCot);

$fecha = substr($respuestaOrdenS["fecha"],0,-8);
$CodigoS = $respuestaOrdenS["codigo"];
$productos = json_decode($respuestaOrdenS["productos"], true);
$servicios = json_decode($respuestaOrdenS["servicios"], true);
$neto = number_format($respuestaOrdenS["neto"],2);
$total = number_format($respuestaOrdenS["total"],2);
$comentarios = $respuestaOrdenS["comentarios"];


//TRAEMOS LA INFORMACIÓN DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaOrdenS["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

$itemVendedor = "id";

$valorVendedor = $respuestaOrdenS["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

$itemTecnico = "id";

$valorTecnico = $respuestaOrdenS["id_tecnico"];

$respuestaTecnico = ControladorUsuarios::ctrMostrarUsuarios($itemTecnico, $valorTecnico);



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

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);

$pdf->startPageGroup();


$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->AddPage();

// ---------------------------------------------------------


$bloque1 = <<<EOF

    <table >

        <tr>    

            <td style="width:160px"><img src="../../../$logoEM"  width="120"
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

            <td style="background-color:white; width:90px text-align:center; color:red">
                    <br>  FOLIO <br> SER$CodigoS
            </td>

        </tr>

        

        <tr>

            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style=" background-color:white; width:100px text-align:center"></td>

            <td style=" color:#333; background-color:white; width:100px text-align:center"></td>
    
        </tr>

     </table>


EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');


// ---------------------------------------------------------

$bloque2 = <<<EOF
	
	<table>

		<tr>

			<td style="width:540px"></td>

		</tr>

	</table>

	<table style="font-size:10px; padding:5px 10px;">
		
		<tr> 

			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:70px; text-align:center">

				Apartado

			</td>
			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:130px; text-align:center">

				Tecnico

			</td>
			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:130px; text-align:center;">
				 Vendedor
			 </td>
			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:130px; text-align:center">
			
				Cliente


			</td>

			<td style="border: 1px solcodigo #666; background-color:#26a69a; width:80px; text-align:center">
			
				Fecha 

			</td>

		</tr>

		<tr>
			<td style="border: 1px solid #666; background-color:white; width:70px; text-align:centerx">

			SOPORTE

			</td>

			<td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">

			$respuestaTecnico[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">

			$respuestaVendedor[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:130px; text-align:center">

			$respuestaCliente[nombre]

			</td>

			<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">
			
				$fecha

			</td>

		</tr>

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------


$bloque3 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:260px; text-align:center">Servicio</td>
		
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:280px; text-align:center">Costo.</td>
	
		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($servicios as $key => $item) {

	$itemServicio = "id";
	$valorServicio = $item["id"];

	$respuestaServicio = ControladorService::ctrMostrarService($itemServicio, $valorServicio);
	
$bloque4 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
				$item[nombre]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:280px; text-align:center">
				$item[precio]
			</td>

		</tr>

		
	</table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');


}
// ---------------------------------------------------------
if ($productos != " " && $productos != null) {
$bloque5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		
		<td style="border-bottom: 1px solid #666; background-color:white; width:540px">

		</td>

		</tr>

		<tr>
		
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:230px; text-align:center">Producto</td>
		<td style="border: 1px solcodigo #666; background-color:#bdbdbd; width:60px; text-align:center">U.M.</td>
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:70px; text-align:center">Cantidad</td>
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:90px; text-align:center">Valor Unit.</td>
		<td style="border: 1px solid #666; background-color:#bdbdbd; width:90px; text-align:center">Valor Total</td>

		</tr>

	</table>

EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');

}
// ---------------------------------------------------------

if ($productos != " " && $productos != null) {


foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProducto = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque6 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:230px; text-align:center">
				$item[descripcion]
			</td>


			<td style="border: 1px solid #666; color:#333; background-color:white; width:60px; text-align:center">
				$respuestaProducto[medida]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:70px; text-align:center">
				$item[cantidad]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ 
				$valorUnitario
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:90px; text-align:center">$ 
				$precioTotal
			</td>


		</tr>

	</table>


EOF;

$pdf->writeHTML($bloque6, false, false, false, false, '');

}
}

// ---------------------------------------------------------

$bloque7 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center">

			</td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center">

			</td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center">
			
			</td>

			<td style="border: 1px solid #666;  background-color:#26a69a; width:100px; text-align:center">
				Neto:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $neto
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center">
			

			</td>

			<td style="border: 1px solid #666; background-color:#26a69a; width:100px; text-align:center">
				Total:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
				$ $total
			</td>

		</tr>
		
	</table>

	<table>
       
        <tr>
            <br>
            <td style="border: 1px solid #666; color:#333; background-color:#bdbdbd; width:540px; text-align:center">
                COMENTARIOS: 
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #666; color:#333; background-color:white; height:40px; width:540px; ">
                $comentarios
            </td>
        </tr>

    </table>


	<div style="font-size:18px; text-align:center; line-height:15px;">
		<h4 class="label_gracias">¡Gracias por confiar en nosotros!</h4>
	</div>

EOF;

$pdf->writeHTML($bloque7, false, false, false, false, '');



// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

$pdf->Output('Orden-Servicio.pdf', 'I');

}

}

$Cotizacion = new imprimirOrdenServicio();
$Cotizacion -> codigo = $_GET["codigo"];
$Cotizacion -> traerImpresionOrdenServicio();

?>