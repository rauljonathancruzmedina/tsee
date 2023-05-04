<?php 

  $item = "id";
  $valor = 1;
  $empres = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);

?>


<!-- Main Footer -->
  <footer class="main-footer">
    <strong>&copy; <?php echo $empres["nombre"] ?> <a href=""><?php echo $empres["correo"] ?></a>.</strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b>Fecha </b> <?php echo date('d/m/Y') ?>
    </div>
  </footer>