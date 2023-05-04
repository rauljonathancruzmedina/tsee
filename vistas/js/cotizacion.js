/*=============================================
 VARIABLE LOCAL STORAGE
=============================================
if (localStorage.getItem("capturarRango") != null) {

	$("#daterang-btn span").html(localStorage.getItem("capturarRango"));
}else{

	$("#daterang-btn span").html('<i class="far fa-calendar-alt"></i> Rango de fecha');
}*/

/*=====================================================
CARGAR LA TABLA DINÀMICA DE VENTAS
=====================================================*/
/*$.ajax({

	url: "ajax/datatable-ventas.ajax.php",
	success:function(respuesta){
		console.log("respuesta", respuesta);
	}
})*/

$('.tablaPCotiza').DataTable({
     "ajax": "ajax/datatable-cotizacion.ajax.php",
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

/*==========================================================
  AGREGAMOS PRODUCTOS A LA VENTA DESDE LA TABLA        
============================================================*/

$(".tablaPCotiza tbody").on("click", "button.agregarProductoC", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProductoC");

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
			var descripcionC = respuesta["descripcion"];
			
			var precioC = respuesta["precio_venta"];
		
			var stockC = respuesta["stock"];
		
			var precioCM = respuesta["precio_ventaa"];

			var apartirDC = respuesta["precio_ventaaa"];


		  /*====================================================
			EVITAR AGREGAR PRODUCTO CUANDO EL STOCK ESTÁ EN CERO 
			====================================================*/
				
			/*if (stockC == 0) {

				var Toast = Swal.mixin({
					   toast: "true",
					   position: "top-end",
					   showConfirmButton: "false",
					   timer: "3000"
					   });
	
					   Toast.fire({
				       icon: "error",
				       title: "No hay stockC disponible."});

				$("button[idProducto='"+idProducto+"']").addClass("btn-primary C");

				return;    
			}
*/
			$(".nuevoProductoC").append(

			'<div class="row" style="padding:5px 15px">'+
				
            /*-- Descripción del producto --*/

           '<div class="col-lg-6 col-xs-12" >'+
               
              '<div class="input-group mb-3">'+
                
              '<div class="input-group">'+
                
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-info quitarProductoC" idProducto="'+idProducto+'"><i class="fas fa-trash-alt"></i></button></span>'+

                '<input type="text" class="form-control nuevaDescripcionProductoC" idProducto="'+idProducto+'" name="agregarProductoC" value="'+descripcionC+'" readonly required>'+
              
                 '</div>'+
              
              '</div>'+
            
            '</div>'+ 
            /*==================================
            =            PRECIO VENTA            =
            ===================================*/
            
           '<div class="col-lg-2 col-xs-12 precioCCol" >'+
            
              '<div class="input-group mb-3">'+
            
              '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+    
              
              '<input type="text" class="form-control nuevoPrecioProductoC" name="nuevoPrecioProductoC" value="'+precioC+'" precioCMe ="'+precioC+'" required>'+
              
              '<input type="hidden" class="form-control nuevoPrecioMayoreoC" name="nuevoPrecioMayoreoC" value="'+precioCM+'"  required>'+             

              '</div>'+
              
            '</div>'+

 

            '<!-- Cantidad del producto -->'+
             '<div class="col-lg-1 col-xs-12 cantidadProductoC">'+
              
              '<div class="input-group mb-3">'+
              
              '<input type="number" class="form-control nuevaCantidadProductoC" name="nuevaCantidadProductoC" min="0.25" step="any" value="0" stockC="'+stockC+'" nuevoStockC="'+stockC+'" apartirDCe="'+apartirDC+'" required>'+
                      
            '</div>'+
            
            '</div>'+ 

            '<!-- Precio del producto -->'+
             '<div class="col-lg-2 col-xs-12" >'+
            
              '<div class="input-group mb-3">'+
            
              '<div class="input-group-prepend">'+
            
              '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+
            
              '</div>'+     
            
              '<input type="text" class="form-control totalC"  name="totalC" value="" readonly required>'+
            
              '</div>'+
              
            '</div>'+

            '</div>')

            // SUMAR TOTAL DE PRECIOS
            
			sumarTotalPreciosCot();

			// AGREGAR DESCUENTO
			 agregarDescuentoCot();

			 //AGRUPAR PRODUCTOS EN FORMATO JSON
			 listarProductosCot();
			
			// PONER FORMATO AL PRECIO DE LOS PRODUCTOS
			/*$(".nuevoPrecioProductoC").number(true, 2);
			$(".totalC").number(true, 2);*/

		}
	})
});


