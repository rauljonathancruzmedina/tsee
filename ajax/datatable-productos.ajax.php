<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";


class TablaProductos{

  /*=============================================
   MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

  public function mostrarTablaProductos(){

    $item = null;
    $valor = null;
    $orden = "id";
      $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);  
    
      $datosJson = '{
      "data": [';

      for($i = 0; $i < count($productos); $i++){

        /*=============================================
      TRAEMOS LA IMAGEN
        =============================================*/ 

        $imagen = "<img src='".$productos[$i]["imagen"]."' width='60px'>";

        /*=============================================
      TRAEMOS LA CATEGORÍA
        =============================================*/ 

        $item = "id";
        $valor = $productos[$i]["id_categoria"];

        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


        $stock = $productos[$i]["stock"];
        /*=============================================
      STOCK
        ============================================= */

        if($productos[$i]["stock"] <= 10){

          $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

        }else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){

          $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

        }else{

          $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

        }

        /*=============================================
      TRAEMOS LAS ACCIONES perfilOculto
        =============================================*/ 

      if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Sub administrador"){
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto' title='Editar producto'><i class='fa fa-pencil-alt'></i></button></div>"; 
      }else {

        $botones =  "<div class='btn-group'><button class='btn btn-primary btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto' title='Editar producto'><i class='fa fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."' title='Eliminar producto'><i class='fa fa-trash'></i></button></div>";

      }

        $datosJson .='[
            "'.($i+1).'",
            "'.$productos[$i]["descripcion"].'",
            "'.$productos[$i]["marca"].'",
            "'.$productos[$i]["codigo"].'",
            "'.$productos[$i]["nSerie"].'",
            "'.$categorias["categoria"].'",
            "'.$stock.'",
            "'.$productos[$i]["medida"].'",
            "$'.number_format($productos[$i]["precio_compra"],2).'",
            "$'.number_format($productos[$i]["precio_venta"],2).'",
            "'.$imagen.'",
            "'.$botones.'"
          ],';

      }

      $datosJson = substr($datosJson, 0, -1);

     $datosJson .=   '] 

     }';
    
    echo $datosJson;


  }


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();

