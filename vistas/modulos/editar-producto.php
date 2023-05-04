<?php
  
  if ($_SESSION["perfil"] == "Vendedor" ) {
    
    echo '<script>

    window.location ="crear-venta";

     </script>';

  }

?>

<!-- Main content -->
<div class="content-wrapper">
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Editar Productos</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Editar productos</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>

  <section class="content">
     <div class="container-fluid">
      
      <div class="card card-outline card-primary">
        
        <div class="card-header">

            <div class="col-md-3 float-sm-right">
              <button type="button" class="btn btn-outline-danger btn-block regresarProduc"><i class="fas fa-arrow-circle-left"></i> Volver</button>
            </div>

        </div>



          <!--========================================== 
                          CONTENIDO 
            ==========================================-->
            <?php
            $idP = $_GET["idProducto"];
              $item ="id";
              $valor = $idP;
              $orden = "id";

            $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
            
            $item = "id";
            $valor = $productos["id_categoria"];

            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
          
           

        echo '<div class="card-body">
              <form role="form" method="post" enctype="multipart/form-data">
         <div class="row">
           <div class="col-md-8">
              <!-- ROW PRIMERO -->
                <div class="row"> 

                    <div class="col-md-6 ">
                            <!-- SELECCIONAR CATEGORIA -->
                       <label>Categoría</label>

                          <div class="input-group mb-3">

                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-th"></i></span>
                              </div>

                              <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger" name="editarCategoria" readonly required>
                              
                              <option id="editarCategoria" value="'.$categorias["id"].'">'.$categorias["categoria"].'</option>';
                              
                              $item1 = null;
                              $valor1 = null;

                              $categoria = ControladorCategorias::ctrMostrarCategorias($item1, $valor1);
                                foreach ($categoria as $key => $value) {
                                echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                                } 
                             
                                  
                             echo' </select>

                          </div>

                    </div>

                        <div class="col-md-3">
                               <!-- CÓDIGO DEL PRODUCTO -->
                       <label>Código</label>

                          <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-barcode"></i></i></span>
                                </div>
                                    
                                    <input type="text" class="form-control" value="'.$productos["codigo"].'" name="editarCodig" id="editarCodig" readonly required>
                          </div>

                    </div>
                           
                    <div class="col-md-3 ">
                            <!-- ENTRADA PARA NUMERO DE SERIE -->
                       <label>Número de serie</label>

                          <div class="input-group mb-3">
                                  
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-code"></i></span>
                              </div>

                              <input type="text" class="form-control" value="'.$productos["nSerie"].'" name="editarNumSerie" id="editarNumSerie" required>
                          </div>

                    </div>
                 
                </div>
                  <!-- ROW SEGUNDO -->
                <div class="row">
                    <div class="col-md-12">
                           <!-- COLUMNA DOS DE DATOS DEL PRODUCTO -->
                       <label>Descripción</label>

                          <div class="input-group mb-3">
                                
                               <div class="input-group-prepend">
                                 <span class="input-group-text"><i class="fab fa-product-hunt"></i></i></span>
                               </div>

                                 <input type="text" class="form-control"value="'.$productos["descripcion"].'" id="editarDescripcion" name="editarDescripcion" required>
                          </div>
                    </div> 
                          
                 </div>
                   <!-- ROW TERCER -->
                 <div class="row">
                    <div class="col-md-6">
                            <!-- ENTRADA PARA  MARCA-->  
                            <label>Marca</label>

                            <div class="input-group mb-3">
                              
                                <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                                </div>

                              <input type="text" class="form-control" value="'.$productos["marca"].'" name="editarMarca" id="editarMarca" required>
                            </div>
                         
                    </div>


                    <div class="col-md-3">
                            <!-- ENTRADA PARA CANTIDAD -->
                       <label>Cantidad</label>

                          <div class="input-group mb-3">
                              
                               <div class="input-group-prepend">
                                   <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                               </div>

                               <input type="number" class="form-control" value="'.$productos["stock"].'" name="editarCantidad" id="editarCantidad" required>
                          </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6">                       
                        <!-- ENTRADA PARA UNIDAD DE MEDIDA -->
                       <label>Unidad de medida</label>

                          <div class="input-group mb-3">

                               <div class="input-group-prepend">
                               <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                               </div>

                               <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger" name="editarUnidadMedida" id="editarUnidadMedida">
                              
                               <option value="'.$productos["medida"].'">'.$productos["medida"].'</option>
                               <option value="M">M</option>
                               <option value="Pza">Pza</option>
                               <option value="Kg">Kg</option>
                              
                              </select>

                          </div>
                    </div>
                               
                 </div>

                   <!-- ROW CUARTO -->
                 <div class="row">
                   
                    <!-- PRECIO COMPRA -->
                    <div class="col-md-4 ">
                          <!-- ENTRADA PRECIO COMPRA -->
                        <label>Precio de compra</label>
                        <div class="input-group mb-3">

                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                          </div>
                          
                          <input type="number" class="form-control" value="'.$productos["precio_compra"].'" name="editarPrecioCompra" id="editarPrecioCompra"   step="any" required>
                        </div>
                    </div>

                    <!-- CHECKBOX PARA PORCENTAJE -->

                        <div class="col-md-2 ">
                          <br>
                          <div class="form-group">
                            <label >
                              
                              <input type="checkbox" class="porcentaje" id="porcentaje" checked>
                              Utilizar porcentaje
                            </label>
                          </div>
                        </div>
                        <!-- ENTRADA PARA PORCENTAJE -->
                        <div class="col-md-2">
                          <label>
                            
                          </label>
                          <div class="input-group mb-3">

                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-percent"></i></span>
                          </div>
                            
                          <input type="number" class="form-control input-lg nuevoPorcentaje" min="0"  value="16">
                        </div>
                        </div>


                    <div class="col-md-4">
                          <!-- ENTRADA PRECIO  VENTA 1 -->
                        <label>Precio de venta</label>
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                          </div>
                          <input type="number" class="form-control" value="'.$productos["precio_venta"].'" id="editarPrecioVenta" name="editarPrecioVenta" step="any" readonly  required>
                        </div>

                    </div>
                 </div>
                 <!-- ROW QUINTO -->
                 <div class="row">
                    <div class="col-md-4">
                                 
                            <!-- ENTRADA PRECIO  MAYOREO -->

                            <label>Precio mayoreo</label>

                            <div class="input-group mb-3">

                              <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                              </div>
                              
                              <input type="number" class="form-control" value="'.$productos["precio_ventaa"].'" id="editarPrecioMayoreo" name="editarPrecioMayoreo" step="any" required>
                            </div>
                    </div>
                    <div class="col-md-4">
                                   
                        <!-- ENTRADA PRECIO  VENTA 3 -->

                        <label>Apartir de cuantos</label>

                        <div class="input-group mb-3">

                            <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                
                            <input type="number" class="form-control" value="'.$productos["precio_ventaaa"].'" id="editarApartir" name="editarApartir" required>
                        </div>

                    </div>

                 </div>

       </div>
       <div class="col-md-4">
         
                   <!--========================================== 
                                      FOTO
                    ==========================================-->
                        <!-- ENTRADA PARA FOTO -->

                        <label>Foto del producto</label>

                        <div class="panel" style="padding-left: 200px;">SUBIR FOTO</div> 

                          <div class="form-group">';
                      if ($productos["imagen"] !="") {
                        
                        echo '<img src="'.$productos["imagen"].'" class="img-fuld img-responsive previsualizar" style="max-width:100%;width:370px;height:350px;">';
                        
                          } else {
                        
                        echo '<img src="vistas/img/productos/default/anonymous.png" class="img-fuld img-responsive previsualizar" style="max-width:100%;width:370px;height:350px;">';
                        
                          }

                         echo '<input type="hidden" name="imagenActual" id="imagenActual" value="'.$productos["imagen"].'">';  
                            
                          echo '  <div class="input-group" >
                              <div class="custom-file">
                                <input type="file" class="nuevaImagen" name="editarImagen">
                                <label class="custom" for="exampleInputFile"></label>
                                
                              </div>
                            </div>
                  
                  </div>
               </div>
             </div>';
            
            ?>

              <div class="col-md-3 float-sm-left">
                <button type="submit" class="btn btn-outline-primary btn-block regresarProduc"><i class="fas fa-archive"></i>Guardar producto</button>
              </div>
                
                <?php

                  $editarProducto = new ControladorProductos();
                  $editarProducto -> ctrEditarProductos();
                ?>

            </form>

          </div>

        </div>
        
      </div>
      <!-- /.container-fluid -->
    </section>

</div>   

