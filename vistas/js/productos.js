/*=====================================================
CARGAR LA TABLA DINÀMICA DE PRODUCTOS
=====================================================*/
/*$.ajax({

	url: "ajax/datatable-productos.ajax.php",
	success:function(respuesta){
		console.log("respuesta", respuesta);
	}
})
*/
var perfilOculto = $("#perfilOculto").val();

 $(".tablaProduct").DataTable({
    
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
      "language": {

            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
            },
            "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
          },
    })



/*=====================================================
CAPTURANDO LA CATEGORIA PARA  ASIGNAR CÓDIGO
=====================================================
    $("#nuevaCategoria").change(function(){
      
      var idCategoria = $(this).val();


      var datos = new FormData();
      datos.append("idCategoria", idCategoria);
      $.ajax({

        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){
          
          if(!respuesta){ 

             var nuevoCodigo = idCategoria+"01"; 
             $("#nuevoCodig").val(nuevoCodigo);
          
          }else{
          
            var nuevoCodigo =Number(respuesta["codigo"])+1;
            $("#nuevoCodig").val(nuevoCodigo);

          }
          
        }

      })
    })
*/


/*-=====================================
= AGREGANDO PRECIO VENTA           =
======================================*/

$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){
   
    if ($(".porcentaje").prop("checked")) {
       
       var  valorPorcentaje = $(".nuevoPorcentaje").val();
      
       var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

       var editarPorcentaje =Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
       
       $("#nuevoPrecioVenta").val(porcentaje);

       $("#nuevoPrecioVenta").prop("readonly",true);

        $("#editarPrecioVenta").val(editarPorcentaje);

       $("#editarPrecioVenta").prop("readonly",true);
    }
 
})

/*-=====================================
=   CAMBIO DE PORCENTAJE          =
======================================*/

$(".nuevoPorcentaje").change(function(){

   if($(".porcentaje").prop("checked")) {

       var  valorPorcentaje = $(".nuevoPorcentaje").val();

       var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

       var editarPorcentaje =Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
       
       
       $("#nuevoPrecioVenta").val(porcentaje);

       $("#nuevoPrecioVenta").prop("readonly",true);

      $("#editarPrecioVenta").val(editarPorcentaje);

       $("#editarPrecioVenta").prop("readonly",true);
    }

})
/*-=====================================
=  VERIFICAR SI ESTA ACTIVADO EL CHECKBOX          =
======================================*/ 
  $(document).ready(function(){
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                console.log("Checkbox is checked.");
                $("#nuevoPrecioVenta").prop("readonly",true);
                  $("#editarPrecioVenta").prop("readonly",true);
            }
            else if($(this).prop("checked") == false){
                console.log("Checkbox is unchecked.");
                   $("#nuevoPrecioVenta").prop("readonly",false);
                   $("#editarPrecioVenta").prop("readonly",false);
            }
        });
    });
/*==================================================
        SUBIR FOTO DE PRODUCTOS
==================================================*/

$(".nuevaImagen").change(function(){

  var imagen = this.files[0];

  /*==================================================
        VALIDAR EL FORMATO DE LA IMAGEN PNG OH JPG
  ==================================================*/

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {

    $(".nuevaImagen").val("");

      $(function() {
          var Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000
          });
          
            Toast.fire({
              icon: "error",
              title: "¡Error!, La imagen debe estar en formato PNG o JPG.!"
            })
          
      });     


  } else {

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){

      var rutaImagen = event.target.result;

      $(".previsualizar").attr("src", rutaImagen);

    })

  }
})

/*--=====================================
=            EDITAR PRODUCTO            =
======================================*/
$(".tablaProduct tbody").on("click", ".btnEditarProducto", function(){
  console.log("ruso");
    var idProducto =$(this).attr("idProducto");
    window.location = "index.php?ruta=editar-producto&idProducto="+idProducto;
   
})
   

$(".tablaProduct tbody").on("click", ".btnEliminarProducto", function(){
    var idProducto =$(this).attr("idProducto");
    var codigo =$(this).attr("codigo");
    var imagen =$(this).attr("imagen");
    Swal.fire({
    title: '¿Está seguro de borrar el producto?',
    text: '¡Si no lo está puede cancelar la accion!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor:'#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar producto!'
   }).then((result)=>{

    if (result.value) {
      window.location ="index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
    }

   })
   
})
   

 
 $(document).on("click", ".agregarProduc", function(){

    window.location = "index.php?ruta=agregar-productos";

})  


$(document).on("click", ".regresarProduc", function(){

    window.location = "index.php?ruta=productos";

})  


$(document).on("click", ".crearVentaNew", function(){

    window.location = "index.php?ruta=crear-venta";

}) 

$(document).on("click", ".crearCotNew", function(){

    window.location = "index.php?ruta=crear-cotizacion";

}) 

$(document).on("click", ".crearOrdenServNew", function(){

    window.location = "index.php?ruta=crear-orden-mantenimiento";

}) 