<?php 

  $usuarios = ControladorUsuarios::ctrMostrarUsuarios(null, null);

?>

<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Crear nuevo mensaje</h3>
  </div>

<form method="post" enctype="multipart/form-data">  

  <!-- /.card-header -->
  <div class="card-body">
    <div class="form-group">
      <input type="hidden" class="form-control" value="<?php echo $_SESSION["id"]; ?>" name="remitente">
      <label>Para:</label>

      <?php if ($_SESSION["perfil"] != "Administrador"): ?>

            <?php if (isset($_GET["para"])): ?>
          
              <input type="text" class="form-control" value="<?php echo $_GET["para"]; ?>" readonly required>

              <input type="hidden" class="form-control" name="receptor" value="<?php echo $_GET["id_para"]; ?>">

            <?php else: ?>

              <select class="select2" name="receptor" data-placeholder="Seleccionar usuarios" data-dropdown-css-class="select2-purple" style="width: 100%;">
            
                <option></option>

              <?php foreach ($usuarios as $key => $value): ?>

                <?php if ($value["id"] != $_SESSION["id"]): ?>
                  
                  <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]; ?></option>

                <?php endif ?>
                
              <?php endforeach ?>

              </select>
              
            <?php endif ?> 

      <?php else: ?> 

        <?php if (isset($_GET["para"])): ?>
          
          <input type="text" class="form-control" value="<?php echo $_GET["para"]; ?>" readonly required>

          <input type="hidden" class="form-control" name="receptor" value="<?php echo $_GET["id_para"]; ?>">

        <?php else: ?>

          <select class="select2" name="receptor[]" multiple="multiple" data-placeholder="Seleccionar usuarios" data-dropdown-css-class="select2-purple" style="width: 100%;">  

            <?php foreach ($usuarios as $key => $value): ?>

              <?php if ($value["id"] != $_SESSION["id"]): ?>
                
                <option value="<?php echo $value["id"]; ?>"><?php echo $value["nombre"]; ?></option>

              <?php endif ?>
              
            <?php endforeach ?>      

            <option value="0">Todos los usuarios</option>
            
          </select>

        <?php endif ?>

      <?php endif ?>


    </div>
    <div class="form-group">
      

      <label>Asunto</label>

        <?php if (isset($_GET["asunto"])): ?>
            
          <input type="text" class="form-control" value="<?php echo $_GET["asunto"] ?>" name="asunto" readonly required>          

        <?php else: ?>

          <input type="text" class="form-control" name="asunto" required>

        <?php endif ?>


    </div>

    <div class="form-group">

        <textarea id="compose-textarea" class="form-control" name="msj" style="height: 300px">
          

        </textarea>
    </div>
    <div class="form-group">
      <div class="btn btn-default btn-file">

        <i class="fas fa-paperclip"></i> Adjuntar
        <input type="file" class="subirAdjuntos" multiple>

        <input type="hidden" name="adjuntos" class="archivosTemporales">

      </div>

      <p class="help-block">Archivos con peso máximo de 32MB</p>

    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">

    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">


    </ul>


    <div class="float-right">

      <button type="submit" class="btn btn-success"><i class="fas fa-envelope"></i> Enviar</button>

      <button type="reset" class="btn btn-danger"><i class="fas fa-times"></i> Cancelar</button>

    </div>

  </div>

</form>

<?php 

    $crearMensaje = new ControladorSoporte();
    $crearMensaje -> ctrCrearTicket();

?>

  <!-- /.card-footer -->
</div>