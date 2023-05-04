<?php

$item = null;
$valor = null;
$orden = "id";

$ventas = ControladorVentas::ctrSumaTotalVentas();

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor); 
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes); 

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

?>



<div class="col-12 col-sm-6 col-md-3 ">
  
  <div class="info-box ">
  
    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>

      <div class="info-box-content">
   
        <span class="info-box-text">Ventas</span>
   
          <span class="info-box-number">
                $<?php echo number_format($ventas["total"],2) ?>
   
          </span>
   
      </div>  
      <a href="ventas" class="small-box-footer">
        
        Màs info <i class="fas fa-arrow-circle-right"></i>

      </a>
  </div>

</div>
<!-- /.col -->
<div class="col-12 col-sm-6 col-md-3">
  
  <div class="info-box mb-3">

    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clipboard-list"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Categorías</span>
          <span class="info-box-number"><?php echo number_format($totalCategorias); ?></span>
      </div>
   <a href="categorias" class="small-box-footer">
        
        Màs info <i class="fas fa-arrow-circle-right"></i>

      </a>
  </div>
      

</div>

<div class="clearfix hidden-md-up"></div>

<div class="col-12 col-sm-6 col-md-3">
  
  <div class="info-box mb-3">
    
    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-user-plus"></i></span>

      <div class="info-box-content">
        
        <span class="info-box-text">Clientes</span>
        
        <span class="info-box-number"><?php echo number_format($totalClientes); ?></span>
      </div>
     <a href="clientes" class="small-box-footer">
          
          Màs info <i class="fas fa-arrow-circle-right"></i>

        </a>
  
  </div>
  

</div>

<div class="col-12 col-sm-6 col-md-3">
  
  <div class="info-box mb-3">
  
    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>

      <div class="info-box-content">
  
        <span class="info-box-text">Productos</span>
  
        <span class="info-box-number"><?php echo number_format($totalProductos); ?></span>
     
      </div>
     
     <a href="productos" class="small-box-footer">
        
        Màs info <i class="fas fa-arrow-circle-right"></i>

      </a>

  </div>

</div>
