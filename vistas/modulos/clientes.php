
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Clientes</h1>
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

        <div class="card card-primary card-outline">
          <div class="card-header">

              <div class="card-body row">
            
                <div class="col-md-3">
                  <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-Clientes"><i class="fa fa-users"></i> Agregar cliente</button>
                </div>

              </div>
              
          </div>
          <!-- /.card-header -->
          <div class="card-body ">
            <table id="example1" class="table table-bordered table-striped tablas">
               <thead>

                   <tr>
                     
                     <th style="width:10px">#</th>
                     <th>Nombre</th>
                     <th>Teléfono</th>
                     <th>Dirección</th>
                     <th>Compras</th>
                     <th>Ùltima compra</th>
                     <th>Opciones</th>

                   </tr> 

              </thead>
              <tbody>
              
                   <?php
            $item = null;
            $valor = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            foreach ($clientes as $key => $value) {
              
              echo '<tr>
                     <td>'.($key+1).'</td>
                     <td class="text-uppercase">'.$value["nombre"].'</td>';

              echo '<td>'.$value["telefono"].'</td>
                     <td>'.$value["direccion"].'</td>
                     <td>'.$value["compras"].'</td>
                     <td>'.$value["ultima_compra"].'</td>
                    
                  <td>';


                   if($_SESSION["perfil"] == "Administrador"  || $_SESSION["perfil"] == "Sub administrador"){

                    echo '<div class="btn-group">
                      
                        <button class="btn btn-primary btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'" title="Editar cliente"><i class="fa fa-pencil-alt"></i></button>';

                      
                    }
                      if($_SESSION["perfil"] == "Administrador"){
                        echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-trash" title="Eliminar cliente"></i></button>';
                      }


                    echo '</div>  

                  </td>

              </tr>';
            }
          ?>

              </tbody>
              
            </table>
          </div>
          
        </div>
        
      </div>
      
    </section>
    
  </div>

<!-- MODAL AGREGAR CLIENTE-->


  <div class="modal fade" id="modal-Clientes">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Agregar cliente</h4>

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

            <input type="text" class="form-control" name="nuevoCliente" placeholder="Ingresar nombre completo" required>

          </div>
          <!-- =========================================
                            TELEFONO Y DIRECCION
          ========================================= -->
    
            <div class="input-group mb-3">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                <input type="text" class="form-control" name="nuevaDireccion" placeholder="Ingresar dirección " required>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->

        
        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
      
      </div>
    
      <?php
        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();
      ?>
    </form>

      </div>
      
    </div>
    
  </div>

    <!--===========================================
    =            MODAL EDITAR CLIENTES            =
    ============================================-->


  <div class="modal fade" id="modalEditarCliente">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Editar cliente</h4>

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

            <input type="text" class="form-control" name="editarCliente" id="editarCliente" value="">

            <input type="hidden" id="idCliente" name="idCliente" value="">

          </div>
          <!-- =========================================
                            TELEFONO Y DIRECCION
          ========================================= -->
    
            <div class="input-group mb-3">
               <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" name="editarTelefono" id="editarTelefono" value="" data-inputmask='"mask": "(999) 999-9999"' data-mask>
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
                <input type="text" class="form-control" name="editarDireccion" id="editarDireccion" value="">
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->

         

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
       
        </div>
      
      </div>
    
    <?php 
        $editarClientes = new ControladorClientes();
        $editarClientes -> ctrEditarCliente();
      ?>

    </form>

      </div>
      
    </div>
    
  </div>

      <?php
        $eliminarCliente = new ControladorClientes();
        $eliminarCliente -> ctrEliminarCliente();
      ?>