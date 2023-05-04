/*=============================================
ELIMINAR SERVICIO
=============================================*/
$(document).on("click", ".btnEliminarPago", function(){  

   var idpago = $(this).attr("idPago");

   swal.fire({
    title: '¿Está seguro de borrar el pago?',
    text: "¡Si no lo está puede cancelar la acción!",
    type: 'warning',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, borrar pago!'
   }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=pagos&id="+idpago;

    }

   })

})


/*=============================================
IMPRIMIR TICKET DE VENTA 
=============================================*/

$(document).on("click", ".btnImpriTick", function(){

  var codigoPag = $(this).attr("idTick");
        
  window.open("extensiones/tcpdf/pdf/ticket.php?codigo="+codigoPag, "_blank");

})



/*=============================================
IMPRIMIR FACTURA
=============================================*/
$(document).on("click", ".btnImpriBoleta", function(){

	var codigoPago = $(this).attr("idBoleta");
				
	window.open("extensiones/tcpdf/pdf/pago.php?codigo="+codigoPago, "_blank");

})

 

/*=============================================
            CAPTURAR CAMBIO
    =============================================*/
$("#nuevoPagoS").change(function(){

  var pagar = $("#nuevoPrecioPago").val();

  var pago = $("#nuevoPagoS").val();

    var cambio = Number(pago) - Number(pagar);

    $("#CambioPago").val(cambio); 
  
  console.log("los chavis: Javier Medina, Jonathan Raul, 2020 ITSTE");

})

/*=============================================
            CAPTURAR SUCURSAL 
    =============================================*/
$("#nuevaSucursal").change(function(){
  var sucursal = $(this).val();
  var direccion;
  if (sucursal != "TAMAZULAPAM") {

    direccion = "AV.Insurgentes 2, Sec 1a, TEJUPAM";

  } else {

    direccion = "Carretera Cristobal Colón 62, San Cipriano";

  }
  
  $("#nuevaDirec").val(direccion);
})

 

