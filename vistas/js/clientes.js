/*=====================================
    EDITAR CLIENTE
  ======================================*/

 $(".tablas").on("click", ".btnEditarCliente", function(){

  var idCliente = $(this).attr("idCliente");
  
  var datos = new FormData();
    datos.append("idCliente", idCliente);

    $.ajax({

      url:"ajax/clientes.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
         $("#idCliente").val(respuesta["id"]);
         $("#editarCliente").val(respuesta["nombre"]);
         $("#editarTelefono").val(respuesta["telefono"]);
         $("#editarDireccion").val(respuesta["direccion"]);
         $("#editarRFC").val(respuesta["rfc"]);
         $("#editarCFDI").val(respuesta["cfdi"]);
    }

    })

})

 /*=====================================
    ELIMINAR CLIENTE
  ======================================*/
  $(".btnEliminarCliente").click(function(){

  	var idCliente = $(this).attr("idCliente");
 
  	Swal.fire({
  		title: '¿Està seguro de borrar el cliente?',
  		text: "¡Si no lo està puede cancelar la acciòn!",
  		icon: 'warning',
  		showCancelButton: true,
  		confirmButtonColor: '#3085d6',
  		cancelButtonColor: '#d33',
  		cancelButtonText: 'Cancelar',
  		confirmButtonText: 'Si, borrar cliente!'
  	  }).then((result)=>{
  	  	if (result.value) {

  	  		window.location = "index.php?ruta=clientes&idCliente="+idCliente;
  	  	}
  	  })

  })
