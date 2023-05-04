<div class="content-wrapper">

<section class="content-header">

  <div class="container-fluid">

    <div class="row mb-2">

      <div class="col-sm-6">

        <h1>Inicio</h1>

      </div>

      <div class="col-sm-6">

        <ol class="breadcrumb float-sm-right">

          <li class="breadcrumb-item"><a href="home">Inicio</a></li>

          <li class="breadcrumb-item active">Vista Inicio</li>

        </ol>

      </div>

    </div>

  </div><!-- /.container-fluid -->

</section>

<section class="content">
  
  <div class="row">
  
  <?php

  if ($_SESSION["perfil"] == "Administrador") {
    
    include "inicio/cajas-superiores.php";

  }
  
  ?>

  </div>

  <div class="row">
       
    <div class="col-lg-6">
      <?php

      include "reportes/productos-mas-vendidos.php";

      ?>

    </div>


    <div class="col-lg-6">
      <?php
      
      include "inicio/productos-recientes.php";

      ?>

    </div>

   

  </div>

</section>

</div>


