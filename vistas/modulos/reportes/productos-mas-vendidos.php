<?php
  
  $item = null;
  $valor = null;
  $orden = "ventas";
 
  $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
 
  $product = array ();
  $des = array ();
  $ven = array ();
  $venta = array();
  $color = array("red", "green", "yellow", "aqua", "purple", "#d2d6de","#27e6df","#e627b3","##b87532","#52d180");
 
 foreach ($productos as $key => $value) {
   $descrip = substr($value["descripcion"],0,12);
   $vent = substr($value["ventas"],0);
   array_push($des, $descrip);
   array_push($ven, $vent);
 }

 for ($i=0; $i <10 ; $i++) { 
   array_push($product, $des[$i]);
   array_push($venta,$ven[$i]);
 }
 
 $totalVentas =ControladorProductos::ctrMostrarSumaVentas();

 ?>


<!-- DONUT CHART -->
<div class="card card-danger card-outline">
  
  <div class="card-header">
  
    <h3 class="card-title">Productos más vendidos</h3>
  
  </div>
  
  <div class="card-body">
    
        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
      
  </div>
  <br>
    <br>
  
  
    <ul class="list-group list-group-item">
      <?php 
      for ($i=0; $i <5 ; $i++) { 
        echo'<li class="list-group-item">
        
        <a href="#">
          
          '.$productos[$i]["descripcion"].' 
          
          <span class="float-right text-'.$color[$i].'">
            
            <i class="fa fa-angle-down"></i> 

              '.ceil($productos[$i]["ventas"]*100/$totalVentas["total"]).'%

              </span>
        
        </a>

        </li>';
      }

      ?>

    </ul>
    <br>
    
 </div>

<script >
  
//-------------       
$(function () {  
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
   
      labels: [
       <?php foreach ($product as $key => $value): ?>
      
         <?php echo json_encode($product[$key], JSON_NUMERIC_CHECK); ?>,
      
       <?php endforeach ?>
      ],

      datasets: [
        { 
          data:<?php echo json_encode($venta, JSON_NUMERIC_CHECK); ?>,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de','#27e6df','#e627b3','##b87532','#52d180'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions,
    
    })
    })



</script>
