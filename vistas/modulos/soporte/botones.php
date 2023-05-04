<?php 

  $msjElimina = 0;

  $msjReci = ControladorSoporte::ctrMostrarTickets("receptor", $_SESSION["id"]);

  $totalMsjRecib = 0;

  foreach ($msjReci as $key => $value) {
    
    if ($value["tipo"] == "papelera") {
      
        $papelera = json_decode($value["papelera"], true);

        if (count($papelera) == 1) {
          
            if ($papelera[0] == $_SESSION["id"]) {
              
                --$totalMsjRecib;            
                ++$msjElimina;

            }

        }    

          if (count($papelera) == 2) {
          
            if ($papelera[0] == $_SESSION["id"] || $papelera[1] == $_SESSION["id"]) {
              
                --$totalMsjRecib;            
                ++$msjElimina;

            }

          }

    }

    ++$totalMsjRecib;

  }


  $msjEnvia= ControladorSoporte::ctrMostrarTickets("remitente", $_SESSION["id"]);

  $totalMsjEnvia = 0;

  foreach ($msjEnvia as $key => $value) {
    
    if ($value["tipo"] == "papelera") {
      
        $papelera = json_decode($value["papelera"], true);

        if (count($papelera) == 1) {
          
            if ($papelera[0] == $_SESSION["id"]) {
              
                --$totalMsjEnvia;  
                ++$msjElimina;          

            }

        }    

        if (count($papelera) == 2) {
        
          if ($papelera[0] == $_SESSION["id"] || $papelera[1] == $_SESSION["id"]) {
            
              --$totalMsjEnvia; 
              ++$msjElimina;           

          }

        }

    }    

    ++$totalMsjEnvia;

  }

 ?>


<a href="soporte" class="btn btn-primary btn-block mb-3">Crear mensaje</a>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Carpetas</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="card-body p-0">

    <ul class="nav nav-pills flex-column">

      <li class="menuReci"><a href="index.php?ruta=soporte&soporte=msg-recibidos" class="nav-link"><i class="fas fa-inbox"></i> Recibidos

          <span class="badge bg-primary float-right"><?php echo $totalMsjRecib; ?></span>

        </a>

      </li>

      <li class="nav-item">
        <a href="index.php?ruta=soporte&soporte=msg-enviados" class="nav-link menuEnvi">
          <i class="far fa-envelope"></i> Enviados
          <span class="badge bg-primary float-right"><?php echo $totalMsjEnvia; ?></span>
        </a>
      </li>

      <li class="menuEli">
        <a href="index.php?ruta=soporte&soporte=papelera" class="nav-link">
          <i class="far fa-trash-alt"></i> Eliminados
          <span class="badge bg-danger float-right"><?php echo $msjElimina; ?></span>
        </a>
      </li>
      
    </ul>
  </div>
  <!-- /.card-body -->
</div>