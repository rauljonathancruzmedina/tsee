<?php 

$item = null;
$valor = null;

$ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

$arrayClientes = array();
$arraylistaClientes = array();


foreach ($ventas as $key => $valueVentas) {
  
  foreach ($clientes as $key => $valueClientes) {
    
    if ($valueClientes["id"] == $valueVentas["id_cliente"]) {
      #capturamos los Clientes en un array
      array_push($arrayClientes, $valueClientes["nombre"]);
      #Capturamos los nombres y los valores netos en un mismo array
      $arraylistaClientes = array($valueClientes["nombre"] => $valueVentas["neto"]);
       #Sumamos los netos de cada vendedor
    foreach ($arraylistaClientes as $key => $value) {
    
      $sumaTotalClientes[$key] += $value;

    }
      
    }
  }
}

#Evitamos repetir nombre
$noRrepetirNombre = array_unique($arrayClientes);
?>


<!--================================
=            VENDEDORES            =
=================================-->
<!-- BAR CHART -->
<div class="card card-purple card-outline">

  <div class="card-header with-border">
    
    <h3 class="card-title">Compradores</h3>
  
  </div>
  
  <div class="card-body">

    <div class="chart-responsive">

      <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>

    </div>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->



<script>

	 var areaChartData = {
      labels  : [<?php foreach ($noRrepetirNombre as $key => $value): ?>
       <?php echo json_encode($noRrepetirNombre[$key], JSON_NUMERIC_CHECK); ?>,
    <?php endforeach ?> ],
      datasets: [
        {
          label               : 'Compradores',
          backgroundColor     : '#215763',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php foreach ($noRrepetirNombre as $key => $value): ?>
            <?php echo json_encode($sumaTotalClientes[$value], JSON_NUMERIC_CHECK); ?>,             <?php endforeach ?>
            ]
        },
      ]
    }
	 //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart2').get(0).getContext('2d')
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