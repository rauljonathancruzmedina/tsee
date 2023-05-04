<?php

class ControladorCotiz{


        /* ======================================== 
                    MOSTRAR COTIZACIONES
        ========================================*/

    static public function ctrMostrarCotiz($item, $valor){

        $tabla = "cotizacion";

        $respuesta = ModeloCotiz::MdlMostrarCotiz($tabla, $item, $valor);

        return $respuesta;
    }

        /* ======================================== 
                    CREAR COTIZACIONES
        ========================================*/

    static public function ctrCrearCotixacion(){

      if (isset($_POST["CodVent"])) {
        
          $tabla = "cotizacion";

          $datos = array("remitente"=>$_POST["nueVend"],
                         "codigo"=>$_POST["CodVent"], 
                         "cliente"=>$_POST["NuevCliente"],
                         "productos"=>$_POST["listaProductC"],
                         "comentarios"=>$_POST["NuevoComen"],
                         "descuento"=>$_POST["nuevoDescuentoVenta"],
                         "neto"=>$_POST["nuevoPrecioNet"],
                         "total"=>$_POST["nuevoTotalVen"]);

          $respuesta = ModeloCotiz::mdlCrearCotiz($tabla, $datos);

          if ($respuesta == "ok") {
            
              echo '<script>

                  Swal.fire({
                    type: "success",
                    icon: "success",
                    title: "¡Bien hecho!",
                    text: "¡La cotización ha sido creada correctamente.!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                  }).then(function(result){

                    if(result.value){
                    
                      window.location = "cotizacion";

                    }

                  });

              </script>';

          }

      }


    }

        /* ======================================== 
                      BORRAR COTIZACIONES
        ========================================*/

    static public function ctrBrorrarCotiz(){

      if (isset($_GET["idCotiz"])) {
        
          $tabla = "cotizacion";
          $dato = $_GET["idCotiz"];

          $respuesta = ModeloCotiz::mdlBorrarCotiz($tabla, $dato);

          if ($respuesta == "ok") {
           
            echo '<script>

                    Swal.fire({
                      type: "success",
                      icon: "success",
                      title: "¡Bien hecho!",
                      text: "¡La cotización ha sido borrada correctamente!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"

                    }).then(function(result){

                      if(result.value){
                      
                        window.location = "cotizacion";

                      }

                    });

                </script>';

          }

      }

    }



    /*--=====================================
        EDITAR CATEGORIA
    ======================================-->*/

    static public function ctrEditCotixacion(){
      
      if(isset($_POST["EdVend"])){

        /*=============================================
        GUARDAR LA COMPRA
        =============================================*/ 

        $tabla = "cotizacion";

          $datos = array("remitente"=>$_POST["EdVend"],
                         "id"=>$_POST["id"],
                         "codigo"=>$_POST["EdCodVent"],
                         "fecha"=>$_POST["EdFecha"],   
                         "cliente"=>$_POST["EdCliente"],
                         "productos"=>$_POST["listaProductC"],
                         "comentarios"=>$_POST["EdComen"],
                         "descuento"=>$_POST["nuevoDescuentoVenta"],
                         "neto"=>$_POST["nuevoPrecioNet"],
                         "total"=>$_POST["nuevoTotalVen"]);

        $respuesta = ModeloCotiz::mdlEditVenta($tabla, $datos);

        if($respuesta == "ok"){
          
          echo'<script>

          Swal.fire({
              type: "success",
              icon: "success",
              title: "¡Bien hecho!",
              text: "¡La cotizacion ha sido guardada correctamente.!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
                  if (result.value) {

                  window.location = "cotizacion";

                  }
                })

          </script>';

        }


      }   
    
    }  

}