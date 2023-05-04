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
            <h1>Administrar servicios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
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
                    <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalAgregarServicio"><i class="fas fa-briefcase"></i> Agregar servicio</button>
                  </div>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <table id="example1" class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
                    <thead>
                     
                     <tr >
                       
                       <th style="width:10px">id</th>
                       <th>Nombre</th>
                       <th>Costo</th>
                       <th>Opciones</th>

                     </tr> 

                    </thead>

                   <tbody>

                    <?php 

                      $item = null;
                      $valor = null;

                      $Service = ControladorService::CtrMostrarService($item, $valor);


                      foreach ($Service as $key => $value) {
                        
                        echo '<tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["nombre"].'</td>
                          <td>$ '.number_format($value["costo"],2).'</td>
                        
                          <td>

                            <div class="btn-group">';
                           
                            if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {

                              echo'<button class="btn btn-primary btnEditarService" idService="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarService" title="Editar servivio"><i class="fa fa-pencil-alt"></i></button>';

                            }

                          if($_SESSION["perfil"] == "Administrador"){

                              echo '<button class="btn btn-danger btnEliminarService" idService="'.$value["id"].'" title="Eliminar servivio"><i class="fa fa-trash"></i></button>';
                          }    

                           echo '</div>  

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


      <!--=====================================
      MODAL AGREGAR SERVICIO
      ======================================-->

  
<div class="modal fade" id="modalAgregarServicio">

<div class="modal-dialog modal-lg">

  <div class="modal-content">

    <div class="modal-header bg-info">

      <h4 class="modal-title">Agregar Servicios</h4>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

    </div>

    <form role="form" method="post" enctype="multipart/form-data">

    <div class="modal-body">

      <!-- =========================================
                    NOMBRE DEL SERVICIO
      ========================================= -->

      <div class="input-group mb-3">

        <div class="input-group-prepend">
          <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
        </div>

        <input type="text" class="form-control" name="nuevoServicio" placeholder="Ingresar servicio" required>

      </div>

       <div class="input-group mb-3">

        <div class="input-group-prepend">
          <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
        </div>

        <input type="text" class="form-control" name="precioServicio" placeholder="Ingresar precio" step="any" required>

      </div>


    </div>

    <div class="modal-footer justify-content-between">

      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar servico</button>
    </div>

    <?php

      $crearService = new ControladorService();
      $crearService -> CtrCrearService();
    ?>
</form>

  </div>
  
</div>

</div>
            
      <!--=====================================
      MODAL EDITAR SERVICIO
      ======================================-->
<div class="modal fade" id="modalEditarService">

<div class="modal-dialog modal-lg">

  <div class="modal-content">

    <div class="modal-header bg-info">

      <h4 class="modal-title">Editar Servicios</h4>

      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>

    </div>

    <form role="form" method="post" enctype="multipart/form-data">

      <div class="modal-body">

        <!-- =========================================
                      NOMBRE DEL SERVICIO
        ========================================= -->

        <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
          </div>

          <input type="text" class="form-control" name="editarService" id="editarService" >

           <input type="hidden" name="idService" id="idService" required>

        </div>

         <div class="input-group mb-3">

          <div class="input-group-prepend">
            <span class="input-group-text"><i class="ion ion-social-usd"></i></span>
          </div>

          <input type="text" class="form-control" name="EditarPrecioService" id="EditarPrecioService" step="any">


        </div>


      </div>

      <div class="modal-footer justify-content-between">

        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>

      
        <?php

          $editarService = new ControladorService();
          $editarService -> ctrEditarService();

        ?>
  </form>

  </div>
  
</div>

</div>
            

<?php
  
  $borrarService = new ControladorService();
  $borrarService -> ctrBorrarService();

?>
