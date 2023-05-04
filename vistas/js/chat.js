/*=============================================
SUBIENDO ARCHIVOS ADJUNTOS
=============================================*/

$(".subirAdjuntos").change(function(){

  var archivos = this.files;

  for(var i = 0; i < archivos.length; i++){

    /*=============================================
    Validar formatos de archivos
    =============================================*/ 

    if( archivos[i]["type"] != "image/jpeg" && 
      archivos[i]["type"] != "image/png" &&
      archivos[i]["type"] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" && 
      archivos[i]["type"] != "application/vnd.ms-excel" &&
      archivos[i]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document" &&
      archivos[i]["type"] != "application/msword" &&
      archivos[i]["type"] != "application/pdf"){

      $(".subirAdjuntos").val("");

      Swal.fire({

            type: "error",
            icon: 'error',
            title: "Error al subir los Archivos",
            text: "¡El formato de los archivos no es correcto, debe ser: JPG, PNG, EXCEL, WORD o PDF!", 
            confirmButtonText: "¡Cerrar!"
          });

          return;

    } else if(archivos[i]["size"] > 32000000){

      /*=============================================
      Validar el tamaño de los archivos
      =============================================*/ 

      $(".subirAdjuntos").val("");

      Swal.fire({
            title: "Error al subir los Archivos",
            text: "¡Los Archivos no deben pesar más de 32MB!",
            type: "error",
            icon: 'error',
            confirmButtonText: "¡Cerrar!"
          });

          return;

    }else{

      multiplesArchivos(archivos[i]);

    }

  }

})

var archivosTemporales = [];

