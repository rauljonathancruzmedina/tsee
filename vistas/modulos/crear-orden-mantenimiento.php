  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Crear Orden Servicio</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Crear orden servicio</li>

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

        <form role="form" method="post" enctype="multipart/form-data" class="formularioServi">
        
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
                        
                         <input type="text" class="form-control" id="idVendedorS" name="idVendedorS" value="<?php echo $_SESSION["nombre"]; ?>" readonly>
                        <input type="hidden" name="idVendedorS" value="<?php echo $_SESSION["id"]; ?>"> 
                          
                        </div>

                    </div>
                       <!--=====================================
                        ENTRADA DEL CODIGO FACTURA
                        ======================================-->
                    <div class="col-lg-4 col-xs-12">
                       <label>Código de orden del servicio</label>
                          <div class="input-group mb-3">
                          
                          <div class="input-group-prepend">
                            
                           <span class="input-group-text"><i class="fa fa-key"></i></span> 
                           </div>

                           <?php 

                            $item = null;
                            $valor = null;

                             $ordenServicio = ControladorService::ctrMostrarOrdenService($item, $valor);

                           if (!$ordenServicio) {

                             echo '<input type="text" class="form-control" id="CodiOrdenSer" name="CodiOrdenSer" value="1001" readonly>';
                           
                           } else {
                             
                            foreach ($ordenServicio as $key => $value) {
                              # code...
                            }

                            $codigo = $value["codigo"] +1;

                               echo '<input type="text" class="form-control" id="CodiOrdenSer" name="CodiOrdenSer" value="'.$codigo.'" readonly>';
                           }
                           ?>
                          
                        </div>
                         
                    </div>

                                 <!--==================================
                            =            CODIGO VENTA            =
                            ===================================-->
                             <?php

                                  $item = null;
                                  $valor = null;

                                   $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);
                                   if (!$ventas) {
                                     echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                                   }else {
                                     foreach ($ventas as $key => $value) {
                                       # code...
                                     }
                                     $codigoV = $value["codigo"] + 1;

                                     echo '<input type="hidden" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigoV.'" readonly>';
                                   }


                                ?>
                            

                     <!--=====================================
                      BOTÓN PARA AGREGAR PRODUCTO            
                      ======================================-->
                    <div class="col-lg-3 col-xs-6">
                      <br>

                     <div class="input-group mb-3">    

                        <div class="input-group">
                  
                      <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" id="Agregarser" data-target="#modalAgregarServicio"><i class="fas fa-briefcase"></i> Agregar Servicio</button>

                  
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
                <div class="col-lg-5 col-xs-12">
                      <label>Seleccione cliente</label>
                     <div class="input-group mb-3">
                        
                        <div class="input-group-prepend">
                
                         <span class="input-group-text"><i class="fa fa-users"></i></span> 
                        </div>
                        
                         <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger"  id="selecCliente" name="selecCliente" required>
                           
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
                <!--=====================================
                    ENTRADA DEL TECNICO
                    ======================================-->
                <div class="col-lg-4 col-xs-12">

                      <label>Seleccione al Tecnico</label>
                       <div class="input-group mb-3">
                          
                          <div class="input-group-prepend">
                  
                           <span class="input-group-text"><i class="fa fa-users"></i></span> 
                          </div>
                          
                           <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger"  id="selecTecnico" name="selecTecnico" required>
                             
                            <?php

                          $item = null;
                          $valor = null;
                          $tecnico = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                          foreach ($tecnico as $key => $value) {
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }
                         
                          ?>

                          </select>
                     

                       </div>   
                     
                </div>

                <div class="col-lg-3 col-xs-12">
                  
                  <br>
                  <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#modalAgregarProductoSer"><i class="fab fa-product-hunt"></i> Agregar Producto</button>
                  
                </div>

              </div>
              
                
              <!--=====================================
              ENTRADA PARA agregar servicios
              ======================================--> 
              <h4 class="text-center">Servicios</h4>
              <div class="form-group row nuevoServicios">

              </div>


               <!--=====================================
              ENTRADA PARA AGREGAR PRODUCTO
              ======================================--> 
              <h4 class="text-center">Productos</h4>
              <div class="form-group row nuevoProductoSer">
              </div>

             <!--===============================================
             =            ENVIAR LAS LISTAS EN JSON            =
             ================================================-->
             
            
               <input type="hidden" id="listaProducS" name="listaProducS">

               <input type="hidden" id="listaServicio" name="listaServicio"> 

             
                
              <!--=====================================
                  ENTRADA INPUESTO Y TOTAL
              ======================================-->
             <div class="row">

                <div class="col-lg-8 col-xs-12">

                 <h4 class="text-center">Comentarios de venta</h4>
                 
                  <div class="input-group">
                    <textarea id="summernote" class="form-control input-lg" rows="3" cols="20" name="NuevocomentarioSer" id="NuevocomentarioSer" placeholder="Comentarios"></textarea>


                  </div>

                </div>

                <div class="col-lg-4 col-xs-12">

                        <table class="table table-condensed">
                          
                          <thead>
                            
                            <tr>
                              
                              <th>Total, servicio</th>
                              <th>Total, producto</th>

                            </tr>

                          </thead>

                          <tbody>
                            
                            <tr>
                            
                            <td style="width:50%">

                              <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                                <input type="number" class="form-control input-lg" min="0.01" step="any" id="TotalServicios" name="TotalServicios" placeholder="0" total="" readonly>
                                
                                
                              </div>
                             
                            </td>

                            <td style="width:50%">

                              <div class="input-group">

                              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                              <input type="text" class="form-control input-lg" id="TotalProductoS" name="TotalProductoS" total="" placeholder="0" readonly>

                              <input type="hidden" name="totalVentaS" id="totalVentaS">
                               
                              </div>
                             
                            </td>

                          </tr>
                             
                          </tbody>

                        </table>
                  
                    
                     <label>Total orden servicio</label>
                    <div class="input-group">
                   
                      <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                      <input type="text" class="form-control input-lg" id="nuevoTotalSer" name="nuevoTotalSer" total="" placeholder="0000" readonly required>
                
                    </div>

                </div>
               
             </div>
           
              <!--=====================================
                  ENTRADA MÉTODO DE PAGO
              ======================================-->
              
              <div class="row ">
                
                 <div class="col-lg-2">
                        <label>Efectivo</label>
                        <div class="input-group">

                              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                              <input type="text" class="form-control" id="nuevoEfectivoSer" name="nuevoEfectivoSer" total="" placeholder="0000000" required>

                        </div>
                        
                  </div>

                  <div class="col-lg-2" id="CambioEfectivoSer" >
                      <label>Cambio</label>
                        <div class="input-group">

                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                            <input type="text" class="form-control" id="nuevoCambioSer" name="nuevoCambioSer" placeholder="0000000" readonly required>

                        </div>     

                  </div>

            
               <!--============================
                 =  botone            =
                 =============================-->
             
              </div>
            

            </div>
         
          <div class="col-md-3 float-sm-right">
              
            <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-cart-plus"></i>Guardar orden servicio</button>
          
          </div>
  
        
        </form>

        <?php

          $crearOrdenSevicio = new ControladorService();
          $crearOrdenSevicio -> ctrCrearOrdenService();
        
        ?>

       </div>

     </div>
    
    </section>
    <!-- /.content -->
  </div>


