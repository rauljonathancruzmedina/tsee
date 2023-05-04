<?php 
	
	if(isset($_GET["idMsj"])){

		$ticket = ControladorSoporte::ctrMostrarTickets("id_soporte", $_GET["idMsj"]);
		$remitente = ControladorUsuarios::ctrMostrarUsuarios("id", $ticket[0]["remitente"]);
		$receptor = ControladorUsuarios::ctrMostrarUsuarios("id", $ticket[0]["receptor"]);

	}else{

		echo '<script>
	    
	      window.location = "soporte";       

	    </script>';

	    return;

	}

?>

<section class="content"> 
  <div class="card card-primary card-outline">
    <div class="card-header">

      <h3 class="card-title">Leer mensaje</h3>

    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <div class="mailbox-read-info">
        <h5><?php echo $ticket[0]["asunto"]; ?></h5>

        <?php if ($_GET["tipo"] == "enviados"): ?>
	
        	<h6>Para: <?php echo $receptor["nombre"]; ?>

        	<?php 

        		$para = $receptor["nombre"];

        		$id_para = $ticket[0]["receptor"];

        		$direccion = array("Reenviar",'<i class="fas fa-reply"></i>');

        	 ?>

        <?php else: ?>

        	<h6>De: <?php echo $remitente["nombre"]; ?>	

        	<?php 

        		$para = $remitente["nombre"];

        		$id_para = $ticket[0]["remitente"];

        		$direccion = array("Responder",'<i class="fas fa-share"></i>');

        	 ?>

        <?php endif ?>
        
          <span class="mailbox-read-time float-right"><?php echo $ticket[0]["fecha_soporte"] ?></span></h6>
      </div>
      <!-- /.mailbox-read-info -->
      <div class="mailbox-controls with-border text-center">

        <div class="btn-group">

          <button type="button" class="btn btn-outline-danger btn-sm btnPapelera" idTickets="<?php echo $ticket[0]["id_soporte"]; ?>" idUsuario="<?php echo $_SESSION["id"]; ?>" data-container="body" title="Eliminar">
            <i class="far fa-trash-alt"></i>
          </button>

          <a href="index.php?ruta=soporte&soporte=nuevo-msg&para=<?php echo $para?>&asunto=<?php echo $ticket[0]["asunto"]?>&id_para=<?php echo $id_para?>">
          	
          	<button type="button" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-container="body" title="<?php echo $direccion[0]; ?>">
            	<?php echo $direccion[1]; ?>
          	</button>

          </a>
          
        </div>

      </div>
      <!-- /.mailbox-controls -->
      <div class="mailbox-read-message">
        

        <?php echo $ticket[0]["mensaje"] ?>

        
      </div>
      <!-- /.mailbox-read-message -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer bg-white">
      <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
        
      	<?php 

      	
      		if ($ticket[0]["adjuntos"] != "") {

  				$adjuntos = json_decode($ticket[0]["adjuntos"], true);

  				foreach ($adjuntos as $key => $value) {
  					
  					if(substr($value, -3) == "png" || substr($value, -3) == "jpg" || substr($value, -4) == "jpeg"){

  						echo '<li>
				          <span class="mailbox-attachment-icon has-img"><img src="'.$value.'" alt="Attachment"></span><br><br>

				          <div class="mailbox-attachment-info">

				            <a href="'.$value.'" class="mailbox-attachment-name"><i class="fas fa-camera"></i> photo1.png</a>

				                <span class="mailbox-attachment-size clearfix mt-1">

				                  <a href="'.$value.'" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>

				                </span>

				          </div>
				        </li>';

  					}


  					if(substr($value, -3) == "pdf"){

	                	echo '<li>
				          <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

				          <div class="mailbox-attachment-info">
				            <a href="'.$value.'" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> Sep2014-report.pdf</a>
				                <span class="mailbox-attachment-size clearfix mt-1">
				                  
				                  <a href="'.$value.'" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
				                </span>
				          </div>
				        </li>';

                  	}

                  	if(substr($value, -3) == "doc" || substr($value, -4) == "docx"){

                    	echo '<li>
				          <span class="mailbox-attachment-icon"><i class="far fa-file-word"></i></span>

				          <div class="mailbox-attachment-info">
				            <a href="'.$value.'" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
				                <span class="mailbox-attachment-size clearfix mt-1">
				                  
				                  <a href="'.$value.'" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
				                </span>
				          </div>
				        </li>';

                  	}

                  	if(substr($value, -3) == "xls" || substr($value, -4) == "xlsx"){

                    	echo '<li>
				          <span class="mailbox-attachment-icon"><i class="fas fa-file-excel"></i></span>

				          <div class="mailbox-attachment-info">
				            <a href="'.$value.'" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i> App Description.docx</a>
				                <span class="mailbox-attachment-size clearfix mt-1">
				                  
				                  <a href="'.$value.'" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
				                </span>
				          </div>
				        </li>';

                  	}


  				}

  			}	


      	 ?>

      </ul>
    </div>
    <!-- /.card-footer -->
    <div class="card-footer">
      <div class="float-right">

      	<?php if ($_GET["tipo"] == "recibidos"): ?>

      	<a href="index.php?ruta=soporte&soporte=nuevo-msg&para=<?php echo $para?>&asunto=<?php echo $ticket[0]["asunto"]?>&id_para=<?php echo $id_para?>">
      		
					<button type="button" class="btn btn-outline-info"><i class="fas fa-share"></i> Responder</button>      		

				</a>	

      	<?php endif ?>

      	<?php if ($_GET["tipo"] == "enviados"): ?>

      		<a href="index.php?ruta=soporte&soporte=nuevo-msg&para=<?php echo $para?>&asunto=<?php echo $ticket[0]["asunto"]?>&id_para=<?php echo $id_para?>">

						<button type="button" class="btn btn-outline-info"><i class="fas fa-reply"></i> Reenviar</button>      		

					</a>	

      	<?php endif ?>

      </div>
      
      <button type="button" class="btn btn-outline-danger btnPapelera" idTickets="<?php echo $ticket[0]["id_soporte"]; ?>" idUsuario="<?php echo $_SESSION["id"]; ?>"><i class="far fa-trash-alt"></i> Borrar</button>

    </div>
    
  </div>
</section>  