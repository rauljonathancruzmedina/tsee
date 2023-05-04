$('.tablaPser').DataTable( {
    "ajax": "ajax/datatable-servicio-produc.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
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

  }

});

$(".tablaPser tbody").on("click", "button.agregarProductoS", function(){

  var idProducto = $(this).attr("idProducto");

  $(this).removeClass("btn-primary agregarProductoS");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idProducto",idProducto);

  $.ajax({
    url:"ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType:false,
    processData: false,
    dataType: "json",
    success:function(respuesta){
      var descripcionS = respuesta["descripcion"];
    
      var precioS = respuesta["precio_venta"];
    
      var stockS = respuesta["stock"];
    
      var precioMS = respuesta["precio_ventaa"];

      var apartirDS = respuesta["precio_ventaaa"];


      /*====================================================
      EVITAR AGREGAR PRODUCTO CUANDO EL STOCK ESTÁ EN CERO 
      ====================================================*/
        
      if (stockS == 0) {
        
        var Toast = Swal.mixin({
             toast: "true",
             position: "top-end",
             showConfirmButton: "false",
             timer: "3000"
             });
  
             Toast.fire({
               icon: "error",
               title: "No hay stock disponible."});

        $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProductoS");

        return;    
      }

      $(".nuevoProductoSer").append(

      '<div class="row" style="padding:5px 15px">'+
        
            /*-- Descripción del producto --*/

           '<div class="col-lg-6 col-xs-12">'+
               
              '<div class="input-group mb-3">'+
                
              '<div class="input-group">'+
                
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-info quitarProductoS" idProducto="'+idProducto+'"><i class="fas fa-trash-alt"></i></button></span>'+

                '<input type="text" class="form-control nuevaDescripcionProductoS" idProducto="'+idProducto+'" name="agregarProductoS" value="'+descripcionS+'" readonly required>'+
              
                 '</div>'+
              
              '</div>'+
            
            '</div>'+ 
            /*==================================
            =            PRECIO VENTA            =
            ===================================*/
            
           '<div class="col-lg-2 col-xs-12 precioColS" >'+
            
              '<div class="input-group mb-3">'+
            
              '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+    
              
              '<input type="text" class="form-control nuevoPrecioProductoS" name="nuevoPrecioProductoS" value="'+precioS+'" precioMeS ="'+precioS+'" readonly required>'+
              
              '<input type="hidden" class="form-control nuevoPrecioMayoreoS" name="nuevoPrecioMayoreoS" value="'+precioMS+'" readonly required>'+             

              '</div>'+
              
            '</div>'+

 

            '<!-- Cantidad del producto -->'+
             '<div class="col-lg-1 col-xs-12 cantidadProducto">'+
              
              '<div class="input-group mb-3">'+
              
              '<input type="number" class="form-control nuevaCantidadProductoS" name="nuevaCantidadProductoS" min="0.25" step="any" value="0" stockS="'+stockS+'" nuevoStockS="'+stockS+'" apartirDeS="'+apartirDS+'" required>'+
                      
            '</div>'+
            
            '</div>'+ 

            '<!-- Precio del producto -->'+
             '<div class="col-lg-2 col-xs-12" >'+
            
              '<div class="input-group mb-3">'+
            
              '<div class="input-group-prepend">'+
            
              '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+
            
              '</div>'+     
            
              '<input type="text" class="form-control totalS"  name="totalS" value="" readonly required>'+
            
              '</div>'+
              
            '</div>'+

            '</div>')

            // SUMAR TOTAL DE PRECIOS
              sumarTotalPreciosS()

              sumarTotalDelServicio()


       //AGRUPAR PRODUCTOS EN FORMATO JSON
       listarProductosSER()
      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS
      /*$(".nuevoPrecioProductoS").number(true, 2);
      $(".total").number(true, 2);*/

    }
  })
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaPser").on("draw.dt", function(){

  if(localStorage.getItem("quitarProductoS") != null){

    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProductoS"));

    for(var i = 0; i < listaIdProductos.length; i++){

      $("button.recuperarBotonS[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
      $("button.recuperarBotonS[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-info agregarProductoS');

    }


  }


})

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProductoSER = [];

localStorage.removeItem("quitarProductoS");

$(".formularioServi").on("click", "button.quitarProductoS", function(){

  $(this).parent().parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if(localStorage.getItem("quitarProductoS") == null){

    idQuitarProductoSER = [];
    
  }else{

    idQuitarProductoSER.concat(localStorage.getItem("quitarProductoS"));

  }

  idQuitarProductoSER.push({"idProducto":idProducto});

  localStorage.setItem("quitarProductoS", JSON.stringify(idQuitarProductoSER));

  $("button.recuperarBotonS[idProducto='"+idProducto+"']").removeClass('btn-default');

  $("button.recuperarBotonS[idProducto='"+idProducto+"']").addClass('btn-info agregarProductoS');

  if($(".nuevoProductoSer").children().length == 0){
   
    if ($(".nuevoServicios").children().length == 0) {
   
    $("#nuevoImpuestoSer").val(0);
    $("#TotalProductoS").val(0);
    $("#totalVentaS").val(0);
    $("#TotalProductoS").attr("totalS",0);
    $("#nuevoTotalSer").val(0);
   
    sumarTotalDelServicio()

    }else{
    
     sumarTotalDelServicio()
    $("#TotalProductoS").val(0);
    $("#totalVentaS").val(0);
    $("#TotalProductoS").attr("totalS",0);
    $("#listaProducS").val("");
    }
    
    $("#nuevoTotalSer").val($("#TotalServicios").val());
    
    
  }else { 

    // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosS()

      sumarTotalDelServicio()

      // AGREGAR IMPUESTO
          
  /*      agregarImpuestoSer()
*/
        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosSER()
  }

})

/*=============================================
=            MODIFICAR LA CANTIDAD            =
=============================================*/

$(".formularioServi").on("change", "input.nuevaCantidadProductoS", function(){

  /*=====================================================
  =            COMPARACION SI ES LA CANTIDAS ES DE MAYOREO            =
  =====================================================*/
  var precio = $(this).parent().parent().parent().children(".precioColS").children().children(".nuevoPrecioProductoS");

  var precioFinal = $(this).val() * precio.val();

  var precioTotalProducto = $(this).parent().parent().parent().children().children().children(".totalS");

  precioTotalProducto.val(precioFinal); 

  var nuevoStock = Number($(this).attr("stockS")) - $(this).val();

  $(this).attr("nuevoStockS", nuevoStock);


  if (Number($(this).attr("apartirDeS")) != 0) {

    if (Number($(this).val()) >= Number($(this).attr("apartirDeS"))) {

      var precioante = $(this).parent().parent().parent().children(".precioColS").children().children(".nuevoPrecioProductoS");
    
      var precioM = $(this).parent().parent().parent().children(".precioColS").children().children(".nuevoPrecioMayoreoS");
      
      var precioFinal = $(this).val() * precioM.val();
      
      precioante.val(precioM.val());
      
      var precioTotalProducto = $(this).parent().parent().parent().children().children().children(".totalS");

      precioTotalProducto.val(precioFinal); 

      var nuevoStock = Number($(this).attr("stockS")) - $(this).val();
    
    }else{

    precio.val(precio.attr("precioMeS"));
  
    }
  
  }


  if (Number($(this).val()) > Number($(this).attr("stockS"))) {

    /*==================================================================
      SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES            
    ==================================================================*/
    
    $(this).val(0);

    var precioFinal =$(this).val() * precio.val();
    
    precioTotalProducto.val(precioFinal); 

        sumarTotalPreciosS()


    Swal.fire({
               icon: "error",
               title: "La cantidad supera el Stock.",
               text:"¡Sólo hay "+$(this).attr("stock")+"unidades!" 
            });
        }

         // SUMAR TOTAL DE PRECIOS
                  
        sumarTotalPreciosS();

       

       sumarTotalDelServicio()
        // AGREGAR DESCUENTO
      //  agregarDescuento();

         //AGRUPAR PRODUCTOS EN FORMATO JSON
        listarProductosSER()

})


/*===============================================
=            SUMAR TODOS LOS PRECIOS            =
===============================================*/

function sumarTotalPreciosS(){
  var precioItem = $(".totalS");
  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {

    arraySumaPrecio.push(Number($(precioItem[i]).val()));

  }
  
  function sumarArrayPrecios(total, numero){

    return total + numero;

  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumarArrayPrecios);
  
   $("#TotalProductoS").val(sumaTotalPrecio);
    $("#totalVentaS").val(sumaTotalPrecio);
   $("#TotalProductoS").attr("totalS", sumaTotalPrecio);
}


/*=============================================
CAMBIO EN EFECTIVO
=============================================*/


$(".formularioServi").on("change", "input#nuevoEfectivoSer", function(){

  var efectivo = $(this).val();

  var cambio =  Number(efectivo) - Number($('#nuevoTotalSer').val());

  var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#CambioEfectivoSer').children().children('#nuevoCambioSer');

  nuevoCambioEfectivo.val(cambio);
  
  $("#nuevoEfectivoSer").val(efectivo);

})



function listarProductosSER(){
  
  var listaProductos =[];

  var descripcion = $(".nuevaDescripcionProductoS");

  var cantidad = $(".nuevaCantidadProductoS");

  var precio = $(".nuevoPrecioProductoS");

  var total = $(".totalS");

  var efectivo = $(".nuevoValorEfectivo");

  for (var i = 0; i < descripcion.length; i++) {
  
  listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
              "descripcion" : $(descripcion[i]).val(),
              "cantidad" : $(cantidad[i]).val(),
              "stock" : $(cantidad[i]).attr("nuevoStockS"),
              "precio" : $(precio[i]).val(),
              "total" : $(total[i]).val()}) 
  
  }

  $("#listaProducS").val(JSON.stringify(listaProductos));

}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProductoS(){

  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idProductos = $(".quitarProductoS");

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTablaS = $(".tablaPser tbody button.agregarProductoS");

  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for(var i = 0; i < idProductos.length; i++){

    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idProductos[i]).attr("idProducto");
    
    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for(var j = 0; j < botonesTablaS.length; j ++){

      if($(botonesTablaS[j]).attr("idProducto") == boton){

        $(botonesTablaS[j]).removeClass("btn-info agregarProductoS");
        $(botonesTablaS[j]).addClass("btn-default");

      }
    }

  }
  
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaPser').on( 'draw.dt', function(){

  quitarAgregarProductoS();

})



