/*=============================================
 VARIABLE LOCAL STORAGE
=============================================*/
if (localStorage.getItem("capturarRango") != null) {

	$("#daterang-btn span").html(localStorage.getItem("capturarRango"));
}else{

	$("#daterang-btn span").html('<i class="far fa-calendar-alt"></i> Rango de fecha');
}

/*=====================================================
CARGAR LA TABLA DINÀMICA DE VENTAS
=====================================================*/
/*$.ajax({

	url: "ajax/datatable-ventas.ajax.php",
	success:function(respuesta){
		console.log("respuesta", respuesta);
	}
})*/

$('.tablaPVenta').DataTable({
     "ajax": "ajax/datatable-ventas.ajax.php",
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
	
$(".tablaPVenta tbody").on("click", "button.agregarProducto", function(){

	var idProducto = $(this).attr("idProducto");

	$(this).removeClass("btn-primary agregarProducto");

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
			var descripcion = respuesta["descripcion"];
		
			var precio = respuesta["precio_venta"];
		
			var stock = respuesta["stock"];
		
			var precioM = respuesta["precio_ventaa"];

			var apartirD = respuesta["precio_ventaaa"];


		  /*====================================================
			EVITAR AGREGAR PRODUCTO CUANDO EL STOCK ESTÁ EN CERO 
			====================================================*/
				
			if (stock == 0) {
				
				var Toast = Swal.mixin({
					   toast: "true",
					   position: "top-end",
					   showConfirmButton: "false",
					   timer: "3000"
					   });
	
					   Toast.fire({
				       icon: "error",
				       title: "No hay stock disponible."});

				$("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

				return;    
			}

			$(".nuevoProducto").append(

			'<div class="row" style="padding:5px 15px">'+
				
            /*-- Descripción del producto --*/

           '<div class="col-lg-6 col-xs-12" >'+
               
              '<div class="input-group mb-3">'+
                
              '<div class="input-group">'+
                
                '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-info quitarProducto" idProducto="'+idProducto+'"><i class="fas fa-trash-alt"></i></button></span>'+

                '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+
              
                 '</div>'+
              
              '</div>'+
            
            '</div>'+ 
            /*==================================
            =            PRECIO VENTA            =
            ===================================*/
            
           '<div class="col-lg-2 col-xs-12 precioCol" >'+
            
              '<div class="input-group mb-3">'+
            
              '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+    
              
              '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" value="'+precio+'" precioMe ="'+precio+'" readonly required>'+
              
              '<input type="hidden" class="form-control nuevoPrecioMayoreo" name="nuevoPrecioMayoreo" value="'+precioM+'" readonly required>'+             

              '</div>'+
              
            '</div>'+

 

            '<!-- Cantidad del producto -->'+
             '<div class="col-lg-1 col-xs-12 ">'+
              
              '<div class="input-group mb-3">'+
              
              '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="0.25" step="any" value="0" stock="'+stock+'" nuevoStock="'+stock+'" apartirDe="'+apartirD+'" required>'+
                      
            '</div>'+
            
            '</div>'+ 

            '<!-- Precio del producto -->'+
             '<div class="col-lg-2 col-xs-12" >'+
            
              '<div class="input-group mb-3">'+
            
              '<div class="input-group-prepend">'+
            
              '<span class="input-group-text"><i class="fa fa-dollar-sign"></i></span>'+
            
              '</div>'+     
            
              '<input type="text" class="form-control total"  name="total" value="" readonly required>'+
            
              '</div>'+
              
            '</div>'+

            '</div>')

            // SUMAR TOTAL DE PRECIOS
            
			sumarTotalPrecios();

			// AGREGAR DESCUENTO
			 agregarDescuento();

			 //AGRUPAR PRODUCTOS EN FORMATO JSON
			 listarProductos();
			
			// PONER FORMATO AL PRECIO DE LOS PRODUCTOS
			/*$(".nuevoPrecioProducto").number(true, 2);
			$(".totalV").number(true, 2);*/

		}
	})
});


/*====================================================================
=            CUANDO CARGUE LA TABLA CADA  VEZ QUE NAVEGUE EN ELLA           
======================================================================*/
$(".tablaPVenta").on("draw.dt", function(){

	if (localStorage.getItem("quitarProducto") != null) {

		var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

		for (var i = 0; i <listaIdProductos.length; i++) {

			$("button.recuperarBoton[idProducto='"+listaIdProductos[i][idProducto]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i][idProducto]+"']").addClass('btn-primary agregarProducto');


		}

	}

});

/*====================================================================
=            QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN           
======================================================================*/

var idQuitarProducto =[];

localStorage.removeItem("quitarProducto");