/*====================================================================
=            CUANDO CARGUE LA TABLA CADA  VEZ QUE NAVEGUE EN ELLA           
======================================================================*/
$(".tablaPCotiza").on("draw.dt", function(){

	if (localStorage.getItem("quitarProductoC") != null) {

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProductoC"));

		for (var i = 0; i <listaIdProductos.length; i++) {

			$("button.recuperarBotonC[idProducto='"+listaIdProductos[i][idProducto]+"']").removeClass('btn-default');
			$("button.recuperarBotonC[idProducto='"+listaIdProductos[i][idProducto]+"']").addClass('btn-primary agregarProductoC');


		}

	}

});

/*====================================================================
=            QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN           
======================================================================*/

var idQuitarProductoCO =[];

localStorage.removeItem("quitarProductoC");

$(".formularioCotiz").on("click", "button.quitarProductoC", function(){

	$(this).parent().parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

  /*=========================================================
	ALMACENAR EN EL LOCALATORAGE EL ID DEL PRODUCTO A QUITAR            =
	=========================================================*/
	
	if (localStorage.getItem("quitarProductoC")== null) {

		idQuitarProductoCO = [];
	}else{

		 idQuitarProductoCO.concat(localStorage.getItem("quitarProductoC"));
	}

	idQuitarProductoCO.push({"idProducto":idProducto});

	localStorage.setItem("quitarProductoC", JSON.stringify(idQuitarProductoCO)); 
	$("button.recuperarBotonC[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBotonC[idProducto='"+idProducto+"']").addClass('btn-primary agregarProductoC'); 

	if ($(".nuevoProductoC").children().length == 0) {
 		
 		$("#nuevoDescuentoVenta").val(0);

 		$("#totalCV").attr("totalC", 0);

 		$("#nuevoTotalVen").attr("totalC", 0);
	
	}else {
	 // SUMAR TOTAL DE PRECIOS   
			sumarTotalPreciosCot();
	 // AGREGAR DESCUENTO
			agregarDescuentoCot();
	 //AGRUPAR PRODUCTOS EN FORMATO JSON
		listarProductosCot();
	}
	
})
/*=============================================
=            MODIFICAR LA CANTIDAD            =
=============================================*/

$(".formularioCotiz").on("change", "input.nuevaCantidadProductoC", function(){

	/*=====================================================
	=            COMPARACION SI ES LA CANTIDAS ES DE MAYOREO            =
	=====================================================*/
	var precioC = $(this).parent().parent().parent().children(".precioCCol").children().children(".nuevoPrecioProductoC");

	var precioCFinal = $(this).val() * precioC.val();

	var precioCTotalProducto = $(this).parent().parent().parent().children().children().children(".totalC");

	precioCTotalProducto.val(precioCFinal);	

	var nuevoStockC = Number($(this).attr("stockC")) - $(this).val();

	$(this).attr("nuevoStockC", nuevoStockC);

	if (Number($(this).attr("apartirDCe")) != 0) {

		if (Number($(this).val()) >= Number($(this).attr("apartirDCe"))) {

			var precioCante = $(this).parent().parent().parent().children(".precioCCol").children().children(".nuevoPrecioProductoC");
	 	
		  var precioCM = $(this).parent().parent().parent().children(".precioCCol").children().children(".nuevoPrecioMayoreoC");
			
			var precioCFinal = $(this).val() * precioCM.val();
			
			precioCante.val(precioCM.val());
			
			var precioCTotalProducto = $(this).parent().parent().parent().children().children().children(".totalC");

			precioCTotalProducto.val(precioCFinal);	

			var nuevoStockC = Number($(this).attr("stockC")) - $(this).val();
		
		}else{

		precioC.val(precioC.attr("precioCMe"));
	
		}
	
	}


	/*if (Number($(this).val()) > Number($(this).attr("stockC"))) {*/

		/*==================================================================
		  SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES            
		==================================================================*/
		
		/*$(this).val(0);

		var precioCFinal =$(this).val() * precioC.val();
		
		precioCTotalProducto.val(precioCFinal); 

				sumarTotalPreciosCot()


		Swal.fire({
				       icon: "error",
				       title: "La cantidad supera el Stock.",
				   	   text:"¡Sólo hay "+$(this).attr("stockC")+"unidades!" 
				   	});
				}*/

				 // SUMAR TOTAL DE PRECIOS
			            
				sumarTotalPreciosCot();


				// AGREGAR DESCUENTO
				agregarDescuentoCot();

				 //AGRUPAR PRODUCTOS EN FORMATO JSON
				listarProductosCot();


			

})

