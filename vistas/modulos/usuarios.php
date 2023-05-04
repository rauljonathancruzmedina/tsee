<?php
  
  if ($_SESSION["perfil"] == "Vendedor") {
    
    echo '<script>

    window.location ="crear-venta";

     </script>';

  }

?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
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
                  <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-Usuarios"><i class="fa fa-users"></i> Agregar usuario</button>
                </div>

              </div>
              
          </div>
          <!-- /.card-header -->
          <div class="card-body ">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width:10px">id</th>
                  <th >Nombre</th>
                  <th >Usuario</th>
                  <th >Foto</th>
                  <th>Teléfono</th> 
                  <th >Perfil</th>
                  <th >Estado</th>
                  <th >Ultima sesión</th>
                  <th >Opciones</th>
                </tr>
              </thead>
              <tbody>
              
                  <?php

                    $item = null;
                    $valor = null;

                    $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                   foreach ($usuarios as $key => $value){
                     
                      echo ' <tr>
                              <td>'.($key+1).'</td>
                              <td>'.$value["nombre"].'</td>
                              <td>'.$value["usuario"].'</td>';

                              if($value["foto"] != ""){

                                echo '<td><img src="'.$value["foto"].'" class="img-thumbnail img-circle" width="80px"></td>';

                              }else{

                                echo '<td><img src="vistas/img/usuarios/anonymous.png" class="img-thumbnail img-circle" width="80px"></td>';

                              }

                              echo '<td> '.$value["telefono"].' </td>
                              <td>'.$value["perfil"].'</td>';

                              if($value["estado"] != 0){

                                echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0">Activado</button></td>';

                              }else{

                                echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1">Desactivado</button></td>';

                              }             

                              echo '<td>'.$value["ultimo_login"].'</td>
                              
                              <td>

                                <div class="btn-group">';

                                if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {

                                 echo' <button class="btn btn-primary btnEditarUsuario" data-toggle="modal" data-target="#ModalEditarUsuarios" idUsuario="'.$value["id"].'" title="Editar usuario"><i class="fas fa-pencil-alt"></i></button>';

                                }

                                if ($_SESSION["perfil"] == "Administrador") {

                                  echo' <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'" title="Eliminar usuario"><i class="fa fa-trash"></i></button>';
                                }
                                echo'</div>  

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




<!-- ========================================= 
              MODAL AGREGAR USUARIOS
========================================= -->


  <div class="modal fade" id="modal-Usuarios">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Agregar usuarios</h4>

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

            <input type="text" class="form-control" name="nuevoNombre" placeholder="Ingresar nombre de usuario" required>

          </div>


          <!-- =========================================
                            USUARIO
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>

            <input type="text" class="form-control" name="nuevoUsuario" placeholder="Ingresar usuario" required>

          </div>


          <!-- =========================================
                            USUARIO
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>

            <input type="password" class="form-control" name="nuevoPassword" placeholder="Ingresar contraseña" required>

          </div>

          <!-- =========================================
                            TELEFONO Y DIRECCION
          ========================================= -->

          <div class="row">
            <div class="col-lg-6">

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" name="nuevoTelefono" data-inputmask='"mask": "(999) 999-9999"' data-mask>
              </div>
              
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                </div>
                <input type="text" class="form-control" name="nuevaDireccion" placeholder="Ingresar dirección de usuario" required>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
          </div>


          <!-- =========================================
                        PERFIL DE USUARIO
          ========================================= -->
          
          <div class="row">
              
            <div class="col-12 col-sm-12">

              <div class="form-group">
                <label></label>
                  <select class="select2 input-lg" data-placeholder="Selecccionar perfil" data-dropdown-css-class="select2-primary" style="width: 100%;" name="nuevoPerfil">
                    <option>Seleccionar perfil de usuario</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Sub administrador">Sub administrador</option>
                    <option value="Vendedor">Vendedor</option>
                  </select>
              </div>
            </div>
            <!-- /.form-group -->
          </div>

          <!-- =========================================
                        FOTO DE USUARIO
          ========================================= -->
          <label> - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</label>
          <div class="text-center">

            <div class="image">
              <img src="vistas/img/usuarios/anonymous.png" class="img-circle elevation-2 previsualizar" alt="User Image" width="200px">
            </div>

            <input type="file" class="nuevaFoto" name="nuevaFoto" >

            <p class="help-block">Max. 32MB</p>

          </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>
    </form>

      </div>
      
    </div>
    
  </div>



  <!-- ========================================= 
              MODAL EDITAR USUARIOS
========================================= -->


  <div class="modal fade" id="ModalEditarUsuarios">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <div class="modal-header bg-info">

          <h4 class="modal-title">Editar usuarios</h4>

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

            <input type="text" class="form-control" name="editarNombre" id="editarNombre" value="" required>
          </div>


          <!-- =========================================
                            USUARIO
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>

            <input type="text" class="form-control" name="editarUsuario" id="editarUsuario" value="" readonly>

          </div>


          <!-- =========================================
                           CONTRASEÑA USUARIO
          ========================================= -->

          <div class="input-group mb-3">

            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-lock"></i></span>
            </div>

            <input type="password" class="form-control" placeholder="Escriba la nueva contraseña" name="editarPassword" id="editarPassword" value="">

            <input type="hidden" class="form-control" name="passwordActual" id="passwordActual" value="" >

          </div>

          <!-- =========================================
                            TELEFONO Y DIRECCION
          ========================================= -->

          <div class="row">
            <div class="col-lg-6">

              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" class="form-control" name="editarTelefono" id="editarTelefono" value="" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
              </div>
              
            </div>
            <!-- /.col-lg-6 -->
            <div class="col-lg-6">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                </div>
                <input type="text" class="form-control" name="editarDireccion" id="editarDireccion" value="" required>
              </div>
              <!-- /input-group -->
            </div>
            <!-- /.col-lg-6 -->
          </div>


          <!-- =========================================
                        PERFIL DE USUARIO
          ========================================= -->
          
          <div class="row">
              
            <div class="col-12 col-sm-12">

              <div class="form-group">
                <label></label>
                  <select class="select2" data-placeholder="Selecccionar perfil" data-dropdown-css-class="select2-primary" style="width: 100%;" name="editarPerfil">
                      <option value="" id="editarPerfil"></option>
                      <option value="Administrador">Administrador</option>
                      <option value="Sub administrador">Sub administrador</option>
                      <option value="Vendedor">Vendedor</option>
                  </select>
              </div>
            </div>
            <!-- /.form-group -->
          </div>

          <!-- =========================================
                        FOTO DE USUARIO
          ========================================= -->
          <label>- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</label>
          <div class="text-center">

            <div class="image">
              <img src="" name="fotoActual" class="img-circle elevation-2 previsualizar" alt="User Image" width="200px">
            </div> 

            <input type="file" class="nuevaFoto" name="editarFoto">
            <input type="hidden" name="fotoActual" id="fotoActual">

            <p class="help-block">Max. 32MB</p>

          </div>

        </div>

        <div class="modal-footer justify-content-between">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>

        <?php

          $editUsuario = new ControladorUsuarios();
          $editUsuario -> ctrEditarUsuario();

        ?>
      </form>

      </div>
      
    </div>
    
  </div>

        <?php

          $borrarUsuario = new ControladorUsuarios();
          $borrarUsuario -> ctrBorrarUsuario();

        ?>
