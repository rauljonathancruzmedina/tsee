<section class="content">
<div class="card card-primary card-outline">
    <div class="card-header">
      
      <h3 class="card-title">Mensages eliminados</h3>

      <div class="mailbox-controls float-right">
        <!-- Check all button 
        <button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Seleccionar"><i class="far fa-square"></i>
        </button>-->
        <div class="btn-group">

          <button type="button" class="btn btn-outline-info btn-sm btnPapelera" title="Recuperar mensaje" idTickets idUsuario="<?php echo $_SESSION["id"]; ?>" tipoTickets="enviado">
            <i class="fas fa-recycle"></i>
          </button>

        </div>
        
        <a href="index.php?ruta=soporte&soporte=papelera" title="Actualizar"
          class="btn btn-outline-success btn-sm"><i class="fas fa-sync-alt"></i>
        </a>

      </div>


    </div>
    <!-- /.card-header -->
    <div class="card-body">

      

      <input type="hidden" class="tipoMsj" value="papelera" name="">
      <input type="hidden" class="idUsuario" value="<?php echo $_SESSION["id"] ?>" name="">


      <div class="table-responsive mailbox-messages">

        <table id="example3" class="table table-bordered table-striped tablaMsj">
          <thead>
          <tr>
            <th>Seleccionar</th>
            <th>Remitente</th>
            <th>Receptor</th>
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