$(".formularioVenta").on("click", "button.quitarProducto", function(){

	$(this).parent().parent().parent().parent().parent().remove();

	var idProducto = $(this).attr("idProducto");

  /*=========================================================
	ALMACENAR EN EL LOCALATORAGE EL ID DEL PRODUCTO A QUITAR            =
	=========================================================*/
	
	if (localStorage.getItem("quitarProducto") == null) {

		idQuitarProducto = [];
	}else{

		 idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
	}

	idQuitarProducto.push({"idProducto":idProducto});

	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto)); 
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');

	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto'); 

	if ($(".nuevoProducto").children().length == 0) {
 		
 		$("#nuevoDescuentoVenta").val(0);

 		$("#totalVenta").attr("total", 0);

 		$("#nuevoTotalVenta").attr("total", 0);
	 
	 // SUMAR TOTAL DE PRECIOS   
			sumarTotalPrecios();

	}else {
	 // SUMAR TOTAL DE PRECIOS   
			sumarTotalPrecios();
	 // AGREGAR DESCUENTO
			agregarDescuento();
	 //AGRUPAR PRODUCTOS EN FORMATO JSON
		listarProductos();
	}
	
})
/*=============================================
=            MODIFICAR LA CANTIDAD            =
=============================================*/

$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function(){

	/*=====================================================
	=            COMPARACION SI ES LA CANTIDAS ES DE MAYOREO            =
	=====================================================*/
	var precio = $(this).parent().parent().parent().children(".precioCol").children().children(".nuevoPrecioProducto");
	


	var precioFinal = $(this).val() * precio.val();

	var precioTotalProducto = $(this).parent().parent().parent().children().children().children(".total");

	precioTotalProducto.val(precioFinal);	

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);


	if (Number($(this).attr("apartirDe")) != 0) {

		if (Number($(this).val()) >= Number($(this).attr("apartirDe"))) {

			var precioante = $(this).parent().parent().parent().children(".precioCol").children().children(".nuevoPrecioProducto");
	 	
		  var precioM = $(this).parent().parent().parent().children(".precioCol").children().children(".nuevoPrecioMayoreo");
			
			var precioFinal = $(this).val() * precioM.val();
			
			precioante.val(precioM.val());
			
			var precioTotalProducto = $(this).parent().parent().parent().children().children().children(".total");

			precioTotalProducto.val(precioFinal);	

			var nuevoStock = Number($(this).attr("stock")) - $(this).val();
		
		}else{

		precio.val(precio.attr("precioMe"));
	
		}
	
	}


	if (Number($(this).val()) > Number($(this).attr("stock"))) {

		/*==================================================================
		  SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES            
		==================================================================*/
		
		$(this).val(0);

		var precioFinal =$(this).val() * precio.val();
		
		precioTotalProducto.val(precioFinal); 

				sumarTotalPrecios()


		Swal.fire({
				       icon: "error",
				       title: "La cantidad supera el Stock.",
				   	   text:"¡Sólo hay "+$(this).attr("stock")+"unidades!" 
				   	});
				}

				 // SUMAR TOTAL DE PRECIOS
			            
				sumarTotalPrecios();


				// AGREGAR DESCUENTO
				agregarDescuento();

				 //AGRUPAR PRODUCTOS EN FORMATO JSON
				listarProductos();


			

})

/*===============================================
=            SUMAR TODOS LOS PRECIOS            =
===============================================*/

function sumarTotalPrecios(){
	var precioItem = $(".total");
	var arraySumaPrecio = [];

	for (var i = 0; i < precioItem.length; i++) {

		arraySumaPrecio.push(Number($(precioItem[i]).val()));

	}
	
	function sumarArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecio = arraySumaPrecio.reduce(sumarArrayPrecios);
	console.log("sumaTotalPrecio", sumaTotalPrecio);
	
	 $("#nuevoTotalVenta").val(sumaTotalPrecio);
	  $("#totalVenta").val(sumaTotalPrecio);
	 $("#nuevoTotalVenta").attr("total", sumaTotalPrecio);
}

/*=============================
=  FUNCIÓN AGREGAR DESCUENTO   
=============================*/

function agregarDescuento(){

	var descuento = $("#nuevoDescuentoVenta").val();
	var precioTotal = $("#nuevoTotalVenta").attr("total");


	/*var precioDescuento = Number(precioTotal * descuento/100);*/

	var totalConDescuento = Number(precioTotal) - Number(descuento);

	$("#nuevoTotalVenta").val(totalConDescuento);
	$("#totalVenta").val(totalConDescuento);

	$("#nuevoPrecioDescuento").val(descuento);
	$("#nuevoPrecioNeto").val(precioTotal);
}

/*==================================================
=            CUANDO CAMBIE EL DESCUENTO            =
==================================================*/
$("#nuevoDescuentoVenta").change(function(){

	agregarDescuento();
});
/*==================================================
=            FORTMATO AL PRECIO FINAL            =
==================================================*/

/*$("#nuevoTotalVenta").number(true, 2);*/