/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarCot", function(){

  var idCot = $(this).attr("idCot");

  Swal.fire({
        title: '¿Está seguro de borrar la cotización?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar cotización!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cotizacion&idCot="+idCot;
            
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnCot", function(){

  var idCot = $(this).attr("idCot");
            
  window.open("extensiones/tcpdf/pdf/cotizacion.php?id="+idCot, "_blank");

})


/*====================================================================================
=            JAVASCRIPT PARA AGREGAR SERVICOS EN LA VISTA CREAR SERVICIOS            =
====================================================================================*/
$('.tablaServicio').DataTable( {
    "ajax": "ajax/datatable-servicio.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
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

  }

});

/*=============================================================================
=            AGREGAR SERVICIOS A LA VISTA SERVICIOS DESDE LA TABLA            =
=============================================================================*/

$(".tablaServicio tbody").on("click", "button.agregarServisio", function(){

  var idService = $(this).attr("idService");

  $(this).removeClass("btn-primary agregarServisio");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idService", idService);

  $.ajax({

      url:"ajax/service.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

        var nombre = respuesta["nombre"];
        var costo = respuesta["costo"];
        
        $(".nuevoServicios").append(

          '<div class="row" style="padding:5px 15px">'+
            
              '<div class="col-lg-6 col-xs-12">'+
            
                '<div class="input-group mb-3">'+

                  '<div class="input-group">'+
                  
                  '<span class="input-group-addon"><button type="button" class="btn btn-danger  quitarServicio" idService="'+idService+'"><i class="fa fa-trash"></i></button></span>'+

                  '<input type="text" class="form-control nuevoNombreServicio" idService="'+idService+'" name="agregarServisio" value="'+nombre+'" readonly required>'+

                  '</div>'+

               '</div>'+

              '</div>'+
              
              '<div class="col-lg-5 col-xs-12 Prec">'+

                '<div class="input-group mb-3">'+
              
                  '<div class="input-group">'+
              
                    '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+ 

                    '<input type="number" class="form-control nuevoPrecioServ" name="nuevoPrecioServ" value="'+costo+'" readonly>'+ 

                  '</div>'+

                '</div>'+
              
              '</div>'+
            
          '</div>')
      
      sumarTotalPrecioServicio()
      sumarTotalDelServicio()
      listaServicoss()
      

      }

  })

});



