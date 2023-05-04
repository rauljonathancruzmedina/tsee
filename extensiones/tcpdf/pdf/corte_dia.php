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

public $fecha;

public $idUsuario;

public function traerImpresionFactura(){

//TRAEMOS LA INFORMACIÓN DEL VENDEDOR
$itemfecha = "fecha";
$valorfecha = $this->fecha;

$itemUsuario = "id";
$valorUsuario = $_GET['idUsuario'];


$respuestaUsuarios= ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

$nombreUs = $respuestaUsuarios["nombre"];

$itemEmpresa = "id";
$valorEmpresa = 1;
$respuestaEmpresa = ControladorEmpresa::ctrMostrarEmpresa($itemEmpresa, $valorEmpresa);

$nombreEm = $respuestaEmpresa["nombre"];  
$direccionEm = $respuestaEmpresa["direccion"]; 
$correoEm = $respuestaEmpresa["correo"]; 
$telefonoEm = $respuestaEmpresa["telefono"];
$logoEM = $respuestaEmpresa["foto"];
$DineroCaja = number_format($respuestaEmpresa["caja"],2);

//CORTE DEL DIA
$Cortefin = 0;
$netoFin = 0;
$DescuenFin = 0;
//REQUERIMOS LA CLASE TCPDF

date_default_timezone_set('America/Mexico_City');

$CorteA = substr(date("Y-m-d"), 0,4);
$CorteM = substr(date("Y-m-d"), 5,2);
$CorteD = substr(date("Y-m-d"), 8,2);

$fechaActual = substr(date("Y-m-d h:i:s A"), 0,22);

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->setPrintHeader(false);

$pdf->startPageGroup();


$pdf->setFooterData(array(0,64,0), array(0,64,128));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->AddPage();

//-----------------------------------PRIMER BLOQUE---------------------------------------

$bloque1 = <<<EOF

    <table >

        <tr>    

            <td style="width:140px"><img src="../../../$logoEM"  width="120"
             height="110"></td>
            
             <td style="background-color:white; width:325px">
                <div style="font-size:17px; text-align:center; line-heigth:15px">

                    $nombreEm
                    
                </div>

                <div style="font-size:11px; text-aling:right; line-heigth:15px">

                    Correo: $correoEm

                    <br>
                    Teléfono: $telefonoEm

                    <br>
                    
                    Dirección: $direccionEm


                </div>

            </td>

            <td style="background-color:white; width:95px text-align:center; color:red">
                    FOLIO<br> LC$CorteA$CorteM$CorteD
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





//---------------------------------SEGUNDO BLOQUE----------------------------------------
$bloque2 = <<<EOF

    <table>

        <tr>

            <td style="width:540px"></td>

        </tr>

    </table>

    <table  style="font-size:10px; padding:5px 10px;">

        <tr> 

            <td style="border: 1px solid #666; background-color:#26a69a; width:160px">Vendedor: $nombreUs</td>
            <td style="border: 1px solid #666; background-color:#26a69a; 
                width:160px"> Dínero en caja: $ $DineroCaja</td>

            <td style="border: 1px solid #666; background-color:#26a69a; width:220px; text-align:right">
            
                Fecha: $fechaActual

            </td>

        </tr>
        <tr>
            <td>
            </td>
        </tr>

    </table>

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
//---------------------------------SEGUNDO BLOQUE--------------------------------------

//---------------------------------TERCER BLOQUE-------------------------------------------

$bloque3 = <<<EOF

    <table style="font-size:10px; padding:5px 10px">

        <tr>

        <td style="border: 1px solid #666; background-color:#bdbdbd; width:230px; text-align:center">Producto</td>
        <td style="border: 1px solid #666; background-color:#bdbdbd; width:60px; text-align:center">U.M.</td>
        <td style="border: 1px solid #666; background-color:#bdbdbd; width:70px; text-align:center">Cantidad</td>
        <td style="border: 1px solid #666; background-color:#bdbdbd; width:90px; text-align:center">P.U.</td>
        <td style="border: 1px solid #666; background-color:#bdbdbd; width:90px; text-align:center">Valor Total</td>



        </tr>

    </table>


EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');

//---------------------------------TERCER BLOQUE-------------------------------------------

//---------------------------------CUARTO BLOQUE-------------------------------------------
//TRAEMOS LA INFORMACIÓN DE LA VENTA
$fechaInicial = substr($valorfecha, 0,11);
$fechaFinal = substr($valorfecha, 0,11);

$respuestaVenta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);




foreach ($respuestaVenta as $key => $item1) {
if($respuestaVenta != null){
$productos = json_decode($item1["productos"], true);
$neto = $item1["neto"];
$comentario =$item1["comentarios"];
$impuestos = $item1["impuesto"];
$totalVenta = $item1["total"];


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
$Cortefin= $totalVenta + $Cortefin;

$netoFin = $neto + $netoFin;

$DescuenFin = $impuestos + $DescuenFin;
}
}
$CorteFinal = number_format($Cortefin, 2);

$Netofinal = number_format($netoFin, 2);

$DescuentoFinal = number_format($DescuenFin, 2);
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

            <td style="border: 1px solid #666; background-color:#26a69a; width:100px text-align:center">
                Neto:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px text-align:center">
                $ $Netofinal
            </td>

        </tr>
        
        <tr>
            <td style="border-right: 1px solid #666; background-color:white; width:340px text-align:center">
            
            </td>

            <td style="border: 1px solid #666; background-color:#26a69a; width:100px text-align:center">
                Descuento:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px text-align:center">
                $ $DescuentoFinal
            </td>

        </tr>


        <tr>
            <td style="border-right: 1px solid #666; color:#333 background-color:white; width:340px text-align:center"></td>

            <td style="border: 1px solid #666; background-color:#26a69a; width:100px text-align:center">
                Total:
            </td>

            <td style="border: 1px solid #666; color:#333; background-color:white; width:100px text-align:center">
                $ $CorteFinal
            </td>

        </tr>
        

    </table>


EOF;


$pdf->writeHTML($bloque5, false, false, false, false, '');
//---------------------------------QUINTO BLOQUE-------------------------------------------
$pdf->Write(0, '', '', 0, 'C', 1, 0, false, false, 0);

/* SALIDA DEL ARCHIVO */
$pdf->Output('corte_dia.pdf');

}

}

$corte_dia = new imprimirFactura();
$corte_dia -> fecha = $_GET["fecha"];
$corte_dia -> traerImpresionFactura();

?>