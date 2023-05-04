<?php 

$fecha = ControladorEmpresa::ctrMostrarEmpresa("id", 1);
date_default_timezone_set('America/Mexico_City');
$hoy = date("Y-m-d");

$ruso = $fecha["fecha"];

?>
  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Crear ventas</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Crear Ventas</li>

            </ol>

          </div>

        </div>

         <?php if ($ruso != $hoy):?>
        
             <script>
               
                $( document ).ready(function() {
                    $('#Fecha').modal('toggle')
                });

             </script>

          <?php endif ?>

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
                        
                         <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                        <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>"> 
                          
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

                           <?php 

                           $item = null;
                           $valor = null;

                           $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                           if (!$ventas) {

                             echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="1001" readonly>';
                           
                           } else {
                             
                            foreach ($ventas as $key => $value) {
                              # code...
                            }

                            $codigo = $value["codigo"] +1;

                               echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                           }
                           ?>
                          
                        </div>
                         
                    </div>
                     <!--=====================================
                      BOTÓN PARA AGREGAR PRODUCTO            
                      ======================================-->
                    <div class="col-lg-3 col-xs-6">
                      <br>

                     <div class="input-group mb-3">    

                        <div class="input-group">
                  
                         <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalAgregarProducto"><i class="fas fa-cart-arrow-down"></i> Agregar Producto</button>
                  
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
                      
                       <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger" id="seleccionarCliente" name="seleccionarCliente" required>
                         
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
                  <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modal-Clientes"><i class="fa fa-users"></i> Agregar Cliente</button>
                  

                </div>

              </div>
               <!--=====================================
                    ROW ENTRADA PRODUCTO
                    ======================================-->
                  <!--=====================================
                    ENTRADA PARA AGREGAR PRODUCTO
                    ======================================-->
                  <div class="from-group row nuevoProducto"> </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

              <!--=====================================
                  ENTRADA INPUESTO Y TOTAL
              ======================================-->
              <div class="row">
                
                <div class="col-lg-8 col-xs-12">

                 <h4 class="text-center">Comentarios de venta</h4>
                 
                  <div class="input-group">
                  <textarea id="summernote" class="form-control input-lg" rows="3" cols="20" name="Nuevocomentario" placeholder="Comentarios"></textarea>
                 

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

                          <input type="number" class="form-control input-lg" min="0.01" step="any" id="nuevoDescuentoVenta" name="nuevoDescuentoVenta" placeholder="0" >

                          <input type="hidden" name="nuevoPrecioDescuento" id="nuevoPrecioDescuento" required>
                          <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>
                          
                          
                        </div>
                       
                      </td>

                      <td style="width:50%">

                        <div class="input-group">

                        <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                        <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="0" readonly>
                        <input type="hidden" name="totalVenta" id="totalVenta">
                         
                        </div>
                       
                      </td>

                    </tr>

                    </tbody>

                  </table>

                </div>

              </div>

           
              <!--=====================================
                  ENTRADA MÉTODO DE PAGO
              ======================================-->
              
              <div class="form-group row ">
                
               
                 <div class="col-lg-4">
                        <label>Efectivo</label>
                        <div class="input-group">

                              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                              <input type="text" class="form-control" id="nuevoEfectivoVenta" name="nuevoEfectivoVenta" placeholder="0000000" required>

                              <input type="hidden" id="nuevoEfecVent" name="nuevoEfecVent">

                        </div>
                        
                  </div>

                  <div class="col-lg-4" id="capturarCambioEfectivo" >
                      <label>Cambio</label>
                        <div class="input-group">

                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                            <input type="text" class="form-control"  id="nuevoCambioEfectivo" name="nuevoCambioEfectivo"  placeholder="0000000" readonly required>

                            <input type="hidden" name="nuevoCambioVent" id="nuevoCambioVent">

                        </div>     

                  </div>

            
               <!--============================
                 =  botone            =
                 =============================-->
               <input type="hidden" id="MetodoPagos" name="MetodoPagos" value="Efectivo">
        
              </div>
            
            </div>

          <div class="col-md-3 float-sm-right">
              
            <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-cart-plus"></i>Guardar venta</button>
          
          </div>
  
        
        </form>

        <?php
          
          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
         
        ?>

       </div>

     </div>
    
    </section>
    <!-- /.content -->
  </div>




<!-- ========================================= 
            MODAL CONFIGURACION 
    ========================================= -->

  <div class="modal fade" id="Fecha">

      <div class="modal-dialog">

        <div class="modal-content">

          <form role="form" method="post" enctype="multipart/form-data">

          <div class="modal-header bg-info">

            <h4 class="modal-title col-11 text-center">Caja</h4>
            
          </div>

          <div class="modal-body">

            <label>Dinero en caja</label>

              <div class="input-group mb-3">

                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                </div>
                
                <input type="number" class="form-control" name="DineroCaja" placeholder="Dinero en caja" required min="0.0" step="any">

              </div>

              <input type="hidden" name="idCaja" value="1">
              <input type="hidden" name="FechaCaja" value="<?php echo($hoy);  ?>">
              
          </div>

          <!--=====================================
          PIE DEL MODAL
          ======================================-->

          <div class="modal-header" >
            <div class="col-lg-5">

               <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-cash-register"></i> Guardar cambios</button>
            </div>
           
          </div>

          <?php

            $editarDinero = new ControladorEmpresa();
            $editarDinero -> ctrDineroCaja();

          ?> 

        </form>

        </div>
        
      </div>
      
    </div>


<!--=============================================
     MODAL AGREGAR PRODUCTOS     =
==============================================-->

   <div class="modal fade" id="modalAgregarProducto">

        <div class="modal-dialog modal-xl">
    
          <div class="modal-content">
    
            <div class="modal-header bg-info">
    
              <h4 class="modal-title">Tabla productos  <i class="
              nav-icon fab fa-product-hunt"></i> </h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            </div>

            <div class="modal-body">
              <div class="card-body">
              <table class="table table-bordered table-striped dt-responsive tablaPVenta"  width="100%">
                
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
            
              <button type="button" class="btn btn-outline-danger ml-auto" data-dismiss="modal">Cerrar</button>
            
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
