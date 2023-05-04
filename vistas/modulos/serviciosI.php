<?php
  
  if ($_SESSION["perfil"] == "Vendedor") {
    
    echo '<script>

    window.location ="crear-venta";

     </script>';

  }

?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Administrar tipos de internet</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                    <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-Internet"><i class="fa fa-users"></i> Agregar internet</button>
                  </div>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width:10px">id</th>
                    <th>Servicio</th>
                    <th>Velocidad</th>
                    <th>Precio</th>
                    <th>Opciones</th>
                  </tr>
                  </thead>
                  <tbody>

                    <?php 

                      $item = null;

                      $valor = null;

                      $servicios = ControladorServicio::CtrMostrarServicio($item, $valor);

                      foreach ($servicios as $key => $value) {

                        echo '<tr>

                          <td>'.($key+1).'</td>

                          <td class="text-uppercase">'.$value["nombre"].'</td>

                          <td >'.$value["intensidad"].' Mbps</td>

                          <td>$'.number_format($value["precio"],2).'</td>

                          <td>

                            <div class="btn-group">';
                                
                            if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {

                            echo'  <button class="btn btn-primary btnEditarServicio" idservicio="'.$value["id"].'" data-toggle="modal" data-target="#EditInternet" title="Editar internet"><i class="fa fa-pencil-alt"></i></button>';

                            }  

                            if ($_SESSION["perfil"] == "Administrador") {

                              echo' <button class="btn btn-danger btnEliminarServicio" idservicio="'.$value["id"].'" title="Eliminar internet"><i class="fa fa-trash"></i></button>';

                            }

                           echo' </div>  

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


  <!-- ========================================= 
              MODAL AGREGAR INTERNET
========================================= -->


  <div class="modal fade" id="modal-Internet">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">


          <h4 class="modal-title">Agregar internet</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-body">

          <!-- =========================================
                        NOMBRE DE USUARIO
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <input type="text" class="form-control" name="nuevoServicio" placeholder="Ingresar nombre de internet" required>

          </div>

          <!-- =========================================
                        VELOCIDAD DE INTENET
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-wifi"></i></span>
            </div>

            <input type="number" class="form-control" name="nuevaVelocidad" placeholder="Ingresar velocidad de internet" step="any" required>

          </div>

          <!-- =========================================
                        PRECIO DE INTENET
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
            </div>

            <input type="number" class="form-control" name="nuevoPrecio" placeholder="Ingresar precio de internet" required>

          </div>


        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

    </form>

        <?php

          $crearInternet = new ControladorServicio();
          $crearInternet -> ctrCrearServicio();

        ?>

      </div>
      
    </div>
    
  </div>


  <!-- ========================================= 
              MODAL EDITAR INTERNET
  ========================================= -->


  <div class="modal fade" id="EditInternet">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Editar internet</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-body">

          <!-- =========================================
                        NOMBRE DE USUARIO
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <input type="text" class="form-control" name="editarServicio" id="editarServicio" value="" required>
            <input type="hidden" name="idServic" id="idServic" value="">
            
          </div>

          <!-- =========================================
                        VELOCIDAD DE INTENET
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-wifi"></i></span>
            </div>

            <input type="number" class="form-control" name="EditarVelocidad" id="EditarVelocidad" value="" step="any" required>

          </div>

          <!-- =========================================
                        PRECIO DE INTENET
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
            </div>

            <input type="number" class="form-control" name="editarPrecio" id="editarPrecio" value="" required>

          </div>


        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

    </form>

        <?php

          $EditaInternet = new ControladorServicio();
          $EditaInternet -> ctrEditarServicio();

        ?>

      </div>
      
    </div>
    
  </div>


<!-- ========================================= 
              ELIMINAR INTERNET
  ========================================= -->

  <?php

    $BorrarInternet = new ControladorServicio();
    $BorrarInternet -> ctrBorrarServicio();

  ?>