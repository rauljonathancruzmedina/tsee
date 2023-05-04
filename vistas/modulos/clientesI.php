
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar clientes de internet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Home</a></li>
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

            <div class="card card-primary card-outline">
              <div class="card-header">
              
                <div class="card-body row">
            
                  <div class="col-md-3">
                    <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalClienteInt"><i class="fa fa-users"></i> Agregar cliente</button>
                  </div>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">id</th>
                    <th>Nombre</th>
                    <th>Servicio</th>
                    <th>Precio</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Fecha pago</th>
                    <th>Opciones</th>
                  </tr>
                  </thead>
                  <tbody>


                  <?php

                      $item = null;
                      $valor = null;

                      $clientes = ControladorClientesI::ctrMostrarClientesI($item, $valor);

                    foreach ($clientes as $key => $value) {
                      
                      if ($value["servicio"] != null) {
                      
                        echo '<tr>
                               <td>'.($key+1).'</td>
                               <td class="text-uppercase">'.$value["nombre"].'</td>';

                          $item = "id";
                          $valor = $value["servicio"];

                          $servic = ControladorServicio::CtrMostrarServicio($item, $valor);

                            echo '<td class="text-uppercase">'.$servic["nombre"].'</td>
                              <td class="text-uppercase">$'.number_format($servic["precio"],2).'</td>';

                               echo '<td>'.$value["telefono"].'</td>
                               <td class="text-uppercase">'.$value["direccion"].'</td>
                               <td>'.$value["mensualidad"].'</td>

                        <td>

                              <div class="btn-group">

                              <button class="btn btn-warning btnCobrarClientI" idClientI="'.$value["id"].'" title="Cobro mensualidad"><i class="ion ion-social-usd"></i></button>';
                                  
                              if($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador"){

                                echo '<button class="btn btn-primary btnEditarClientI" data-toggle="modal" data-target="#modalEditClienteI" idClientI="'.$value["id"].'" title="Editar cliente"><i class="fa fa-pencil-alt"></i></button> 

                                <button class="btn btn-success btnEliminarPagoC" idPagoCl="'.$value["id"].'" title="Reiniciar historial"><i class="fas fa-sync-alt"></i></button>';

                              }  
                                      
                              if($_SESSION["perfil"] == "Administrador"){

                                echo'<button class="btn btn-danger btnEliminarClientI" idClientI="'.$value["id"].'" title="Eliminar cliente"><i class="fa fa-trash"></i></button>';

                              }
                                      

                              echo'</div>  

                            </td>

                        </tr>';

                        

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



   <!-- =========================================
          MODAL AGREGAR CLIENTE
  ========================================= -->

  <div class="modal fade" id="modalClienteInt">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Agregar clientes</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

    <form role="form" method="post" enctype="multipart/form-data">

      <div class="modal-body">

          <!-- =========================================
                        NOMBRE DE CLIENTE
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <input type="text" class="form-control" name="nuevClientI" placeholder="Ingresar nombre completo" required>

          </div>
          <!-- =========================================
                            TELEFONO Y DIRECCION
          ========================================= -->
    
            <div class="input-group mb-3">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" name="nuevTelClientI" placeholder="Ingresar teléfono" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              
            </div>
            
            <!-- =========================================
                        DIRECCION
          ========================================= -->

            <div class="input-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                </div>
                <input type="text" class="form-control" name="nuevaDireccionI" placeholder="Ingresar dirección " required>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->

           <!-- =========================================
                        SELECT DE SERVICIO
          ========================================= --> 

          <div class="form-group">

            <select class="form-control select2" data-placeholder="Selecione servicio" data-dropdown-css-class="select2-purple" style="width: 100%;" name="nuevoServicioI">

              <option></option>

              <?php 

                $item = null;
                $valor = null;

                $respuesta = ControladorServicio::CtrMostrarServicio($item, $valor);

                  foreach ($respuesta as $key => $value) { 
                    
                   echo' <option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                 } 

              ?> 

            </select>

          </div>   

          <div class="row">
            <div class="col-lg-6">

              
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="nuevaFechaCont" max="01-05-2022">
                </div>
                <!-- /.input group -->
              </div>

              
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
              
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="nuevaFechaMes">
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <!-- /.col-lg-6 -->
          </div>  



        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      
      </div>
    
    </form>
    
      <?php 
        $crearCli = new ControladorClientesI();
        $crearCli -> ctrCrearClienteI();
      ?>

      </div>
      
    </div>
    
  </div>


  <!-- =========================================
          MODAL EDITAR CLIENTE
  ========================================= -->

  <div class="modal fade" id="modalEditClienteI">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Editar clientes</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

    <form role="form" method="post" enctype="multipart/form-data">

      <div class="modal-body">

          <!-- =========================================
                        NOMBRE DE CLIENTE
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <input type="text" class="form-control" name="editaClientI" id="editaClientI" required>

            <input type="hidden" name="idClienI" id="idClienI">

          </div>
          <!-- =========================================
                            TELEFONO Y DIRECCION
          ========================================= -->
    
            <div class="input-group mb-3">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" name="editaTelClientI" id="editaTelClientI" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              
            </div>
            
            <!-- =========================================
                        DIRECCION
          ========================================= -->

            <div class="input-group mb-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                </div>
                <input type="text" class="form-control" name="editaDireccionI" id="editaDireccionI" required>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->

           <!-- =========================================
                        SELECT DE SERVICIO
          ========================================= --> 

          <div class="form-group">

            <select class="form-control select2" data-dropdown-css-class="select2-purple" style="width: 100%;" name="editaServicioI">

              <option value="" id="editaServicioI"></option> 

              <?php 

                $item = null;
                $valor = null;

                $respuesta = ControladorServicio::CtrMostrarServicio($item, $valor);

                  foreach ($respuesta as $key => $value) { 
                    
                   echo' <option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                 } 

              ?> 

            </select>

          </div>   

          <div class="row">
            <div class="col-lg-6">

              
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="editaFechaCont" id="editaFechaCont" max="01-05-2022" readonly>
                </div>
                <!-- /.input group -->
              </div>

              
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
              
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-check"></i></span>
                  </div>
                  <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask name="editaFechaMes" id="editaFechaMes">
                </div>
                <!-- /.input group -->
              </div>

            </div>
            <!-- /.col-lg-6 -->
          </div>  



        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      
      </div>
    
    </form>
    
      <?php 
        $EditCli = new ControladorClientesI();
        $EditCli -> ctrEditarClienteI();
      ?>

      </div>
      
    </div>
    
  </div>


  <!-- =========================================
              BORRAR CLIENTE
  ========================================= -->

  <?php 

    $BorraCli = new ControladorClientesI();
    $BorraCli -> ctrEliminarClienteI();

  ?>

  <?php 

  $actualizarMese = new ControladorPagos();
  $actualizarMese -> ctrBorrarTodPagos();  

 ?>