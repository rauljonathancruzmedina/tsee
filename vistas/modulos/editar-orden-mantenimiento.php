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

            <h1>Editar Orden Servicio</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Editar orden servicio</li>

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

                      <?php

            $item = "id";
            $valor = $_GET["idOrdenSer"];

            $ordenServicio = ControladorService::ctrMostrarOrdenService($item, $valor);
            

            $item = "id";
            $valor = $ordenServicio["id_tecnico"];
            $tecnicoA = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

             ?>

                    <div class="col-lg-5 col-xs-12">
                        <label>Vendedor</label>
                        <div class="input-group mb-3">
                          <?php
                          $item = "id";
                          $valor = $ordenServicio["id_vendedor"];
                          $vendedor = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                          ?>
                         <div class="input-group-prepend">
                            
                         <span class="input-group-text"><i class="fa fa-user"></i></span> 
                         </div>
                        
                         <input type="text" class="form-control" id="idVendedorS" name="idVendedorS" value="<?php echo $vendedor["nombre"]; ?>" readonly>
                        
                         <input type="hidden" name="idVendedorSe" value="<?php echo $vendedor["id"]; ?>"> 
      
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

                             <input type="text" class="form-control" id="CodiOrdenSerEditar" name="CodiOrdenSerEditar" value="<?php echo $ordenServicio["codigo"] ?>" readonly>
                           
                          
                        </div>
                         
                    </div>
                <!--==================================
                =            CODIGO VENTA            =
                ===================================-->

                    <?php
                          
                         
                    if ($ordenServicio["codigoV"] == 0) {
                            
                          $item = null;
                          $valor = null;

                           $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);    

                           if (!$ventas) {
                             echo '<input type="hidden" class="form-control" id="nuevaVentas" name="nuevaVentas" value="10001" readonly>';
                           }else {
                            
                             foreach ($ventas as $key => $value) {
                               # code...
                             }
                             $codigo = $value["codigo"] + 1;
                             
                             echo '<input type="hidden" class="form-control" id="nuevaVentas" name="nuevaVentas" value="'.$codigo.'" readonly>';
                           }
                    }else{
                          
                           $item = "codigo";
                           $valor = $ordenServicio["codigoV"];

                           $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                             echo '<input type="hidden" class="form-control" id="nuevaVentas" name="nuevaVentas" value="'.$ordenServicio["codigoV"].'" readonly> 

                             <input type="hidden" class="form-control" id="idVenta" name="idVenta" value="'.$venta["id"].'" readonly>';
                         

                             
                        }
 
                      ?>

                          
                     <!--=====================================
                      BOTÓN PARA AGREGAR PRODUCTO            
                      ======================================-->
                    <div class="col-lg-3 col-xs-6">
                      <br>

                     <div class="input-group mb-3">    

                        <div class="input-group">
                  
                      <button  type="button" class="btn btn-outline-info btn-block" data-toggle="modal" id="Agregarser" data-target="#modalEditarServicio"><i class="fas fa-briefcase"></i> Agregar Servicio</button>

                  
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
                                                   
                          <?php

                          $item = "id";
                          $valor = $ordenServicio["id_cliente"];
                          $cliente = ControladorClientes::ctrMostrarClientes($item, $valor);
                           
                          echo '<input type="text" class="form-control" name="selecCliente"  id="selecCliente" value="'.$cliente["nombre"].'" readonly>

                            <input type="hidden" name="idCliente" value="'.$cliente["id"].'">';
                              
                          ?>
                   
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
                             
                          <option value="<?php echo $tecnicoA["id"] ?>"><?php echo $tecnicoA["nombre"] ?></option>

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


                  <?php 

                  $listarServicios = json_decode($ordenServicio["servicios"], true);
                  
                
                  foreach ($listarServicios as $key => $value) {
                    
                    echo'  <div class="row" style="padding:5px 15px">

                      <!-- Nombre del servicio -->
                    
                      <div class="col-lg-8" style="padding-right:0px">
                        
                       <div class="input-group mb-3">

                        <div class="input-group">
                          
                          <span class="input-group-addon"><button type="button" class="btn btn-danger quitarServicio" idService="'.$value["id"].'"><i class="fa fa-trash"></i></button></span>

                          <input type="text" class="form-control nuevoNombreServicio" idService="'.$value["id"].'" name="agregarServisio" value="'.$value["nombre"].'" readonly required>

                        </div>

                       </div>


                      </div>

                      <!-- Precio del servicio -->

                      <div class="col-lg-4 Prec">
                      
                        <div class="input-group mb-3">

                          <div class="input-group">
                          
                            <span class="input-group-text"><i class="ion ion-social-usd"></i></span> 

                            <input type="number" class="form-control nuevoPrecioServ" name="nuevoPrecioServ" value="'.$value["precio"].'" readonly> 

                          </div>

                        </div>  

                    </div>
                    
                  </div>';
                  }

                  ?>

              </div>


               <!--=====================================
              ENTRADA PARA AGREGAR PRODUCTO
              ======================================--> 
              <h4 class="text-center">Productos</h4>
              <div class="form-group row nuevoProductoSer">

                 <?php 

                  
                if ($ordenServicio["productos"] != null && $ordenServicio["productos"] != " " ) {

                   $listarProductosS = json_decode($ordenServicio["productos"], true);
                   
                   foreach ($listarProductosS as $key => $value) {
                      
                       $item = "id";
                        $valor = $value["id"];
                        $orden = "null";

                        $respuestaS = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                        $descripcionS = $respuestaS["descripcion"];
    
                        $precioS = $respuestaS["precio_venta"];
                      
                        $stockS = $respuestaS["stock"];
                      
                        $precioMS = $respuestaS["precio_ventaa"];

                        $apartirDS = $respuestaS["precio_ventaaa"];

                        $AntiguoStockS = $respuestaS["stock"] + $value["cantidad"];

                        echo '<div class="row" style="padding:5px 15px">

                         <div class="col-lg-6 col-xs-12" >
                             
                            <div class="input-group mb-3">
                              
                            <div class="input-group">
                              
                              <span class="input-group-addon"><button type="button" class="btn btn-danger btn-info quitarProductoS" idProducto="'.$value["id"].'"><i class="fas fa-trash-alt"></i></button></span>

                              <input type="text" class="form-control nuevaDescripcionProductoS" idProducto="'.$value["id"].'" name="agregarProductoS" value="'.$descripcionS.'" readonly required>
                            
                               </div>
                            
                            </div>
                          
                          </div> 
                          

                          
                         <div class="col-lg-2 col-xs-12 precioColS" >
                          
                            <div class="input-group mb-3">
                          
                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>    
                            
                            <input type="text" class="form-control nuevoPrecioProductoS" name="nuevoPrecioProductoS" value="'.$value["precio"].'" precioMeS ="'.$precioS.'" readonly required>
                            
                            <input type="hidden" class="form-control nuevoPrecioMayoreoS" name="nuevoPrecioMayoreoS" value="'.$precioMS.'" readonly required>             

                            </div>
                            
                          </div>

               

                          
                           <div class="col-lg-1 col-xs-12 cantidadProducto">
                            
                            <div class="input-group mb-3">
                            
                            <input type="number" class="form-control nuevaCantidadProductoS" name="nuevaCantidadProductoS" min="0.25" step="any" value="'.$value["cantidad"].'" stockS="'.$AntiguoStockS.'" nuevoStockS="'.$stockS.'" apartirDeS="'.$apartirDS.'" required>
                                    
                          </div>
                          
                          </div> 

                           <div class="col-lg-2 col-xs-12" >
                          
                            <div class="input-group mb-3">
                          
                            <div class="input-group-prepend">
                          
                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>
                          
                            </div>     
                          
                            <input type="text" class="form-control totalS"  name="totalS" value="'.$value["total"].'" readonly required>
                          
                            </div>
                            
                          </div>

                          </div>';

                   }
                 }
         
                 ?>

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
                    <textarea id="summernote" class="form-control input-lg" rows="3" cols="20" name="NuevocomentarioSer" id="NuevocomentarioSer" ><?php echo $ordenServicio["comentarios"] ?></textarea>

                   
                     
                  </div>

                </div>

                <div class="col-lg-4 col-xs-12">

                        <table class="table table-condensed">
                          
                          <thead>
                            
                            <tr>
                              
                              <th>Total Servicio</th>
                              <th>Total Producto</th>

                            </tr>

                          </thead>

                          <tbody>
                            
                            <tr>
                            
                            <td style="width:50%">

                              <div class="input-group">

                                <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                                <input type="number" class="form-control input-lg" min="0.01" step="any" id="TotalServicios" name="TotalServicios" value="<?php echo $ordenServicio["totalS"] ?>" total="" readonly>
                                
                                
                              </div>
                             
                            </td>

                            <td style="width:50%">

                              <div class="input-group">

                              <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                              <input type="text" class="form-control input-lg" id="TotalProductoS" name="TotalProductoS" total="" value="<?php echo $ordenServicio["totalP"] ?>" readonly>

                             
                               
                              </div>
                             
                            </td>

                          </tr>
                             
                          </tbody>

                        </table>
                  
                    
                     <label>Total Orden Servicio</label>
                    <div class="input-group">
                   
                      <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                      <input type="text" class="form-control input-lg" id="nuevoTotalSer" name="nuevoTotalSer" total="" value="<?php echo $ordenServicio["total"] ?>" readonly>
                
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

                              <input type="text" class="form-control" id="nuevoEfectivoSer" name="nuevoEfectivoSer" total="" value="<?php echo $ordenServicio["importe"] ?>" required>

                        </div>
                        
                  </div>

                  <div class="col-lg-2" id="CambioEfectivoSer" >
                      <label>Cambio</label>
                        <div class="input-group">

                            <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>

                            <input type="text" class="form-control" id="nuevoCambioSer" name="nuevoCambioSer" value="<?php echo $ordenServicio["cambio"] ?>" readonly>

                        </div>     

                  </div>

            
               <!--============================
                 =  botone            =
                 =============================-->
             
              </div>
            

            </div>

          <div class="col-md-3 float-sm-right">
              
            <button type="submit" class="btn btn-outline-primary btn-block"><i class="fas fa-cart-plus"></i>Guardar Orden servicio</button>
          
          </div>
  
        
        </form>

       <?php

          $editarOrdenSevicio = new ControladorService();
          $editarOrdenSevicio -> ctrEditarOrdenService();
         
        ?>
        
       </div>

     </div>
    
    </section>
    <!-- /.content -->
  </div>


<!--=============================================
     MODAL AGREGAR SERVICIOS     =
==============================================-->

 <div class="modal fade" id="modalEditarServicio">

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
                      
                      <tr >
                 
                         <th style="width:10px">#</th>
                         <th>Nombre Servicio</th>
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
    
          <div class="modal-content ">
    
            <div class="modal-header bg-info">
    
              <h4 class="modal-title">Tabla productos  <i class="
              nav-icon fab fa-product-hunt"></i> </h4>
              
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            
            </div>

            <div class="modal-body ">
              <div class="card-body text-center">
              <table class="table table-bordered table-striped dt-responsive tablaPser "  width="100% ">
                
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
            
              <button type="button " class="btn btn-danger ml-auto" data-dismiss="modal">Cerrar</button>
            
            </div>
          
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->