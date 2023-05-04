<!--<script >
    
        $('.menuEnvi').addClass("active");

</script>
-->

<section class="content">
<div class="card card-primary card-outline">
    <div class="card-header">
      
      <h3 class="card-title">Mensajes enviados</h3>

      <div class="mailbox-controls float-right">
        <!-- Check all button -->
        <button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Seleccionar todo"><i class="far fa-square"></i>
        </button>
        <div class="btn-group">

          <button type="button" class="btn btn-outline-danger btn-sm btnPapelera" title="Borrar" idTickets idUsuario="<?php echo $_SESSION["id"]; ?>" tipoTickets="papelera">
            <i class="far fa-trash-alt"></i>
          </button>

        </div>
        
        <a href="index.php?ruta=soporte&soporte=msg-enviados"
          class="btn btn-outline-success btn-sm" title="Actualizar"><i class="fas fa-sync-alt"></i>
        </a>

      </div>


    </div>
    <!-- /.card-header -->
    <div class="card-body">

      <input type="hidden" class="tipoMsj" value="enviados" name="">
      <input type="hidden" class="idUsuario" value="<?php echo $_SESSION["id"] ?>" name="">

      <div class="table-responsive mailbox-messages">

        <table id="example3" class="table table-bordered table-striped tablaMsj">
          <thead>
          <tr>
            <th>Seleccionar</th>
            <th>Recibe</th>
            <th>Asunto</th>
            <th>Adjunto</th>
            <th>Fecha y hora</th>
          </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
        <!-- /.table -->
      </div>
      <!-- /.mail-box-messages -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer p-0">
      
    </div>
  </div>

</section>          