/*==================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
====================================================*/

$(".tablaServicio").on("draw.dt", function(){

  if(localStorage.getItem("quitarServicio") != null){

    var listaIdServicio = JSON.parse(localStorage.getItem("quitarServicio"));


    for(var i = 0; i < listaIdServicio.length; i++){

      $("button.recuperarBotonServicio[idService='"+listaIdServicio[i]["idService"]+"']").removeClass('btn-default');
      $("button.recuperarBotonServicio[idService='"+listaIdServicio[i]["idService"]+"']").addClass('btn-primary agregarServisio');

    }


  }


})



/*=============================================
QUITAR SERVICIOS Y RECUPERAR BOTÓN
=============================================*/

var idQuitarServicio = [];

localStorage.removeItem("quitarServicio");

$(".formularioServi").on("click", "button.quitarServicio", function(){

  $(this).parent().parent().parent().parent().parent().remove();

  var idService = $(this).attr("idService");
 

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if(localStorage.getItem("quitarServicio") == null){

    idQuitarServicio = [];
  
  }else{

    idQuitarServicio.concat(localStorage.getItem("quitarServicio"))

  }

  idQuitarServicio.push({"idService":idService});
  

  localStorage.setItem("quitarServicio", JSON.stringify(idQuitarServicio));

  $("button.recuperarBotonServicio[idService='"+idService+"']").removeClass('btn-default');

  $("button.recuperarBotonServicio[idService='"+idService+"']").addClass('btn-primary agregarServisio');

if($(".nuevoServicios").children().length == 0 ){
    
   if ($(".nuevoProductoSer").children().length == 0) {      
      
    $("#nuevoImpuestoVenta").val(0);
    $("#TotalServicios").val(0);
    $("#totalVentaS").val(0);
    $("#TotalServicios").attr("total",0);
    $("#nuevoTotalSer").val(0);

      sumarTotalDelServicio();
    
    }else{
    
      sumarTotalDelServicio();
    $("#nuevoImpuestoVenta").val(0);
    $("#TotalServicios").val(0);
    $("#totalVentaS").val(0);
    $("#TotalServicios").attr("total",0);

    }
    $("#nuevoTotalSer").val($("#TotalProductoS").val());  
    Swal.fire({
        title: "Servico vacio",
        text: "¡Para poder realizar la Orden, debe agregar un servicio!",
        icon: "error",
        confirmButtonText: "¡Cerrar!"
      });

      return;

  }else{

    sumarTotalPrecioServicio();
    sumarTotalDelServicio();
    listaServicoss();
  }
    
})


