<div id="back"></div>
<?php

$Empresa = ControladorEmpresa::ctrMostrarEmpresa("id", 1);
 
?>

<div class="login-box">

  <div class="login-logo">
                        
    <img src="<?php echo $Empresa["foto"]; ?>" class="img-fuld img-responsive"  style=" max-width:100%; width:200px; height:200px;">
  
  </div>
  
  <div class="card">
  
    <div class="card-body login-card-body">
  
      <p class="login-box-msg">Iniciar Sesión</p>

      <form method="post">
  
        <div class="input-group mb-3">
  
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
  
          <div class="input-group-append">
  
            <div class="input-group-text">
  
              <span class="fas fa-user"></span>
  
            </div>
  
          </div>
  
        </div>
  
        <div class="input-group mb-3">
  
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
  
          <div class="input-group-append">
  
            <div class="input-group-text">
  
              <span class="fas fa-lock"></span>
  
            </div>
  
          </div>
  
        </div>
  
        <div class="row">
      
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">ingresar</button>
          </div>
          
        </div>

        <?php

          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();

        ?>

      </form>

    </div>

  </div>

</div>
