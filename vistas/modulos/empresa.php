<?php
  
  if ($_SESSION["perfil"] == "Vendedor"|| $_SESSION["perfil"] == "Sub administrador") {
    
    echo '<script>

    window.location ="crear-venta";

     </script>';

  }

?>


<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Empresa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
             
              <li class="breadcrumb-item active text-danger">Empresa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
     
     <?php
     $idEmpr = $_GET["idEmpresa"];
     $item = "id";
     $valor =$idEmpr;
     $empres = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
     

      echo '<form role="form" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card card-primary card-outline">

              <div class="card-header">
                <h3 class="card-title ">Datos de la Empresa</h3>
              </div>
       

          <div class="card-body">
                  <!-- /.primer row -->
            <div class="row">

              <div class="col-lg-6">     
                  
                <div class="row">
                <!-- Date dd/mm/yyyy -->
                  <div class="col-lg-6">
                     <div class="form-group">
                        <label>Nombre:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text "><i class="fas fa-building"></i></span>
                        </div>
                         <input type="text" class="form-control" id="nuevoNombre" name="nuevoNombre" value ="'.$empres["nombre"].'" required>
                      </div>
                     <!-- /.input group -->
                     </div>
                   <!-- /.form group -->
                  </div>
                   <div class="col-lg-6">
                     <div class="form-group">
                        <label>Correo:</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                         <input type="email" class="form-control" id="nuevoCorreo" name="nuevoCorreo" value ="'.$empres["correo"].'">
                      </div>
                     <!-- /.input group -->
                     </div>
                   <!-- /.form group -->
                  </div>
                  <!-- /.primer row  -->
                </div>
                  <!-- /.segundo row -->
                 <div class="row">
                <!-- Date dd/mm/yyyy -->
                  <div class="col-lg-6">
                    <div class="form-group">
                        <label>Telefono:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nuevoTelefono" name="nuevoTelefono" value ="'.$empres["telefono"].'" ';

                        ?> data-inputmask='"mask": "(999) 999-9999"' data-mask required>
                   
                   <?php echo '</div>
                     <!-- /.input group -->
                   </div>
                  </div>
                   <div class="col-lg-6">
                     <div class="form-group">
                        <label>Propietario:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-user-tie"></i></span>
                        </div>
                         <input type="text" class="form-control" id="nuevoPropietario" name="nuevoPropietario" value ="'.$empres["propietario"].'">
                      </div>
                     <!-- /.input group -->
                     </div>
                   <!-- /.form group -->
                  </div>
                  <!-- /.segundo row  -->
                </div>
                  <!-- /.tercero row  -->
                <div class="row">
                <!-- Date dd/mm/yyyy -->
                  <div class="col-lg-6">
                    
                        <label>RFC:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-registered"></i></span>
                        </div>
                         <input type="text" class="form-control" id="nuevoRFC" name="nuevoRFC" value ="'.$empres["RFC"].'" required>
                      </div>
                     <!-- /.input group -->
                  </div>

                   <div class="col-lg-6">
                     <div class="form-group">
                        <label>Dirección:</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                         <input type="text" class="form-control" id="nuevaDireccion" name="nuevaDireccion" value ="'.$empres["direccion"].'">
                      </div>
                     <!-- /.input group -->
                     </div>
                   <!-- /.form group -->
                  </div>
                  <!-- /.tercer row  -->
                </div>
                <br></br>
                  <div class="col-md-4 float-sm-left">
                    <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-archive"></i>Guardar cambios</button>
                  </div>
  
              </div>

             <div class="col-lg-6">
                    <!-- /.col (left) imagen-->
                <!-- Date -->
                <div class="form-group">';
                if ($empres["foto"]!="") {
                   echo '<img src="'.$empres["foto"].'" class="img-fuld img-responsive previsualizar " style="max-width:100%;width:600px;height:300px;">';
                } else {
                
                 echo '<img src="vistas/img/empresa/EmpresaDefaul.svg" class="img-fuld img-responsive previsualizar " style="max-width:100%;width:600px;height:300px;">';
                    
                }
                  echo ' <input type="hidden" name="fotoActual" id="fotoActual" value="'.$empres["foto"].'">';
                  echo ' <input type="hidden" name="idEmpresa" id="idEmpresa" value="'.$empres["id"].'">';
                ?>
               
                  <div class="input-group" >
                        <div class="custom-file">
                             
                        <input type="file"  class="nuevaFoto" name="nuevaFoto">
                     
                        <label class="custom" for="exampleInputFile"></label>
                      </div>
                    </div>
                </div>
             </div>
               
     
            </div> 
              <!-- /.row -->
          </div>
           
       </div>
          
            <!-- /.card -->
     </div>
      
   </div>
           <?php

            $crearEmpresa = new ControladorEmpresa();
            $crearEmpresa -> ctrCrearEmpresa();

            ?>
             </form>
      <!-- /.container-fluid -->
  </section>
    <!-- /.content -->
 </div>
</div>
<!-- ./wrapper -->

