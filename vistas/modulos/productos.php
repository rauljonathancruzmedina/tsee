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
            <h1>Productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
                    <button type="button" class="btn btn-outline-info btn-block agregarProduc"><i class="fab fa-product-hunt"></i> Agregar producto</button>
                  </div>

                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body ">
                <table  class="table table-bordered table-striped tablaProduct" width="100%">
                  <thead>
                    <tr >
                      <th style="width:10px">id</th>
                      <th>Descripción</th>
                      <th>Marca</th>
                      <th>Código</th>
                      <th>N/serie</th>
                      <th>Categoría</th>
                      <th>Cantidad</th>
                      <th>U.M.</th>
                      <th>P/C</th>
                      <th>P/V</th>
                      <th>Imagen</th>
                      <th>Opciones</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>

                </table>

                <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

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
     $eliminarProducto = new ControladorProductos();
     $eliminarProducto -> ctrEliminarProducto();
?>


