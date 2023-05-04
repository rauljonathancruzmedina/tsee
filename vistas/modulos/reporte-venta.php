<?php
  
  if ($_SESSION["perfil"] == "Vendedor" || $_SESSION["perfil"] == "Sub administrador") {
    
    echo '<script>

    window.location ="crear-venta";

     </script>';

  }

?>

<div class="content-wrapper">
    
  <section class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1>Reportes de ventas</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="home">Inicio</a></li>

            <li class="breadcrumb-item active text-danger">Reportes de ventas</li>

          </ol>

        </div>

      </div>

    </div>

  </section>

    <!-- Main content -->
  <section class="content">
    <div class="card card-warning card-outline">
    
      <div class="card-header">
        
        
        <button type="button" class="btn btn-success"  id="daterange-btn2">
            
            <span>
              <i class="far fa-calendar-alt"></i> Rango de fecha
            </span>
              <i class="fas fa-caret-down"></i>

          </button>
  
  
        <div class="card-tools pull-right">

          <?php

          if (isset($_GET["fechaInical"])) {
             echo '<a href="vistas/modulos/descargarReporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInical"].'&fechaFinal='.$_GET["fechaFinal"].'">';
          }else {
             echo '<a href="vistas/modulos/descargarReporte.php?reporte=reporte">';

          }
         

          ?> 
          <button class="btn btn-info" style="margin-top:5px">Descargar Reporte en Excel  </button>
          
          </a>

        </div>
          
      </div>
    
      <div class="card-body">
        <div class="row">
          
          <div class="col-lg-12 col-xs-12">
            
            <?php

            include "reportes/grafico-ventas.php";

            ?>

          </div>


          <div class="col-md-6 col-xs-12">
             <?php

            include "reportes/vendedores.php";

            ?>
            
          </div>

          <div class="col-md-6 col-xs-12">
            <?php

            include "reportes/compradores.php";

            ?>

          </div>

        </div>

      </div>
      

    </div>
      
  </section>

</div>
