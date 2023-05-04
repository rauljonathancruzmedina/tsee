<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Historial de pagos atrasados</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Pagos atrasados</li>
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

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">id</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Servicio</th>
                    <th>Meses vencidos</th>
                    <th>Opciones</th>

                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php 

                      $mesActual = date("n");

                      $mesTotal = $mesActual + 1;

                      $array = array("","","Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                      $item = null;
                      $valor = null;

                      $respuestaClient = ControladorClientesI::ctrMostrarClientesI($item, $valor);

                      foreach ($respuestaClient as $key => $value) {

                        if ($value["contratacion"] != null) {
                          
                          $respuestaServ = ControladorServicio::CtrMostrarServicio("id", $value["servicio"]);

                          echo ' <tr>
                                <td>'.($key+1).'</td>
                                <td>'.$value["nombre"].'</td>
                                <td>'.$value["direccion"].'</td>
                                <td>'.$value["telefono"].'</td>
                                <td>'.$respuestaServ["nombre"].'</td>';

                          $itemMes = "id_cliente";
                          $valorMes = $value["id"];

                          $mostrarMes = ControladorMeses::CtrMostrarMeses($itemMes, $valorMes);
                          
                          echo'<td>';

                            for ($i=2; $i < $mesTotal; $i++) { 
                                        
                                if ($mostrarMes[$array[$i]] != "Pagado") {
                                  
                                  echo '<button class="btn btn-danger btn-xs">'.$array[$i].'</button> &nbsp;';

                                }

                            }  

                          echo'</td>
                          <td>

                            <div class="btn-group">

                            <button class="btn btn-warning btnCobrarClientI" idClientI="'.$value["id"].'" title="Cobro mensualidad"><i class="ion ion-social-usd"></i></button>

                            </div>  

                          </td>';


                            
                                
                          echo ' </tr>';


                        }

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