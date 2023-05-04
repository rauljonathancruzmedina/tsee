<?php
  
  if ($_SESSION["perfil"] == "Vendedor") {
    
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

          <h1>Agregar Productos</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>

            <li class="breadcrumb-item active text-danger">Agregar productos</li>

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
        <div class="card-body">
              <form role="form" method="post" enctype="multipart/form-data">
          <div class="row">

            <div class="col-md-8">
                
              <!-- ROW PRIMERO -->
              <div class="row"> 

                 
                <!-- SELECCIONAR CATEGRORIA -->
                <div class="col-md-6 ">
                      
                   <label>Categoría</label>

                  <div class="input-group mb-3">

                    <select class="select2 input-lg" data-placeholder="Selecccionar categoría" data-dropdown-css-class="select2-purple" style="width: 100%;" name="nuevaCategoria">
                      <option value="">Seleccionar Categoría</option>
                      <?php 

                          $item = null;
                          $valor = null;

                          $categoria = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                           foreach ($categoria as $key => $value){   ?>
                       

                        <option value="<?php echo $value["id"]; ?>"><?php echo $value["categoria"]; ?></option>

                      <?php } ?>


                    </select>

                  </div>

                </div>

                <!-- CÓDIGO DEL PRODUCTO -->
                <div class="col-md-3">
                     <!-- CÓDIGO DEL PRODUCTO -->
                  <label>Código</label>

                  <div class="input-group mb-3">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-barcode"></i></i></span>
                    </div>
                                
                    <input type="text" class="form-control" name="nuevoCodig" id="nuevoCodig" placeholder="Ingresa Código" required>
                  </div>

                </div>


                <!-- CÓDIGO DEL PRODUCTO -->
                <div class="col-md-3 ">
                    <!-- ENTRADA PARA NUMERO DE SERIE -->
                  <label>Número de serie</label>

                  <div class="input-group mb-3">
                          
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-code"></i></span>
                    </div>

                    <input type="text" class="form-control" name="nuevoNumSerie" id="nuevoNumSerie" placeholder="Número de serie" required>

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

                     <input type="text" class="form-control" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

                  </div>

                </div>  
                   
      
              </div>

                 <!-- ROW TERCER -->
              <div class="row">
              
                <!-- ENTRADA PARA MARCA -->
                <div class="col-md-6">
                    <!-- ENTRADA PARA  MARCA-->  
                  <label>Marca</label>

                  <div class="input-group mb-3">
                    
                    <div class="input-group-prepend">
                       <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
                    </div>

                    <input type="text" class="form-control" name="nuevaMarca" id="nuevaMarca" placeholder="Ingresar marca" required>

                  </div>
                         
                </div>    

                <!-- ENTRADA PARA CANTIDAD -->
                <div class="col-md-3">
                          
                  <label>Cantidad</label>

                  <div class="input-group mb-3">
                      
                       <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-sort-numeric-up-alt"></i></span>
                       </div>

                       <input type="number" class="form-control" name="nuevaCantidad" id="nuevaCantidad" placeholder="Cantidad" required>
                  </div>

                </div>

                  <!-- ENTRADA PARA UNIDAD DE MEDIDA -->
                <div class="col-md-3 col-sm-6">                       
                        
                  <label>Unidad de medida</label>

                  <div class="input-group mb-3">

                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-balance-scale"></i></span>
                    </div>

                    <select class="form-control select2 select2-danger input-lg" data-dropdown-css-class="select2-danger" name="nuevaUnidadMedida" id="nuevaUnidadMedida">
                      
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
                    
                    <input type="number" class="form-control" name="nuevoPrecioCompra" id="nuevoPrecioCompra" step="any" placeholder="Ingresar precio compra" required>
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
                      
                    <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="16">
                  </div>
                </div>

                <!-- ENTRADA PRECIO  VENTA 1 -->
                <div class="col-md-4">
                          
                  <label>Precio de venta</label>
                  <div class="input-group mb-3">

                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>

                    <input type="number" class="form-control" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any"  placeholder="Ingresar precio venta" required>

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
                    
                    <input type="number" class="form-control" id="nuevoPrecioMayoreo" name="nuevoPrecioMayoreo" step="any" placeholder="Ingresar precio mayoreo">
                  </div>

                </div>


                <!-- ENTRADA PRECIO  VENTA 3 -->
                <div class="col-md-4">

                  <label>Apartir de cuantos</label>

                  <div class="input-group mb-3">

                      <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                          </div>
                          
                      <input type="number" class="form-control" id="nuevoApartir" name="nuevoApartir" placeholder="Ingresar Apartir de cuantos" >
                  </div>

                </div>


              </div>

            </div>


            <!--========================================== 
                                  FOTO
                ==========================================-->
                
            <div class="col-md-4">
                 
                <!-- ENTRADA PARA FOTO -->

                <label>Foto del producto</label>

                  <div class="panel" style="padding-left: 200px;">SUBIR FOTO</div> 

                <div class="form-group">
                  
                  <img src="vistas/img/productos/default/anonymous.png" class="img-fuld img-responsive previsualizar" style="max-width:100%;width:370px;height:350px;">
                  
                  <div class="input-group" >
                  
                    <div class="custom-file">
                  
                      <input type="file" class="nuevaImagen" name="nuevaImagen">
                      <label class="custom" for="exampleInputFile"></label>
                  
                    </div>
                  
                  </div>
                  
                </div>


            </div>

          </div>

            <div class="col-md-3 float-sm-left">
              <button type="submit" class="btn btn-outline-primary btn-block regresarProduc"><i class="fas fa-archive"></i>Guardar producto</button>
            </div>
              
            <?php

                $crearNuevoProducto = new ControladorProductos();
                $crearNuevoProducto -> ctrCrearProductos();

            ?>

            </form>

        </div>

      </div>
        
    </div>
      <!-- /.container-fluid -->
  </section>

</div>   

