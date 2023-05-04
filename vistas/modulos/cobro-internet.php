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
              <li class="breadcrumb-item active">Cobros</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">
            <!-- Datos del cliente -->
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">DATOS DE CLIENTE</h3>
              </div>
              
              
           <form role="form" method="post" enctype="multipart/form-data" class="formularioCobroInter">     

                <div class="card-body">


                  <?php
                
                    $item = "id";
                    $valor = $_GET["idClient"];

                    $servic = ControladorClientesI::ctrMostrarClientesI($item, $valor);
                  
                  echo ' <h5 class="text-uppercase"><b>Nombre:</b> '.$servic["nombre"].'</h5> 
                    <h5 class="text-uppercase"><b>Dirección:</b> '.$servic["direccion"].'</h5>
                    <h5 class="text-uppercase"><b>teléfono:</b> '.$servic["telefono"].'</h5> 
                    <input type="hidden" class="form-control input-lg" id="nuevoServicio" name="nuevoServicio" value="'.$servic["servicio"].'" step="any" required>';

                    $item = "id";
                    $valor = $servic["servicio"];

                    $servis = ControladorServicio::CtrMostrarServicio($item, $valor);
                    
                    echo ' <h5 class="text-uppercase"><b>Servicio:</b> '.$servis["nombre"].'</h5>';

                    $itemP = "id_cliente";
                    $valorP = $_GET["idClient"];

                    $MesesP = ControladorMeses::CtrMostrarMeses($itemP, $valorP);

                    $item = null;
                    $valor = null;

                     $pagos = ControladorPagos::CtrMostrarPagos($item, $valor);
                     if (!$pagos) {
                       echo '<input type="hidden" class="form-control" id="nuevoFolio" name="nuevoFolio" value="20001" readonly>';
                     }else {
                       foreach ($pagos as $key => $value) {
                         # code...
                       }
                       $folio = $value["folio"] + 1;

                       echo '<input type="hidden" class="form-control input-lg" id="nuevoFolio" name="nuevoFolio" value="'.$folio.'" required>';
                     }

                 ?>
                  
                </div>

              
            </div>
            <!-- /.card -->

            <!-- general form elements -->
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">PAGO DE SERVICIO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h2 class="text-uppercase"><b>TOTAL A PAGAR: $</b><?php echo $servis["precio"] ?>.00 </h2>
                <input type="hidden" name="nuevoPrecioPago" value="<?php echo $servis["precio"] ?>" id="nuevoPrecioPago">
                <input type="hidden" name="nuevoCliente" id="nuevoCliente" value="<?php echo $_GET["idClient"] ?>">
                <input type="hidden" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["id"];?>">

              </div>
              <!-- /.card-body -->
            </div>


          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-8">
            <!-- Form Element sizes -->
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h3 class="card-title">PAGOS DEL AÑO <?php echo date("Y") ?></h3>
              </div>
              <div class="card-body">

                <div class="row">

                  <div class="col-4">
                    
                    <?php 
                        
                        if ($MesesP["Enero"] != "Pendiente") {
                          echo '<h6 class="box-title ">Enero <span class="badge bg-cyan">'.$MesesP["Enero"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Enero <span class="badge bg-danger">'.$MesesP["Enero"].'</span></h6>';
                        }

                        if ($MesesP["Febrero"] != "Pendiente") {
                          echo '<h6 class="">Febrero <span class="badge bg-cyan"> '.$MesesP["Febrero"].'</span></h6>';
                        } else {
                          echo '<h6 class="">Febrero <span class="badge bg-danger">'.$MesesP["Febrero"].'</span></h6>';
                        }

                        if ($MesesP["Marzo"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Marzo <span class="badge bg-cyan"> '.$MesesP["Marzo"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Marzo <span class="badge bg-danger"> '.$MesesP["Marzo"].'</span></h6>';
                        }

                        if ($MesesP["Abril"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Abril <span class="badge bg-cyan"> '.$MesesP["Abril"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Abril <span class="badge bg-danger"> '.$MesesP["Abril"].'</span></h6>';
                        }
                      
                    ?>

                  </div>

                  <div class="col-4">
                    
                    <?php 
                        
                        if ($MesesP["Mayo"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Mayo <span class="badge bg-cyan"> '.$MesesP["Mayo"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Mayo <span class="badge bg-danger"> '.$MesesP["Mayo"].'</span></h6>';
                        }

                        if ($MesesP["Junio"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Junio <span class="badge bg-cyan"> '.$MesesP["Junio"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Junio <span class="badge bg-danger"> '.$MesesP["Junio"].'</span></h6>';
                        }

                        if ($MesesP["Julio"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Julio <span class="badge bg-cyan"> '.$MesesP["Julio"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Julio <span class="badge bg-danger"> '.$MesesP["Julio"].'</span></h6>';
                        }

                        if ($MesesP["Agosto"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Agosto <span class="badge bg-cyan"> '.$MesesP["Agosto"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Agosto <span class="badge bg-danger"> '.$MesesP["Agosto"].'</span></h6>';
                        }
                      
                    ?>                   

                  </div>

                  <div class="col-4">
                    
                    <?php 
                        
                        if ($MesesP["Septiembre"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Septiembre <span class="badge bg-cyan"> '.$MesesP["Septiembre"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Septiembre <span class="badge bg-danger"> '.$MesesP["Septiembre"].'</span></h6>';
                        }

                        if ($MesesP["Octubre"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Octubre <span class="badge bg-cyan"> '.$MesesP["Octubre"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Octubre <span class="badge bg-danger"> '.$MesesP["Octubre"].'</span></h6>';
                        }

                        if ($MesesP["Noviembre"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Noviembre <span class="badge bg-cyan"> '.$MesesP["Noviembre"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Noviembre <span class="badge bg-danger"> '.$MesesP["Noviembre"].'</span></h6>';
                        }

                        if ($MesesP["Diciembre"] != "Pendiente") {
                          echo '<h6 class="box-title text-uppercase">Diciembre <span class="badge bg-cyan"> '.$MesesP["Diciembre"].'</span></h6>';
                        } else {
                          echo '<h6 class="box-title text-uppercase">Diciembre <span class="badge bg-danger"> '.$MesesP["Diciembre"].'</span></h6>';
                        }
                      
                    ?> 

                    <br>

                  </div>

                </div>


                <div class="row">

                  <div class="col-2">
                    

                  </div>

                  


                  <div class="col-4">
                    
                    <div class="input-group mb-3">
                      
                      <div class="input-group-prepend">
                        
                       <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span> 
                       </div>
                       
                       <input type="text" class="form-control"  id="nuevaFecha" name="nuevaFecha" <?php echo 'value="'.date('d/m/Y').'"'; ?> readonly>

                      
                    </div>

                  </div>

                  <?php 

                    $array = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                  ?>

                  <div class="col-4 MesN">
                    
                    <div class="form-group">
                  
                      <div class="select2-purple">

                        <select class="select2" data-placeholder="Seleccionar mes a pagar" data-dropdown-css-class="select2-purple" name="nuevoMes" id="nuevoMes" style="width: 100%;">

                          <option></option>
                          <?php 

                            foreach ($array as $key => $value) {
                              
                              if ($MesesP[$value] != "Pagado") {
                                
                                echo'<option value="'.$value.'">'.$value.'</option>';

                              }

                            }  

                          ?>

                        </select>

                      </div>

                    </div>

                  </div>

                  <br>

                  <h4 class="text-center">Comentarios de pago</h4>
                 
                  <div class="input-group">
                 
                  <textarea id="summernote" class="form-control input-lg" rows="3" cols="20" name="NuevocomenPag" placeholder="Comentarios"></textarea>

                </div>

               


                <!--=====================================
                  ENTRADA INPUESTO Y TOTAL
              ======================================-->
              <div class="row">
                
                <div class="col-lg-8 col-xs-12">
                
                </div>


                <div class="col-lg-8 col-xs-8 col-xs-pull-2">
                  
                  <table class="table table-condensed">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Pago</th>
                        <th>Cambio</th>

                      </tr>

                    </thead>

                    <tbody>
                      
                      <tr>
                      
                      <td style="width:50%">

                        <div class="input-group mes">

                        <input type="number" class="form-control input-lg" min="0" id="nuevoPagoS" name="nuevoPagoS" nuevomes="<?php echo $listaMess; ?>" placeholder="0000">

                        <span class="input-group-text"><i class="fa fa-percent"></i></span>
                          
                        </div>
                       
                      </td>

                      <td style="width:50%">

                        <div class="input-group">

                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                        <input type="text" class="form-control input-lg" id="CambioPago" name="CambioPago" total="" value=""  readonly>
                         
                        </div>
                       
                      </td>

                    </tr>

                    </tbody>

                  </table>

                </div>

                <div class="col-lg-8 col-xs-12">

                  <div class="col-md-6 ">

                    <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-cart-plus"></i> Guardar pago</button> 

                  </div>    

                </div>

              </div>

              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!--/.col (right) -->
        </div>

        <?php 

          $guardarPago = new ControladorPagos();

          $guardarPago -> ctrCrearPago();

           
        ?>

       </form> 
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
