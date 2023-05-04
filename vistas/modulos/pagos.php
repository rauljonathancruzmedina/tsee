<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar cobros de internet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Internet</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header card-primary card-outline">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">id</th>
                    <th>Folio</th>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>P/Servicio</th>
                    <th>Mes</th>
                    <th>Comentarios</th>
                    <th>Fecha</th>
                    <th>Opciones</th>

                  </tr>
                  </thead>
                  <tbody>
                 
                    <?php 

                      $item = null;
                      $valor = null;

                      $respuestaPagos = ControladorPagos::CtrMostrarPagos($item, $valor);

                      foreach ($respuestaPagos as $key => $value) {
                        
                        $itemCliente = "id";
                        $valorCliente = $value["cliente"];

                        $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                        $itemServicio = "id";
                        $valorServicio = $value["servicio"];

                        $respuestaServicio = ControladorServicio::CtrMostrarServicio($itemServicio ,$valorServicio);

            echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["folio"].'</td>
                    <td>'.$respuestaCliente["nombre"].'</td>
                    <td>'.$respuestaServicio["nombre"].'</td> 
                    <td>'.$respuestaServicio["precio"].'</td> 
                    <td>'.$value["mes"].'</td> 
                    <td>'.$value["comentarios"].'</td>
                    <td>'.$value["fecha"].'</td> 
                  
                    <td>

                      <div class="btn-group">

                        <button class="btn btn-info btnImpriTick" idTick="'.$value["id"].'"><i class="fas fa-print" title="Imprimir ticket"></i></button>

                        <button class="btn btn-warning btnImpriBoleta" idBoleta="'.$value["id"].'" title="Imprimir boleta"><i class="fas fa-file-pdf"></i></button>';

                        if ($_SESSION["perfil"] == "Administrador") {

                         echo' <button class="btn btn-danger btnEliminarPago" idPago="'.$value["id"].'" title="Eliminar pago"><i class="fa fa-trash"></i></button>';

                        }  

                      echo'</div>  

                    </td>

                  </tr>';

                      }

                    ?>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php
  
  $borrarPago = new ControladorPagos();
  $borrarPago -> ctrBorrarPago();

?>

      <?php 

        $TicketPago = new ControladorPagos();
        $TicketPago -> ticket();

       ?>