function sumarTotalPrecioServicio(){

  var precioItem = $(".nuevoPrecioServ");
  var arraySumaPrecioServicio = [];   

  for(var i = 0; i < precioItem.length; i++){

     arraySumaPrecioServicio.push(Number($(precioItem[i]).val()));
     
  }

  function sumaArrayPreciosServicios(total, numero){

    return total + numero;

  }

  var sumaTotalPrecioServicios = arraySumaPrecioServicio.reduce(sumaArrayPreciosServicios);
  
  $("#TotalServicios").val(sumaTotalPrecioServicios);
  $("#totalVentaS").val(sumaTotalPrecioServicios);
  $("#TotalServicios").attr("total",sumaTotalPrecioServicios);

}

function sumarTotalDelServicio(){

  var servi = $("#TotalServicios").val();
  var produc = $("#TotalProductoS").val();
 


  var totalF = Number(servi) + Number(produc);

  $("#nuevoTotalSer").val(totalF);

}

/*=============================================
LISTAR TODOS SERVICIOS
=============================================*/
function listaServicoss(){

  var listaDeServicios = [];

  var nombre =  $(".nuevoNombreServicio");

  var precio = $(".nuevoPrecioServ");

  for(var i = 0; i < nombre.length; i++){

    listaDeServicios.push({
      "id" : $(nombre[i]).attr("idService"),
      "nombre" : $(nombre[i]).val(),
      "precio" : $(precio[i]).val()})
  }
    $("#listaServicio").val(JSON.stringify(listaDeServicios));
    
}


