  
  <div class="content-wrapper">
    
    <section class="content-header">

      <div class="container-fluid">

        <div class="row mb-2">

          <div class="col-sm-6">

            <h1>Administrar orden de servicio</h1>

          </div>

          <div class="col-sm-6">

            <ol class="breadcrumb float-sm-right">

              <li class="breadcrumb-item"><a href="home">Inicio</a></li>

              <li class="breadcrumb-item active text-danger">Administrar ordenes de servicio</li>

            </ol>

          </div>

        </div>

      </div>

    </section>

    <section class="content">
      
     <div class="card card-outline card-primary">
       <div class="card-header">
          <?php 
            date_default_timezone_set('America/Mexico_City');

              $hoyCr = date("Y-m-d");

              $itemUsua ="id";
              $valorUsua = $_SESSION['id'];

              $respuestaUsua = ControladorUsuarios::ctrMostrarUsuarios($itemUsua, $valorUsua);
              
           ?>
          <div class="card-body row">
            
              <div class="col-md-3">
                      
                <button type="button" class="btn btn-outline-info btn-block crearOrdenServNew"><i class="fas fa-briefcase"></i>Agregar orden Servicio</button>

               </div>
                <div class="col-md-3">
                  
                </div> 
               <div class="col-lg-2">
                  
               </div>
               <div class="col-lg-2">
                  
               </div>
               <div class="col-md-2">


                </div>
               


          </div>
          

       </div>
        
        <div class="card-body ">
          <table id="example1" class="table table-bordered table-striped dt-responsive tablasOrden" width="100%" >
             <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Código</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Técnico</th>
           <th>Comentario</th>
           <th>Total</th>
           <th>Fecha</th>
           <th>Opciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = Null;
          $valor = Null;


            $respuesta = ControladorService::ctrMostrarOrdenService($item, $valor);

            foreach ($respuesta as $key => $value) {
              echo '<tr>
                    <td>'.($key+1).'</td>';
                    echo '<td>'.$value["codigo"].'</td>';

                    $itemCliente = "id";
                    $valorCliente = $value["id_cliente"];

                    $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    echo '<td>'.$respuestaCliente["nombre"].'</td>';

                    $itemUsuario = "id";
                    $valorUsuario = $value["id_vendedor"];

                    $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                    $itemTecnico = "id";
                    $valorTecnico = $value["id_tecnico"];

                    $respuestaTecnico = ControladorUsuarios::ctrMostrarUsuarios($itemTecnico, $valorTecnico);

                    echo '<td>'.$respuestaTecnico["nombre"].'</td>
                    <td>'.$value["comentarios"].'</td>
                    <td>'.number_format($value["total"],2).'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>

                      <div class="btn-group">
                      
                        <button class="btn btn-warning btnImprimirFacturaOrdenServicio" codigo="'.$value["codigo"].'" title="Imprimir orden servicio"> <i class="fas fa-file-pdf"></i> </button> ';

                        if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {

                         echo' <button class="btn btn-primary btnEditarOrdenServicio" idOrdenSer="'.$value["id"].'" title="Editar orden servicio"> <i class="fa fa-pencil-alt"></i> </button> ';

                        }  


                      if($_SESSION["perfil"] == "Administrador"){

                        echo '<button class="btn btn-danger btnEliminarOrdenServicio" idOrdenServicio="'.$value["id"].'" title="Eliminar orden servicio"><i class="fa fa-trash"></i></button>';
                      }

                     echo '</div>  

                    </td>

                  </tr>';
            }

        ?>


        </tbody>

          </table>           

          <?php

        $eliminarOrndeServicio= new ControladorService();
        $eliminarOrndeServicio-> ctrEliminarOrdenServicio();

       ?>


        </div>
        
      </div>
      
    </section>
    
  </div>
  


