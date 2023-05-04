  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Cotización</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active">Vista Cotización</li>

            </ol>

          </div>

        </div>

      </div><!-- /.container-fluid -->

    </section>



    <!-- Main content -->
    <section class="content">
      
      <div class="card card-outline card-primary">
        
        <div class="card-header">
          
          <div class="card-body row">
            
            <div class="col-md-3">
              <button type="button" class="btn btn-outline-info btn-block crearCotNew"><i class="fas fa-cart-plus"></i>Crear Cotización</button>
            </div>

          </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped ">
            <thead>

            <tr>
              <th style="width:10px">id</th>
              <th >Código</th>
              <th >Remitente</th>
              <th >Cliente</th>
              <th >Comentarios</th>
              <th >Neto</th>
              <th >Descuento</th>
              <th >Total</th>
              <th >Opciones</th>
            </tr>

            </thead>

            <tbody>

            
              <?php

                $item = null;
                $valor = null;

                $cot = ControladorCotiz::ctrMostrarCotiz($item, $valor);

               foreach ($cot as $key => $value){
                 
                  echo ' <tr>
                          <td>'.($key+1).'</td>
                          <td>'.$value["codigo"].'</td>
                          <td>'.$value["remitente"].'</td>';
                          
                          $item = "id";
                          $valor = $value["cliente"];

                          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                          echo'<td>'.$clientes["nombre"].'</td>';


                          echo'<td>'.$value["comentarios"].'</td>
                          <td>'.$value["neto"].'</td>
                          <td>'.$value["descuento"].'</td>  
                          <td>'.$value["total"].'</td>';            

                          echo '
                          <td>

                            <div class="btn-group">

                              <button class="btn btn-warning btnPdf" idCotiz="'.$value["codigo"].'" title="Imprimir boleta"><i class="fas fa-file-pdf"></i></button>

                              <button class="btn btn-primary btnEditarCotiza" idCotiza="'.$value["id"].' " title="Editar cotización"><i class="fa fa-pencil-alt"></i></button> 
                              
                               <button class="btn btn-danger btnElimCotiz" idCotiz="'.$value["id"].' " title="Eliminar cotización"><i class="fa fa-trash"></i></button> 


                            </div>  

                          </td>

                        </tr>';
                }


        ?> 

                              
            </tbody>

          </table>

        </div>
        <!-- /.card-body -->
      </div>

      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<?php

$borrarCotiz = new ControladorCotiz();
$borrarCotiz -> ctrBrorrarCotiz();
     
?>