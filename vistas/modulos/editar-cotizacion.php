  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Crear Cotización</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Crear Cotización</li>

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

        <form role="form" method="post" enctype="multipart/form-data" class="formularioCotiz">
        
         <div class="card-body">
                   
               <!--=====================================
                    ROW VENDEDOR Y CODIGO
                    ======================================-->
              <div class="row">
                 

                  <?php 


                    $item = "id";
                    $valor = $_GET["idCotiza"];

                    $cot = ControladorCotiz::ctrMostrarCotiz($item, $valor);

                    $fecha = substr($cot["fecha"], 0, -8);
                    
                    $itemCliente = "id";
                    $valorCliente = $cot["cliente"];

                    $client = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  ?>



                   <!--=====================================
                    ENTRADA DEL VENDEDOR
                    ======================================-->
                <div class="col-lg-5 col-xs-12">
                      <label>Vendedor</label>
                    <div class="input-group mb-3">
                      
                     <div class="input-group-prepend">
                        
                     <span class="input-group-text"><i class="fa fa-user"></i></span> 
                     </div>
                    
                     <input type="text" class="form-control" id="EdVend" name="EdVend" value="<?php echo $cot["remitente"] ?>" readonly>
                      <input type="hidden" name="id" value="<?php echo $valor ?>">
                    </div>

                </div>
                   <!--=====================================
                    ENTRADA DEL CODIGO FACTURA
                    ======================================-->
                <div class="col-lg-2 col-xs-12">
                   <label>Código cotización</label>
                    <div class="input-group mb-3">
                      
                      <div class="input-group-prepend">
                        
                       <span class="input-group-text"><i class="fa fa-key"></i></span> 
                       </div>
                       
                       <input type="text" class="form-control" id="EdCodVent" name="EdCodVent" value="<?php echo $cot["codigo"] ?>" readonly>
                      
                    </div>
                     
                </div>

                <!--=====================================
                    FECHA DE COTIZACION
                    ======================================-->
                <div class="col-lg-2 col-xs-12">
                   <label>Fecha</label>
                    <div class="input-group mb-3">
                      
                      <div class="input-group-prepend">
                        
                       <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span> 
                       </div>
                       
                       <input type="text" class="form-control"  id="EdFecha" name="EdFecha" <?php echo 'value="'.date('d/m/Y').'"'; ?> readonly>
                      
                    </div>
                     
                </div>

                 <!--=====================================
                  BOTÓN PARA AGREGAR PRODUCTO            
                  ======================================-->
                <div class="col-lg-3 col-xs-6">
                  <br>

                 <div class="input-group mb-3">    

                    <div class="input-group">

                     <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalAgregarProducto"><i class="fas fa-cart-plus"></i> Agregar producto</button>
              
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
                    <label>Seleccione cliente</label>
                   <div class="input-group mb-3">
                      
                      <div class="input-group-prepend">
              
                       <span class="input-group-text"><i class="fa fa-users"></i></span> 
                      </div>
                       
                       <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger" name="EdCliente" required>
                        
                        <option value="<?php echo $client["id"] ?>"><?php echo $client["nombre"] ?></option>

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
                  <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-Clientes"><i class="fa fa-users"></i> Agregar cliente</button>
                                 

                 </div>

                </div>

              </div>
               <!--=====================================
                    ROW ENTRADA PRODUCTO
                    ======================================-->
                  <!--=====================================
                    ENTRADA PARA AGREGAR PRODUCTO
                    ======================================-->
                  <div class="from-group row nuevoProductoC">

                    <?php 

                        $listaProductos = json_decode($cot["productos"], true);
                        
                        foreach ($listaProductos as $key => $value) {

                          $item = "id";
                          $valor = $value["id"];
                          $orden = "null";

                          $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);


                         $descripcionC = $respuesta["descripcion"];
      
                         $precioC = $respuesta["precio_venta"];
                      
                         $stockC = $respuesta["stock"];
                      
                         $precioCM = $respuesta["precio_ventaa"];

                         $apartirDC = $respuesta["precio_ventaaa"];

                          
                          echo '<div class="row" style="padding:5px 15px">
        

                               <div class="col-lg-6 col-xs-12" >
                                   
                                  <div class="input-group mb-3">
                                    
                                  <div class="input-group">
                                    
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-info quitarProductoC" idProducto="'.$value["id"].'"><i class="fas fa-trash-alt"></i></button></span>

                                    <input type="text" class="form-control nuevaDescripcionProductoC" idProducto="'.$value["id"].'" name="agregarProductoC" value="'.$value["descripcionC"].'" readonly required>
                                  
                                     </div>
                                  
                                  </div>
                                
                                </div> 
                                
                                
                               <div class="col-lg-2 col-xs-12 precioCCol" >
                                
                                  <div class="input-group mb-3">
                                
                                  <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>    
                                  
                                  <input type="text" class="form-control nuevoPrecioProductoC" name="nuevoPrecioProductoC" value="'.$precioC.'" precioCMe ="'.$precioC.'" required>
                                  
                                  <input type="hidden" class="form-control nuevoPrecioMayoreoC" name="nuevoPrecioMayoreoC" value="'.$precioCM.'"  required>             

                                  </div>
                                  
                                </div>

                     

                                <!-- Cantidad del producto -->
                                 <div class="col-lg-1 col-xs-12 cantidadProductoC">
                                  
                                  <div class="input-group mb-3">
                                  
                                  <input type="number" class="form-control nuevaCantidadProductoC" name="nuevaCantidadProductoC" min="0.25" step="any" value="'.$value["cantidad"].'" stockC="" nuevoStockC="" apartirDCe="'.$apartirDC.'" required>
                                          
                                </div>
                                
                                </div> 

                                <!-- Precio del producto -->
                                 <div class="col-lg-2 col-xs-12" >
                                
                                  <div class="input-group mb-3">
                                
                                  <div class="input-group-prepend">
                                
                                  <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                                
                                  </div>     
                                
                                  <input type="text" class="form-control totalC"  name="totalC" value="'.$value["totalC"].'" readonly required>
                                
                                  </div>
                                  
                                </div>

                                </div>';

                        }

                     ?>

                  </div>

                <input type="hidden" id="listaProductC" name="listaProductC">

              <!--=====================================
                  ENTRADA INPUESTO Y TOTAL
              ======================================-->
              <div class="row">
                
                <div class="col-lg-8 col-xs-12">

                 <h4 class="text-center">Comentarios de cotización</h4>
                 
                  <div class="input-group">
                 
                  <textarea id="summernote" class="form-control input-lg" rows="3" cols="20" name="EdComen"><?php echo $cot["comentarios"] ?></textarea>

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

                        <input type="number" class="form-control input-lg" min="0.25" step="any" id="nuevoDescuentoVenta" name="nuevoDescuentoVenta" value="<?php echo $cot["descuento"] ?>">

                        <input type="hidden" name="nuevoPrecioDescuento" id="nuevoPrecioDescuento" value="<?php echo $cot["descuento"] ?>" required>

                        <input type="hidden" name="nuevoPrecioNet" id="nuevoPrecioNet" value="<?php echo $cot["neto"] ?>" required>

                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                          
                        </div>
                       
                      </td>

                      <td style="width:50%">

                        <div class="input-group">

                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                        <input type="number" class="form-control input-lg" id="nuevoTotalVen" name="nuevoTotalVen" value="<?php echo $cot["total"] ?>" readonly>

                        <input type="hidden" name="totalVenta" id="totalVenta">
                         
                        </div>
                       
                      </td>

                    </tr>

                    </tbody>

                  </table>

                </div>

              </div>
      
        </div>     
          
          <div class="card-body ">
            
            <div class="col-md-3 float-sm-right">
              
              <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-cart-plus"></i> Guardar cotización</button>
            
            </div>

          </div>
        
        </form>

        <?php
          
          $EdCotiz = new ControladorCotiz();

          $EdCotiz -> ctrEditCotixacion();
         
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
              <table class="table table-bordered table-striped dt-responsive tablaPCotiza"  width="100%">
                
                <thead>
                  
                  <tr >
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
            
              <button type="button" class="btn btn-danger ml-auto" data-dismiss="modal">Cerrar</button>
            
            </div>
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->





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