<!--=============================================
     MODAL AGREGAR SERVICIOS     =
==============================================-->

 <div class="modal fade" id="modalAgregarServicio">

        <div class="modal-dialog modal-lg">
  
          <div class="modal-content">
  
            <div class="modal-header bg-info">
  
              <h4 class="modal-title">Agregar servicio</h4>
  
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            
            </div>
  
            <div class="modal-body">
              
              <div class="box-body text-center">
            
                  <table class="table table-bordered table-striped dt-responsive tablaServicio" width="100%">
                    
                    <thead>
                      
                      <tr>
                 
                         <th style="width:10px">#</th>
                         <th>Nombre servicio</th>
                         <th>Costo</th>
                         <th>Opciones</th>

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

<!--=============================================
     MODAL AGREGAR PRODUCTOS     =
==============================================-->

   <div class="modal fade" id="modalAgregarProductoSer">

        <div class="modal-dialog modal-xl">
    
          <div class="modal-content">
    
            <div class="modal-header bg-info">
    
              <h4 class="modal-title">Tabla productos  <i class="
              nav-icon fab fa-product-hunt"></i> </h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            </div>

            <div class="modal-body ">
              <div class="card-body text-center">
              <table class="table table-bordered table-striped dt-responsive tablaPser "  width="100% ">
                
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
            
              <button type="button" class="btn btn-outline-danger ml-auto" data-dismiss="modal">Cerrar</button>
            
            </div>
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->