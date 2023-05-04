 /* ======================================== 
            REGISTRO DE EMPRESA
  ========================================*/
  $(".nuevaFoto").change(function(){

  	var imagen = this.files[0];
  	 /* ======================================== 
            Validamos el formato de la imagen sea jpg o png 
  ========================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
		$(".nuevaFoto").val("");
		var Toast = Swal.mixin({
					   toast: "true",
					   position: "top-end",
					   showConfirmButton: "false",
					   timer: "3000"
					   });
					   Toast.fire({
				       icon: "error",
				       title: "Error al subir la imagen.",
				       text: "¡La imagen debe estar en formato JPG O PNG!"});

      }else{
      	var datosImagen = new FileReader;
      	datosImagen.readAsDataURL(imagen);

      	$(datosImagen).on("load", function(event){

      		var rutaImagen = event.target.result;
      		$(".previsualizar").attr("src", rutaImagen);
      	})
      }

  })
   /* ======================================== 
            REGISTRO DE EMPRESA
  ========================================*/
  $(".btnEditarEmpresa").click(function(){
    var idEmpresa = $(this).attr("id");
    window.location = "index.php?ruta=empresa&idEmpresa="+idEmpresa; 

  });
