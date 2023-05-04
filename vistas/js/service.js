/*=============================================
EDITAR SERVICIO 
=============================================*/
$(".tablas").on("click", ".btnEditarService", function(){

	var idService = $(this).attr("idService");
	

	var datos = new FormData();
	datos.append("idService", idService);

	$.ajax({
		url: "ajax/service.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarService").val(respuesta["nombre"]);
     		$("#idService").val(respuesta["id"]);
     		$("#EditarPrecioService").val(respuesta["costo"]);

     	}
	})
})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarService", function(){

	 var idService = $(this).attr("idService");

	 Swal.fire({
	 	title: '¿Está seguro de borrar el servicio?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	icon: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar servicio!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=crear-mantenimiento&idService="+idService;

	 	}

	 })

})