/*======================================================================================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABIA SIDO SELECCIONADO EN LA CARPETA
======================================================================================================*/

function quitarAgregarServicio(){

  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idService = $(".quitarServicio");

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaServicio tbody button.agregarServisio");

  //Recorremos en un ciclo para obtener los diferentes idProductos que dueron agregados a la venta
  for (var i = 0; i < idService.length; i++) {

    //Capturamos los id de los productos agregados a la venta
    var boton = $(idService[i]).attr("idService");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
          
      if ($(botonesTabla[j]).attr("idService") == boton) {


          $(botonesTabla[j]).removeClass("btn-primary agregarServisio");
          $(botonesTabla[j]).addClass("btn-default");

      }
    }   
  }

}

/*===========================================================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAMOS LA FUNCIÓN 
===========================================================================*/

$('.tablaServicio').on('draw.dt', function(){

  quitarAgregarServicio();

})


/*===============================================================
=            VERIFICAR QUE LISTA SERVICIO ESTE VACIA            =
===============================================================*/


$(document).on("click", ".btnEditarOrdenServicio", function(){

 var idOrdenSer = $(this).attr("idOrdenSer");
 
 window.location = "index.php?ruta=editar-orden-mantenimiento&idOrdenSer="+idOrdenSer;


});

/*=================================================
=             Eliminar Orden Servicio             =
=================================================*/

$(".tablasOrden").on("click", ".btnEliminarOrdenServicio", function(){

  var idOrdenServicio = $(this).attr("idOrdenServicio");
 Swal.fire({
        title: '¿Está seguro de borrar la orden de servicio?',
        text: "¡Si no lo está puede cancelar la accíón!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Borrar servicio!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=mantenimiento&idOrdenServicio="+idOrdenServicio;
        }

  })

})


/*=================================================
=             IMPRIMIR FACTURA ORDEN SERVICIO     =
=================================================*/

$(".tablasOrden").on("click", ".btnImprimirFacturaOrdenServicio", function(){

  var codigo = $(this).attr("codigo");
 
  window.open("extensiones/tcpdf/pdf/factura-servicio.php?codigo="+codigo, "_blank");

})

/*=================================================
=             IMPRIMIR TICKET ORDEN SERVICIO     =
=================================================*/

$(".tablasOrden").on("click", ".btnTicketOrdenServicio", function(){


  var codigo = $(this).attr("codigo");
            
  window.open("extensiones/tcpdf/pdf/factura-servi.php?codigo="+codigo, "_blank");

})


