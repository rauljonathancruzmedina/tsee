<?php
  
  if ($_SESSION["perfil"] == "Vendedor") {
    
    echo '<script>

    window.location ="crear-venta";

     </script>';

  }

?>

  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Editar venta</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Crear Ventas</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>
    <!--======================
    EL FORMULARIO
    =======================-->
    

    <section class="content">
           
     <div class="card card-outline card-primary">
      
       <div class="card-header">

        <form role="form" method="post" enctype="multipart/form-data" class="formularioVenta">
        
         <div class="card-body">
            
            <?php 

              $item = "id";
              $valor = $_GET["idVenta"];

              $ventaE = ControladorVentas::ctrMostrarVentas($item, $valor);

              $itemUsuario = "id";
              $valorUsuario = $ventaE["id_vendedor"];

              $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

              $itemCliente = "id";
              $valorCliente = $ventaE["id_cliente"];

              $ClientesE = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

             ?>       


                  <!--=====================================
                    ROW VENDEDOR Y CODIGO
                    ======================================-->
              <div class="row">
                 
                   <!--=====================================
                    ENTRADA DEL VENDEDOR
                    ======================================-->
                <div class="col-lg-5 col-xs-12">
                    <label>Vendedor</label>
                    <div class="input-group mb-3">
                      
                     <div class="input-group-prepend">
                        
                     <span class="input-group-text"><i class="fa fa-user"></i></span> 
                     </div>
                    
                     <input type="text" class="form-control" id="EditVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idEditVendedor" value="<?php echo $_SESSION["id"]; ?>"> 
                      
                    </div>

                </div>
                   <!--=====================================
                    ENTRADA DEL CODIGO FACTURA
                    ======================================-->
                <div class="col-lg-4 col-xs-12">
                   <label>Código de la venta</label>
                      <div class="input-group mb-3">
                      
                      <div class="input-group-prepend">
                        
                       <span class="input-group-text"><i class="fa fa-key"></i></span> 
                       </div>

                       <input type="text" class="form-control" name="EditVenta" value="<?php echo $ventaE["codigo"] ?>" readonly>
                       
                      
                    </div>
                     
                </div>

               
                 <!--=====================================
                  BOTÓN PARA AGREGAR PRODUCTO            
                  ======================================-->
                <div class="col-lg-3 col-xs-6">
                  <br>

                 <div class="input-group mb-3">    

                    <div class="input-group">
                      
                     <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalAgregarProducto"><i class="fas fa-cart-plus"></i> Agregar Producto</button>
              
                    </div>
                 
                  </div>
                
                </div>
                
              </div>

                    <!--=====================================
                    ROW CLIENTE
                    ======================================-->
              <div class="row">
                   <!--=====================================
                    ENTRADA DEL CLIENTE
                    ======================================-->
                <div class="col-lg-9 col-xs-12">
                    <label>Seleccionar cliente</label>
                   <div class="input-group mb-3">
                      
                      <div class="input-group-prepend">
              
                       <span class="input-group-text"><i class="fa fa-users"></i></span> 
                      </div>
                      
                       <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger" id="seleccionarEditCliente" name="seleccionarEditCliente" required>

                        <?php 

                          $itemVend = "id";
                          $valorVend = $ventaE["id_cliente"];

                          $usuariosVend = ControladorClientes::ctrMostrarClientes($itemVend, $valorVend);

                        ?>
                         
                        <option value="<?php echo $usuariosVend["id"] ?>"><?php echo $usuariosVend["nombre"] ?></option>

                        <?php

                          $item = null;
                          $valor = null;

                          $Clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                          foreach ($Clientes as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }

                        ?>

                      </select>
                 

                   </div>   
                  
                </div>
              
                <div class="col-lg-3 col-xs-12">
                  <br>

                 <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-AgregarClientes"><i class="fa fa-users"></i> Agregar Cliente</button>

                 

                </div>

              </div>
               <!--=====================================
                    ROW ENTRADA PRODUCTO
                    ======================================-->

                  <!--=====================================
                    ENTRADA PARA AGREGAR PRODUCTO
                    ======================================-->
                  <div class="from-group row nuevoProducto"> 

                    <?php  

                      $listaProductos = json_decode($ventaE["productos"], true);
                        
                      foreach ($listaProductos as $key => $value) {

                        $item = "id";
                        $valor = $value["id"];
                        $orden = "null";

                        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                        $descripcion = $respuesta["descripcion"];
    
                        $precio = $respuesta["precio_venta"];
                      
                        $stock = $respuesta["stock"];
                      
                        $precioM = $respuesta["precio_ventaa"];

                        $apartirD = $respuesta["precio_ventaaa"];

                        $AntiguoStock = $respuesta["stock"] + $value["cantidad"];

                        echo '<div class="row" style="padding:5px 15px">
        
                              

                         <div class="col-lg-6 col-xs-12" >
                             
                            <div class="input-group mb-3">
                              
                            <div class="input-group">
                              
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-info quitarProducto" idProducto="'.$value["id"].'"><i class="fas fa-trash-alt"></i></button></span>

                              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$descripcion.'" readonly required>
                            
                               </div>
                            
                            </div>
                          
                          </div> 
                          

                          
                         <div class="col-lg-2 col-xs-12 precioCol" >
                          
                            <div class="input-group mb-3">
                          
                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>    
                            
                            <input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value="'.$value["precio"].'" precioMe ="'.$precio.'" readonly required>
                            
                            <input type="hidden" class="form-control nuevoPrecioMayoreo" name="nuevoPrecioMayoreo" value="'.$precioM.'" readonly required>             

                            </div>
                            
                          </div>

               

                          
                           <div class="col-lg-1 col-xs-12 cantidadProducto">
                            
                            <div class="input-group mb-3">
                            
                            <input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0.25" step="any" value="'.$value["cantidad"].'" stock="'.$AntiguoStock.'" nuevoStock="'.$stock.'" apartirDe="'.$apartirD.'" required>
                                    
                          </div>
                          
                          </div> 

                          

                           <div class="col-lg-2 col-xs-12" >
                          
                            <div class="input-group mb-3">
                          
                            <div class="input-group-prepend">
                          
                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                          
                            </div>     
                          
                            <input type="text" class="form-control total"  name="total" value="'.$value["total"].'" readonly required>
                          
                            </div>
                            
                          </div>

                          </div>';

                  }  

                ?>

                  </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

              <!--=====================================
                  ENTRADA INPUESTO Y TOTAL
              ======================================-->
              <div class="row">
                
                <div class="col-lg-8 col-xs-12">

                 <h4 class="text-center">Comentarios de venta</h4>
                 
                  <div class="input-group">
                  
                   <textarea id="summernote" class="form-control input-lg" rows="3" cols="20" name="Editcomentario" placeholder="Comentarios"><?php echo $ventaE["comentarios"] ?></textarea>
                 
                  

                </div>
                </div>


                <div class="col-lg-4 col-xs-8 col-xs-pull-2">
                  
                  <table class="table table-condensed">
                    
                    <thead>
                      
                      <tr>
                        
                        <th>Descuento</th>
                        <th>Total</th>

                      </tr>

                    </thead>

                    <tbody>
                      
                      <tr>
                      
                      <td style="width:50%">

                        <div class="input-group">

                          <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                          <input type="number" class="form-control input-lg" min="0.01" step="any" id="nuevoDescuentoVenta" name="nuevoDescuentoVenta" value="<?php echo $ventaE["impuesto"] ?>" >

                          <input type="hidden" name="nuevoPrecioDescuento" id="nuevoPrecioDescuento" value="<?php echo $ventaE["impuesto"] ?>"required>
                          <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $ventaE["neto"] ?>" required>
                          
                      
                        </div>
                       
                      </td>

                      <td style="width:50%">

                        <div class="input-group">

                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                        <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $ventaE["total"] ?>" value="<?php echo $ventaE["total"] ?>" readonly>
                        
                        <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $ventaE["total"] ?>">
                         
                        </div>
                       
                      </td>

                    </tr>

                    </tbody>

                  </table>

                </div>

              </div>

              <hr>
              <!--=====================================
                  ENTRADA MÉTODO DE PAGO
              ======================================-->
              
              <div class="form-group row">
                
               <div class="col-lg-6 col-xs-12">
                
                <div class="input-group mb-3">

                <div class="input-group">

                <div class="col-lg-4">
                        <label>Efectivo</label>
                        <div class="input-group">

                              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                              <input type="text" class="form-control" id="nuevoEfectivoVenta" name="nuevoEfectivoVenta" value="<?php echo $ventaE["importe"] ?>" required>

                          <input type="hidden" name="nuevoEfecVent" id="nuevoEfecVent" value="" required>

                             
                        </div>
                        
                  </div>

                  <div class="col-lg-4" id="capturarCambioEfectivo" >
                      <label>Cambio</label>
                        <div class="input-group">

                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                            <input type="text" class="form-control" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" value="<?php echo $ventaE["cambio"] ?>" readonly >


                            <input type="hidden" name="nuevoCambioVent" id="nuevoCambioVent" value="" required>

                        </div>     

                  </div>

            
               <!--============================
                 =  botone            =
                 =============================-->
               <input type="hidden" id="MetodoPagos" name="MetodoPagos" value="Efectivo">
                </div>

               </div>
                 
               </div>

                  <div class="cajasMetodoPago"></div>
               <!--============================
                 =  botone            =
                 =============================-->
               <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">
        
              </div>
            
            </div>
         
          <button type="submit" class="btn btn-danger">Guardar venta</button>
  
        
        </form>

        <?php
          
          $EditVenta = new ControladorVentas();
          $EditVenta -> ctrEditarVenta();
         
        ?>

       </div>

     </div>
    
    </section>
    <!-- /.content -->
  </div>
<!--=============================================
     MODAL AGREGAR PRODUCTOS     =
==============================================-->

   <div class="modal fade" id="modalAgregarProducto">

        <div class="modal-dialog modal-xl">
    
          <div class="modal-content ">
    
            <div class="modal-header bg-info">
    
              <h4 class="modal-title">Tabla productos  <i class="
              nav-icon fab fa-product-hunt"></i> </h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            </div>

            <div class="modal-body">
              <div class="card-body">
              <table class="table table-bordered table-striped dt-responsive tablaPVenta"  width="100%">
                
                <thead>
                  
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Descripción</th>
                    <th>Código</th>
                    <th>N/serie</th>
                    <th>Cantidad</th>
                    <th>U.M.</th>
                    <th>P/venta</th>
                    <th>P/mayoreo</th>
                    <th>Imagen</th>
                    <th>Opción</th>
                  </tr>

                </thead>
               
              </table>  
              </div>
              
            
            </div>
            
            <div class="modal-footer justify-content-between">
            
              <button type="button " class="btn btn-danger ml-auto" data-dismiss="modal">Cerrar</button>
            
            </div>
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


<!-- MODAL AGREGAR CLIENTE-->


<div class="modal fade" id="modal-AgregarClientes">

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
