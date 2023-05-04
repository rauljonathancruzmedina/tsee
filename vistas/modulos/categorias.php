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
            <h1>Categorías</h1>
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
                    <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-Categoria"><i class="fa fa-users"></i> Agregar Categoría</button>
                  </div>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped tablas">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Opciones</th>
                  </tr>
                  </thead>
                  <tbody>
              
                  <?php

                    $item = null;
                    $valor = null;

                    $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);
                    
                   foreach ($categoria as $key => $value){
                     
                      echo ' <tr>
                              <td>'.($key+1).'</td>
                              <td>'.$value["categoria"].'</td>';           

                              echo ' <td>

                                <div class="btn-group">';

                                if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {
                                  
                                  echo'<button class="btn btn-primary btnEditarCategoria" data-toggle="modal" data-target="#ModalEditarCategoria" idCategoria="'.$value["id"].'" title="Editar categoría"><i class="fas fa-pencil-alt"></i></button>';

                                }

                                if ($_SESSION["perfil"] == "Administrador") {  

                                  echo'<button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'" title="Eliminar categoría"><i class="fa fa-trash"></i></button>';
                                  
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


<!-- ========================================= 
              MODAL AGREGAR CATEGORIA
========================================= -->


  <div class="modal fade" id="modal-Categoria">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Agregar categoría</h4>

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

            <input type="text" class="form-control" name="nuevaCategoria" placeholder="Ingresar nombre de categoaría" required>

          </div>


        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> CtrCrearCategoria();

        ?>
    </form>

      </div>
      
    </div>
    
  </div>


  <!-- ========================================= 
              MODAL EDITAR CATEGORIA
========================================= -->


  <div class="modal fade" id="ModalEditarCategoria">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Editar categoría</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>

        <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-body">

          <!-- =========================================
                        Nombre de categoria
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <input type="text" class="form-control" name="editarCategoria" id="editarCategoria" value="" required>

            <input type="hidden" name="idCategoria" id="idCategoria">

          </div>


        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> CtrEditarCategoria();

        ?>
    </form>

      </div>
      
    </div>
    
  </div>

  <?php

    $borrarCategoria = new ControladorCategorias();
    $borrarCategoria -> ctrBorrarCategoria();

  ?>