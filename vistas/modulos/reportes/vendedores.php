<?php 

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

$arrayVendedores = array();
$arraylistaVendedores = array();


foreach ($ventas as $key => $valueVentas) {
	
	foreach ($usuarios as $key => $valueUsuarios) {
		
		if ($valueUsuarios["id"] == $valueVentas["id_vendedor"]) {
			#capturamos los vendedores en un array
			array_push($arrayVendedores, $valueUsuarios["nombre"]);
			#Capturamos los nombres y los valores netos en un mismo array
			$arraylistaVendedores = array($valueUsuarios["nombre"] => $valueVentas["neto"]);

		  #Sumamos los netos de cada vendedor
    foreach ($arraylistaVendedores as $key => $value) {
    
      $sumaTotalVendedores[$key] += $value;

    }
    
		}

	
	}
}

#Evitamos repetir nombre
$noRrepetirNombre = array_unique($arrayVendedores);
?>

<!--================================
=            VENDEDORES            =
=================================-->
  <!-- BAR CHART -->
            <div class="card card-success card-outline">

              <div class="card-header with-border">
                
                <h3 class="card-title">Vendedores</h3>
              
              </div>
              
              <div class="card-body">
                <div class="chart-responsive">
                  <canvas id="barChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
            <!-- /.card -->



<script>

	 var areaChartData = {
      labels  : [ 
      <?php foreach ($noRrepetirNombre as $key => $value): ?>
		   <?php echo json_encode($noRrepetirNombre[$key], JSON_NUMERIC_CHECK); ?>,
	  <?php endforeach ?>    
      		],
      datasets: [
        {
          label               : 'Ventas',
          backgroundColor     : '#A2E3ED',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php foreach ($noRrepetirNombre as $key => $value): ?>
		  
		   			<?php echo json_encode($sumaTotalVendedores[$value], JSON_NUMERIC_CHECK); ?>,      	      <?php endforeach ?>
		   ]
        },
      ]
    }
	 //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart1').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
  
    barChartData.datasets[0] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
</script>