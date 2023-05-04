/*=====================================
    EDITAR CLIENTE
  ======================================*/
  $(".btnEditarClientI").click(function(){

  var idClientI = $(this).attr("idClientI");
  var datos = new FormData();
  datos.append("idClientI", idClientI);

    $.ajax({

      url:"ajax/clientesI.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
         $("#idClienI").val(respuesta["id"]);
         $("#editaClientI").val(respuesta["nombre"]);
         $("#editaTelClientI").val(respuesta["telefono"]);
         $("#editaDireccionI").val(respuesta["direccion"]);
         $("#editaServicioI").html(respuesta["servicio"]);
         $("#editaServicioI").val(respuesta["servicio"]);
         $("#editaFechaCont").val(respuesta["contratacion"]);
         $("#editaFechaMes").val(respuesta["mensualidad"]);
    }

    })
});

 /*=====================================
    ELIMINAR CLIENTE
  ======================================*/
  $(".btnEliminarClientI").click(function(){

  	var idClientI = $(this).attr("idClientI");
 
  	Swal.fire({
  		title: '¿Està seguro de borrar el cliente?',
  		text: "¡Si no lo està puede cancelar la acciòn!",
  		type: 'warning',
      icon: "warning",
  		showCancelButton: true,
  		confirmButtonColor: '#3085d6',
  		cancelButtonColor: '#d33',
  		cancelButtonText: 'Cancelar',
  		confirmButtonText: 'Si, borrar cliente!'
  	  }).then((result)=>{
  	  	if (result.value) {

  	  		window.location = "index.php?ruta=clientesI&idClientI="+idClientI;
  	  	}
  	  })

  })


/*=====================================
    COBRAR SERVICIO 
  ======================================*/
  $(".btnCobrarClientI").click(function(){

    var idClient = $(this).attr("idClientI");

          window.location = "index.php?ruta=cobro-internet&idClient="+idClient;
                

  })



/*=====================================
    COBRAR TODOS SUS PAGOS 
  ======================================*/
  $(document).on("click", ".btnEliminarPagoC", function(){  

    var idClient = $(this).attr("idPagoCl");

          window.location = "index.php?ruta=clientesI&idCpago="+idClient;
                

  })

 