/*=============================================
CAMBIO EN EFECTIVO
=============================================*/

$(".formularioVenta").on("change", "input#nuevoEfectivoVenta", function(){

	var efectivo = $(this).val();
	console.log("efectivo", efectivo);

	var cambio = Number(efectivo) - Number($('#nuevoTotalVenta').val());

	var nuevoCambioEfectivo = $(this).parent().parent().parent().parent().children().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');

	nuevoCambioEfectivo.val(cambio);

	$("#nuevoCambioVent").val(cambio);
	
	$("#nuevoEfecVent").val(efectivo);


})


/*=================================================
=            LISTAR TODOS LO PRODUCTOS            =
=================================================*/
function listarProductos(){
	
	var listaProductos =[];

	var descripcion = $(".nuevaDescripcionProducto");

	var cantidad = $(".nuevaCantidadProducto");

	var precio = $(".nuevoPrecioProducto");

	var total = $(".total");

	var efectivo = $(".nuevoValorEfectivo");

	for (var i = 0; i < descripcion.length; i++) {
	
	listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"),
						  "descripcion" : $(descripcion[i]).val(),
						  "cantidad" : $(cantidad[i]).val(),
						  "stock" : $(cantidad[i]).attr("nuevoStock"),
						  "precio" : $(precio[i]).val(),
						  "total" : $(total[i]).val()})	
	
	}

	$("#listaProductos").val(JSON.stringify(listaProductos));

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
$(".tablaV").on("click", ".btnEditarVenta", function(){

	var idVenta = $(this).attr("idVenta");
	window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;

})

/*======================================================================================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABIA SIDO SELECCIONADO EN LA CARPETA
======================================================================================================*/

function quitarAgregarProductos(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarProducto");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaPVenta tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que dueron agregados a la venta
	for (var i = 0; i < idProductos.length; i++) {

		//Capturamos los id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");

		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for (var j = 0; j < botonesTabla.length; j++) {
					
			if ($(botonesTabla[j]).attr("idProducto") == boton) {


				  $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				  $(botonesTabla[j]).addClass("btn-default");

			}
		}		
	}

}

/*===========================================================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAMOS LA FUNCIÓN 
===========================================================================*/

$('.tablaPVenta').on('draw.dt', function(){

	quitarAgregarProductos();

})

/*====================================
=            BORRAR VENTA            =
====================================*/


$(".tablaV").on("click", ".btnEliminarVenta", function(){

	var idVenta = $(this).attr("idVenta");
	

 	Swal.fire({
    title: '¿Está seguro de borrar la venta?',
    text: '¡Si no lo está puede cancelar la accion!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor:'#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar producto!'
   }).then((result)=>{

    if (result.value) {
      window.location ="index.php?ruta=ventas&idVenta="+idVenta;
    }

   })
})

/*========================================
=            IMPRIMIR FACTURA            =
========================================*/

$(".tablaV").on("click", ".btnImprimirFactura", function(){

	var codigoVenta = $(this).attr("codigoVenta");
	window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");

})

/*=======================================
=            RANGO DE FECHAS            =
=======================================*/

 //Date range as a button
$('#daterang-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterang-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterang-btn span").html();

    localStorage.setItem("capturarRango", capturarRango);
  	

    window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }
)

/*================================================
=            CANCELAR RANGO DE FECHAS            =
================================================*/

$(".daterangepicker.opensleft .drp-buttons .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();

	window.location = "ventas";

})

/*====================================
=            CAPTURAR HOY            =
====================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if (textoHoy == "Hoy") {

		var d = new Date();

		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if (mes < 10) {

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;


			}else if (dia < 10) {

				var fechaInicial = año+"-"+mes+"-0"+dia;
				var fechaFinal = año+"-"+mes+"-0"+dia;

			}else if (mes < 10 && dia < 10 ) {

				var fechaInicial = año+"-0"+mes+"-0"+dia;
				var fechaFinal = año+"-0"+mes+"-0"+dia;

			}else{

				var fechaInicial = año+"-"+mes+"-"+dia;

				var fechaFinal = año+"-"+mes+"-"+dia;

			}

		localStorage.setItem("capturarRango", "Hoy");

		window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})

$("#corteDelDia").on("click",function(){

			var fecha = $(this).attr("fecha");
			var idUsuario =$(this).attr("idUsuario");
			console.log("idUsuario", idUsuario);
		window.open("extensiones/tcpdf/pdf/corte_dia.php?fecha="+fecha+"&idUsuario="+idUsuario, "_blank");
})



/*=============================================
IMPRIMIR TICKET DE VENTA 
=============================================*/

$(document).on("click", ".btnImpriTickV", function(){

  var codigoVE = $(this).attr("idTickV");
        
  window.open("extensiones/tcpdf/pdf/ticketVenta.php?codigoV="+codigoVE, "_blank");

})

