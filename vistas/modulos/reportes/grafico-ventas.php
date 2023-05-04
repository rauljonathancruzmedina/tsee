<?php


	 error_reporting(0);

	if (isset($_GET["fechaInicial"])) {

	$fechaInicial = $_GET["fechaInicial"];
	$fechaFinal = $_GET["fechaFinal"];

	} else {

	$fechaInicial = null;
	$fechaFinal = null;  
  
	}

	$respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

	$arrayFechas = array();

	$arrayVentas = array();

	$sumaPagosMes = array();

	$arrayDatos = array();

	foreach ($respuesta as $key => $value) {
		#Capturamos sólo el año y el mes
		$fecha = substr($value["fecha"], 0,7);

		#Introducir las fechas en arrayFechas
		array_push($arrayFechas, $fecha);

		#Capturamos las ventas
		$arrayVentas = array($fecha => $value["total"]);

		foreach ($arrayVentas as $key => $value) {
			$sumaPagosMes[$key] += $value;
		}
	}
	$noRepetirFechas = array_unique($arrayFechas);

?>

<!--=======================================
=            GRÁFICO DE VENTAS            =
========================================-->

<!-- Line chart -->
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-line"></i>
          Gráfico de ventas
        </h3>
      </div>
      <div class="card-body card-primary border-radius-none nuevoGraficoVentas">
        <div id="line-chart" style="height: 250px;"></div>
      </div>
      <!-- /.card-body-->
    </div>

<script>


  var line = new Morris.Line({
    element          : 'line-chart',
    resize           : true,
    data             : [

    <?php

    if($noRepetirFechas != null){

	    foreach($noRepetirFechas as $key){

	    	echo "{ y: '".$key."', ventas: ".$sumaPagosMes[$key]." },";


	    }

	    echo "{y: '".$key."', ventas: ".$sumaPagosMes[$key]." }";

    }else{

       echo "{ y: '0', ventas: '0' }";

    }

    ?>

    ],
    xkey             : 'y',
    ykeys            : ['ventas'],
    labels           : ['ventas'],
    lineColors       : ['#2F9AFF'],
    lineWidth        : 2,
    hideHover        : 'auto',
    gridTextColor    : '#000101',
    gridStrokeWidth  : 0.4,
    pointSize        : 4,
    pointStrokeColors: ['#086A87'],
    gridLineColor    : '#A5A4A5',
    gridTextFamily   : 'Open Sans',
    preUnits         : '$',
    gridTextSize     : 10

  });

</script>