<?php 

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/empresa.controlador.php";
require_once "../../../modelos/empresa.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";


class imprimirFactura{

public $codigo;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DE LA VENTA

$itemVenta = "codigo";
$valorVenta = $this->codigo;

$respuestaVenta = ControladorVentas::ctrMostrarVentas($itemVenta, $valorVenta);

$fecha = substr($respuestaVenta["fecha"], 0, -8);
$productos = json_decode($respuestaVenta["productos"], true);
$neto = number_format($respuestaVenta["neto"], 2);
$comentario =$respuestaVenta["comentarios"];
$impuestos = number_format($respuestaVenta["impuesto"], 2);
$totalVenta = number_format($respuestaVenta["total"], 2);

//TRAEMOS LA INFORMACION DEL CLIENTE

$itemCliente = "id";
$valorCliente = $respuestaVenta["id_cliente"];

$respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR

$itemVendedor = "id";
$valorVendedor = $respuestaVenta["id_vendedor"];

$respuestaVendedor = ControladorUsuarios::ctrMostrarUsuarios($itemVendedor, $valorVendedor);

$itemEmpresa = "id";
$valorEmpresa = '1';
$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

$nombreEm = $respuestaEmpresa["nombre"];  
$direccionEm = $respuestaEmpresa["direccion"]; 
$correoEm = $respuestaEmpresa["correo"]; 
$telefonoEm = $respuestaEmpresa["telefono"];

//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->setPrintHeader(false);

$pdf->startPageGroup();


$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->AddPage();

//-----------------------------------PRIMER BLOQUE---------------------------------------

    
$pdf->ImageSVG($file='images/3410490.svg', $x=80, $y=-54, $w=40, $h=150, $link='', $align='', $palign='', $border='', $fitonpage=false);
$bloque0 = <<<EOF

    <table >

        <tr>

            <td style="background-color:white; width:320px">
                <div style="font-size:12px; text-aling:right; line-heigth:15px">

                    <br>
                    Empresa: $nombreEm
                    
                    <br>
                    <br>
                    Correo: $correoEm

                </div>

            </td>

            
            <td style="background-color:white; width:180px">

                <div style="font-size:12px; text-aling:right; line-heigth:15px">

                    <br>
                    Teléfono: $telefonoEm

                    <br>
                    <br>
                    
                    Dirección: $direccionEm

                </div>

            </td>

            <td style="background-color:white; width:100px text-align:center; color:red">
                    <br>FOLIO<br> $valorVenta
            </td>
    
        </tr>

        <tr>

            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style=" background-color:white; width:100px text-align:center"></td>

            <td style=" color:#333; background-color:white; width:100px text-align:center"></td>
    
        </tr>

     </table>


EOF;

$pdf->writeHTML($bloque0, false, false, false, false, '');




//---------------------------------PRIMER BLOQUE---------------------------------------

//---------------------------------SEGUNDO BLOQUE----------------------------------------
$bloque2 = <<<EOF

    <table>

        <tr>

            <td style="width:540px"></td>

        </tr>

    </table>

    <table  style="font-size:10px; padding:5px 10px;">

        <tr> 

            <td style="border: 1px solid #666; background-color:white; width:390px">
            
                Cliente: $respuestaCliente[nombre]

            </td>

            <td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
            
                Fecha: $fecha

            </td>

        </tr>

        <tr>

            <td style="border: 1px solid #666; background-color:white; width:540px">Vendedor: $respuestaVendedor[nombre]</td>

        </tr>

        <tr>

            <td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
//---------------------------------SEGUNDO BLOQUE--------------------------------------

//---------------------------------TERCER BLOQUE-------------------------------------------

$bloque3 = <<<EOF

    <table style="font-size:10px; padding:5px 10px">

        <tr>

        <td style="border: 1px solid #666; background-color:#F73A43; width:230px; text-align:center">Producto</td>
        <td style="border: 1px solid #666; background-color:#F73A43; width:60px; text-align:center">U.M.</td>
        <td style="border: 1px solid #666; background-color:#F73A43; width:70px; text-align:center">Cantidad</td>
        <td style="border: 1px solid #666; background-color:#F73A43; width:90px; text-align:center">P.U.</td>
        <td style="border: 1px solid #666; background-color:#F73A43; width:90px; text-align:center">Valor Total</td>



        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

//---------------------------------TERCER BLOQUE-------------------------------------------

//---------------------------------CUARTO BLOQUE-------------------------------------------
foreach ($productos as $key => $item) {

$itemProducto = "descripcion";
$valorProducto = $item["descripcion"];
$orden = null;

$respuestaProductos = ControladorProductos::ctrMostrarProductos($itemProducto, $valorProducto, $orden);


$medidaF = $respuestaProductos["medida"];


$bloque4 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:230px text-align:center">
                $item[descripcion]
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:60px text-align:center">
                $medidaF
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:70px text-align:center">
                $item[cantidad]
            </td>           

            <td style="border: 1px solid #666; color:#333; background-color:white; width:90px text-align:center">$
                $item[precio]
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:90px text-align:center">$
                $item[total] 
            </td>

        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque4, false, false, false, false, '');
}
//---------------------------------CUARTO BLOQUE-------------------------------------------

//---------------------------------QUINTO BLOQUE-------------------------------------------

$bloque5 = <<<EOF

    <table style="font-size:10px; padding:5px 10px;">

        <tr>

            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>

            <td style="border-bottom: 1px solid #666; background-color:white; width:100px text-align:center"></td>

            <td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px text-align:center"></td>

        </tr>

        <tr>
            <td style="border-right: 1px solid #666; background-color:white; width:340px text-align:center">
            
            </td>

            <td style="border: 1px solid #666; background-color:#7FB9ED; width:100px text-align:center">
                Neto:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px text-align:center">
                $ $neto
            </td>

        </tr>
        
        <tr>
            <td style="border-right: 1px solid #666; background-color:white; width:340px text-align:center">
            
            </td>

            <td style="border: 1px solid #666; background-color:#7FB9ED; width:100px text-align:center">
                Descuento:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px text-align:center">
                $ $impuestos
            </td>

        </tr>


        <tr>
            <td style="border-right: 1px solid #666; color:#333 background-color:white; width:340px text-align:center"></td>

            <td style="border: 1px solid #666; background-color:#7FB9ED; width:100px text-align:center">
                Total:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px text-align:center">
                $ $totalVenta
            </td>

        </tr>
        

    </table>


EOF;


$pdf->writeHTML($bloque5, false, false, false, false, '');
//---------------------------------QUINTO BLOQUE-------------------------------------------
$pdf->Write(0, '', '', 0, 'C', 1, 0, false, false, 0);
$pdf->Write(0, 'Tu gran amigo, tu gran aliado', '', 0, 'C', 1, 0, false, false, 0);
$pdf->Write(0, 'Para construir tus sueños.!', '', 0, 'C', 1, 0, false, false, 0);

/* SALIDA DEL ARCHIVO */
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>