function multiplesArchivos(archivo){

  datosArchivo = new FileReader;
  datosArchivo.readAsDataURL(archivo);

  $(datosArchivo).on("load", function(event){

    var rutaArchivo = event.target.result;        
    

    if(archivo["type"] == "image/jpeg" || archivo["type"] == "image/png"){

      $(".mailbox-attachments").append(`
  
      <li>
        <span class="mailbox-attachment-icon has-img"><img src="`+rutaArchivo+`" alt="Attachment"></span><br>

        <div class="mailbox-attachment-info">
          <a href="#" class="mailbox-attachment-name"><i class="fas fa-camera"></i> `+archivo['name']+`</a>
              <span class="mailbox-attachment-size clearfix mt-1">
                <span>`+archivo['size']+` Bytes</span>
                <button type="button" class="btn btn-danger btn-sm float-right quitarAdjunto" temporal><i class="fas fa-times"></i></button>
              </span>
        </div>
      </li>

      `);
    }

    if(archivo["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || archivo["type"] == "application/vnd.ms-excel"){

      $(".mailbox-attachments").append(`

       <li>
            <span class="mailbox-attachment-icon"><i class="fas fa-file-excel"></i></span>

            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> `+archivo['name']+`</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>`+archivo['size']+` Bytes</span>
                    <button type="button" class="btn btn-danger btn-sm float-right quitarAdjunto" temporal><i class="fas fa-times"></i></button>
                  </span>
            </div>
          </li>

            `);

    }

    if(archivo["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || archivo["type"] == "application/msword"){

      $(".mailbox-attachments").append(`

      <li>
            <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> `+archivo['name']+`</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>`+archivo['size']+` Bytes</span>
                    <button type="button" class="btn btn-danger btn-sm float-right quitarAdjunto" temporal><i class="fas fa-times"></i></button>
                  </span>
            </div>
          </li>

            `);

    }


    if(archivo["type"] == "application/pdf"){

      $(".mailbox-attachments").append(`

       <li>
            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

            <div class="mailbox-attachment-info">
              <a href="#" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> `+archivo['name']+`</a>
                  <span class="mailbox-attachment-size clearfix mt-1">
                    <span>`+archivo['size']+` Bytes</span>
                    <button type="button" class="btn btn-danger btn-sm float-right quitarAdjunto" temporal><i class="fas fa-times"></i></button>
                  </span>
            </div>
          </li>

            `);

    }

    if(archivosTemporales.length != 0){

      archivosTemporales = JSON.parse($(".archivosTemporales").val());

    }

    archivosTemporales.push(rutaArchivo)
    

    $(".archivosTemporales").val(JSON.stringify(archivosTemporales));
      
      console.log("archivosTemporales", archivosTemporales.length);

  })

}

/*=============================================
            QUITAR ARCHIVO ADJUNTO
=============================================*/

$(document).on("click", ".quitarAdjunto", function(){
  
  var listaTemporales = JSON.parse($(".archivosTemporales").val());

  var quitarAdjunto = $(".quitarAdjunto");

  for(var i = 0; i < listaTemporales.length; i++){

    $(quitarAdjunto[i]).attr("temporal", listaTemporales[i]);

    var quitarArchivo = $(this).attr("temporal");

    if(quitarArchivo == listaTemporales[i]){
      
      listaTemporales.splice(i, 1);

      $(".archivosTemporales").val(JSON.stringify(listaTemporales));

      $(this).parent().parent().parent().remove();

    }

  }

  console.log("archivosTemporales", listaTemporales.length);

})


/*=============================================
            TABLA MENSAJES
=============================================*/

var id_usuario = $(".idUsuario").val();
var tipoTicket = $(".tipoMsj").val();

$.ajax({

 "url":"ajax/soporte-tabla.ajax.php?id_usuario="+id_usuario+"&tipo="+tipoTicket,
 success: function(respuesta){
    
   console.log("respuesta", respuesta);  

 }

})

  
/*=============================================
      ENVIAR A LA PAPELERA
=============================================*/

$(".btnPapelera").click(function(){

  var ticketPapelera = $(this).attr("idTickets");
  var idUsuario = $(this).attr("idUsuario");
  var tipoTickets = $(this).attr("tipoTickets");
  
  var datos = new FormData();
  datos.append("ticketPapelera", ticketPapelera);
  datos.append("idUsuario", idUsuario);
  datos.append("tipoTickets", tipoTickets);

  $.ajax({

    url:"ajax/soporte.ajax.php",
    method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success:function(respuesta){

        if(respuesta == "ok"){

          swal.fire({
              type:"success",
              icon: 'success',
                title: "¡MENSAJE ENVIADO CORRECTAMENTE A ELIMINADOS!",
                text: "¡Puede recuperar el mensaje si lo desea en el apartado de eliminados!",
                showConfirmButton: true,
              confirmButtonText: "Cerrar"
                  
          }).then(function(result){

              if(result.value){   
                  window.location = "soporte";
                } 
          });

        }

        if(respuesta == "recuperado"){

          swal.fire({
              type:"success",
              icon: 'success',
                title: "¡MENSAJE RECUPERADO!",
                text: "¡Revisa en los otros apartados el mensaje recuperado!",
                showConfirmButton: true,
              confirmButtonText: "Cerrar"
              
          }).then(function(result){

              if(result.value){   
                  window.location = "soporte";
                } 
          });

        }

      }

  })
  

})


/*=============================================
PLUGIN ICHECK
=============================================*/

$(".tablaMsj").on("draw.dt", function(){

 $(".mailbox-messages input[type='checkbox']").iCheck({
    checkboxClass: "icheckbox_flat-blue",
    radioClass: "iradio_flat-blue"
  });

  /*=============================================
  ENVIAR TICKETS DE FORMA MASIVA A LA PAPELERA
  =============================================*/

  var ticketCheckbox = $(".ticketCheckbox");

  var idTickets = [];

  for(var i = 0; i < ticketCheckbox.length; i++){

    /*=============================================
      Checkear para enviar a la papelera
      =============================================*/

      $(ticketCheckbox[i]).on("ifChecked", function(event){

        idTickets.push($(this).attr("idTicket"));

        if($(".btnPapelera").attr("idTickets") != ""){

          ticketsPapelera = $(".btnPapelera").attr("idTickets").split(",");

          ticketsPapelera.push($(this).attr("idTicket"));

          $(".btnPapelera").attr("idTickets", ticketsPapelera.toString());

        }else{

          $(".btnPapelera").attr("idTickets", idTickets.toString());

        }

      })

      /*=============================================
      Quitar el Check para enviar a la papelera
      =============================================*/

      $(ticketCheckbox[i]).on("ifUnchecked", function(event){

        var quitarTicketsPapelera = $(".btnPapelera").attr("idTickets").split(",");

        for(var f = 0; f < quitarTicketsPapelera.length; f++){

          if(quitarTicketsPapelera[f] == $(this).attr("idTicket")){

            quitarTicketsPapelera.splice(f, 1);

            idTickets.splice(f, 1);

            $(".btnPapelera").attr("idTickets", quitarTicketsPapelera.toString());

          }

        }

      })

  }

})

$(".checkbox-toggle").click(function(){

  var clicks = $(this).data('clicks');

  if(clicks){

    $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
    $(".far", this).removeClass("fa-check-square").addClass("fa-square");

  }else{

    $(".mailbox-messages input[type='checkbox']").iCheck("check");
    $(".far", this).removeClass("fa-square").addClass("fa-check-square");

  }

  $(this).data("clicks", !clicks);

})