/*===============================================
=            SUMAR TODOS LOS PRECIOS            =
===============================================*/

function sumarTotalPreciosCot(){
	var precioCItem = $(".totalC");
	var arraySumaPrecio = [];

	for (var i = 0; i < precioCItem.length; i++) {

		arraySumaPrecio.push(Number($(precioCItem[i]).val()));

	}
	
	function sumarArrayPrecios(totalC, numero){

		return totalC + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumarArrayPrecios);
	
	 $("#nuevoTotalVen").val(sumaTotalPrecio);
	  $("#totalCV").val(sumaTotalPrecio);
	 $("#nuevoTotalVen").attr("totalC", sumaTotalPrecio);
}

/*=============================
=  FUNCIÓN AGREGAR DESCUENTO   
=============================*/

function agregarDescuentoCot(){

	var descuento = $("#nuevoDescuentoVenta").val();
	var precioCTotal = $("#nuevoTotalVen").attr("totalC");

	var totalCConDescuento = Number(precioCTotal) - Number(descuento);

	$("#nuevoTotalVen").val(totalCConDescuento);
	$("#totalCV").val(totalCConDescuento);


	$("#nuevoPrecioDescuento").val(descuento);
	$("#nuevoPrecioNet").val(precioCTotal);
}

/*==================================================
=            CUANDO CAMBIE EL DESCUENTO            =
==================================================*/
$("#nuevoDescuentoVenta").change(function(){

	agregarDescuentoCot();
});
/*==================================================
=            FORTMATO AL PRECIO FINAL            =
==================================================

$("#nuevoTotalVen").number(true, 2);

==================================================
=           SELECCIONAR METODO DE PAGO            =
==================================================*/

