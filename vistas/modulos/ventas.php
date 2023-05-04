
  
  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Administrar ventas</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Administrar Ventas</li>

            </ol>

          </div>

        </div>

      </div>

    </section>

    <section class="content">
      
     <div class="card card-outline card-primary">
       <div class="card-header">
          <?php 
            date_default_timezone_set('America/Mexico_City');

              $hoyCr = date("Y-m-d");

              $itemUsua ="id";
              $valorUsua = $_SESSION['id'];

              $respuestaUsua = ControladorUsuarios::ctrMostrarUsuarios($itemUsua, $valorUsua);
              
           ?>
          <div class="card-body row">
            
            <div class="col-md-2">
                    
              <button type="button" class="btn btn-outline-info btn-block crearVentaNew"><i class="fas fa-cart-plus"></i>Crear venta</button>

            </div>
              
            <div class="col-md-4">
                
              
            </div>

            <div class="col-lg-2">
                <?php

                  if (isset($_GET["fechaInicial"])) {
                    
                  echo '<a href="vistas/modulos/descargarReporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

                  }else{

                     echo '<a href="vistas/modulos/descargarReporte.php?reporte=reporte">';

                  }

                    ?>
                  <button class="btn btn-danger pull-right" style="margin-right: 5px">Exportar a Excel</button>

                  </a>
            </div>

            <div class="col-md-2">

               <button type="button" class="btn btn-outline-info btn-block " id="corteDelDia" fecha="<?php echo $hoyCr ?>" idUsuario=
                "<?php echo $respuestaUsua["id"] ?>"><i class="fas fa-coins"></i> Corte del dia</button>

            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-outline-info btn-block float-right pull-right" id="daterang-btn">
                
                <span>
                  <i class="far fa-calendar-alt"></i> Rango de fecha
                </span>
                  <i class="fas fa-caret-down"></i>

                </button>
            </div>

          </div>
          

       </div>
        
        <div class="card-body ">
          <table id="example1" class="table table-bordered table-striped dt-responsive tablaV" width="100%" >
            <thead>

            <tr >
              <th style="width:10px">id</th>
               <th >Código</th>
               <th >Cliente</th>
               <th >Vendedor</th>     
               <th >Comentarios</th>  
               <th >Forma de pago</th>               
               <th >Neto</th>               
               <th >Total</th>               
               <th >Fecha</th>               
               <th >Opciones</th>
            </tr>

            </thead>

              <tbody>

                <?php 
                  
                  if (isset($_GET["fechaInicial"])) {
                    
                    $fechaInicial = $_GET["fechaInicial"];
                    $fechaFinal = $_GET["fechaFinal"];
                    
                  } else {
                  
                    $fechaInicial = null;
                    $fechaFinal = null;  
                  }

                $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);
              
                foreach ($respuesta as $key => $value) {
          
                echo '<tr>
                  <td>'.($key+1).'</td>
          
                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);
          
                  echo '<td>'.$respuestaUsuario["nombre"].'</td>
          
                  <td>'.$value["comentarios"].'</td>
          
                  <td>'.$value["metodo_pago"].'</td>
          
                  <td>'.number_format($value["neto"],2).'</td>
          
                  <td>'.number_format($value["total"],2).'</td>
          
                  <td>'.$value["fecha"].'</td>

                  <td> <div class="btn-group">

                  <button class="btn btn-success btnImpriTickV" idTickV="'.$value["id"].'" title="Imprimir ticket"><i class="fas fa-print"></i></button>

                  <button class="btn btn-warning btnImprimirFactura" codigoVenta="'.$value["codigo"].'" title="Imprimir boleta"><i class="fas fa-file-pdf"></i></button>';
                  
                  if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {
                
                 echo ' <button class="btn btn-primary btnEditarVenta" idVenta="'.$value["id"].'" title="Editar venta"><i class="fas fa-pencil-alt"></i></button>';
                }
                  if ($_SESSION["perfil"] == "Administrador") {
                  
                  echo'<button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'" title="Eliminar venta"><i class="fa fa-trash"></i></button>';
                }
                  echo'</div>  
                  </td>
                </tr> 
                ';
                }
                ?>

                
              </tbody>

          </table>           

          <?php

            $eliminarVenta = new ControladorVentas();
            $eliminarVenta -> ctrEliminarVenta();

          ?>

        </div>
        
      </div>
      
    </section>
    
  </div>
  