$("#nuevoMetodoPago").change(function(){

	var metodo = $(this).val();

	if (metodo == "Efectivo") {

		$(this).parent().parent().parent().removeClass("col-lg-6");

		$(this).parent().parent().parent().addClass("col-lg-4");
	
		$ (this).parent().parent().parent().parent().children(".cajasMetodoPago").html(

		'<div class="col-lg-8">'+
			'<div class="row">'+

			'<div class="col-lg-6">'+

				'<div class="input-group">'+

				' <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+

				'<input type="text" class="form-control" id="nuevoValorEfectivo" placeholder="0000000" required>'+

				'</div>'+
			
			'</div>'+

			'<div class="col-lg-6" id="capturarCambioEfectivo" style="padding-left:0px" >'+

				'<div class="input-group">'+

				' <span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+

				'<input type="text" class="form-control" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="0000000" readonly required>'+


				'</div>'+			

				'</div>'+
				
				'</div>'+

			'</div>')

		/*AGREGAR FORMATO AL PRECIO*/
	/*	$("#nuevoValorEfectivo").number(true, 2);
		$("#nuevoCambioEfectivo").number(true, 2);
*/

		/*Listar método en  la entrada */
		listarMetodos()

	} else{

		$(this).parent().parent().parent().removeClass("col-lg-4");

		$(this).parent().parent().parent().addClass("col-lg-6");	
		
		$(this).parent().parent().parent().parent().children(".cajasMetodoPago").html(

		' <div class="col-lg-12 col-xs-12">'+
                
                '<div class="input-group">'+

                  '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción" required>'+

                  '<span class="input-group-text"><i class="fa fa-lock"></i></span>'+

                '</div>'+

               '</div>')
	}

})
/*==========================================
=            CAMBIO EN EFECTIVO            =
==========================================*/
$(".formularioCotiz").on("change", "input#nuevoValorEfectivo", function(){

	var efectivo = $(this).val();

	var cambio = Number(efectivo) - Number($('#nuevoTotalVen').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().parent().children().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

})
/*==========================================
=            CAMBIO TRANSACCIÓN            =
==========================================*/

$(".formularioCotiz").on("change", "input#nuevoCodigoTransaccion", function(){


		/*Listar método en  la entrada */
		listarMetodos()

})


/*=================================================
=            LISTAR TODOS LO PRODUCTOS            =
=================================================*/
function listarProductosCot(){
	
	var listaProductosCot =[];

	var descripcionC = $(".nuevaDescripcionProductoC");

	var cantidad = $(".nuevaCantidadProductoC");

	var precioC = $(".nuevoPrecioProductoC");

	var totalC = $(".totalC");

	var efectivo = $(".nuevoValorEfectivo");

	for (var i = 0; i < descripcionC.length; i++) {
	
	listaProductosCot.push({ "id" : $(descripcionC[i]).attr("idProducto"),
						  "descripcionC" : $(descripcionC[i]).val(),
						  "cantidad" : $(cantidad[i]).val(),
						  "stockC" : $(cantidad[i]).attr("nuevoStockC"),
						  "precioC" : $(precioC[i]).val(),
						  "totalC" : $(totalC[i]).val()})	
	
	}

	$("#listaProductC").val(JSON.stringify(listaProductosCot));

}

/*==========================================
=            LISTAR METODO PAGO            =
==========================================*/
function listarMetodos(){

	var listarMetodos ="";

	if ($("#nuevoMetodoPago").val() == "Efectivo") {

		$("#listaMetodoPago").val("Efectivo");

	}else{

	    $("#listaMetodoPago").val($("#nuevoMetodoPago").val()+"-"+$("#nuevoCodigoTransaccion").val());				

	}	
}

/*==========================================
=            BOTON EDITAR VENTA            =
==========================================*/
$(document).on("click", ".btnEditarCotiza", function(){

	var idCotiza = $(this).attr("idCotiza");
	window.location = "index.php?ruta=editar-cotizacion&idCotiza="+idCotiza;

});

/*======================================================================================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABIA SIDO SELECCIONADO EN LA CARPETA
======================================================================================================*/

function quitarAgregarProducto(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProductoC");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaPCotiza tbody button.agregarProductoC");

	//Recorremos en un ciclo para obtener los diferentes idProductos que dueron agregados a la venta
	for (var i = 0; i < idProductos.length; i++) {

		//Capturamos los id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTabla.length; j++) {
					
			if ($(botonesTabla[j]).attr("idProducto") == boton) {


				  $(botonesTabla[j]).removeClass("btn-primary agregarProductoC");
				  $(botonesTabla[j]).addClass("btn-default");

			}
		}		
	}

}

/*===========================================================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAMOS LA FUNCIÓN 
===========================================================================*/

$('.tablaPCotiza').on('draw.dt', function(){

	quitarAgregarProducto();

})

/*====================================
=            BORRAR VENTA            =
====================================*/

$(document).on("click", ".btnElimCotiz", function(){	

	var idCotiz = $(this).attr("idCotiz");
	

 	Swal.fire({
    title: '¿Está seguro de borrar la cotización?',
    text: '¡Si no lo está puede cancelar la accion!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor:'#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar cotización!'
   }).then((result)=>{

    if (result.value) {
      window.location ="index.php?ruta=cotizacion&idCotiz="+idCotiz;
    }

   })
})

/*========================================
=            IMPRIMIR FACTURA            =
========================================*/

$(document).on("click", ".btnPdf", function(){

	var idCotiz = $(this).attr("idCotiz");
	window.open("extensiones/tcpdf/pdf/cotizacion.php?codigo="+idCotiz, "_blank");

});
