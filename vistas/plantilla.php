<?php

  session_start();

  $empresa = ControladorEmpresa::ctrMostrarEmpresa("id", 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $empresa["nombre"]; ?></title>
  <link rel="icon" href="<?php echo $empresa["foto"]; ?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
  <link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs 
  <link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->


  <!-- iCheck -->
  <link rel="stylesheet" href="vistas/plugins/nuevo/iCheck-flat-blue.css">


  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="vistas/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  
   <link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="vistas/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="vistas/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="vistas/plugins/morris.js/morris.css">
  
  <!-- summernote -->
  <link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.min.css">
   <!-- Toastr -->
  <link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  


  <script src="vistas/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="vistas/plugins/toastr/toastr.min.js"></script>
   <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="vistas/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
 
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="vistas/dist/js/pages/dashboard3.js"></script>
    <!-- InputMask -->
  <script src="vistas/plugins/moment/moment.min.js"></script>

  <script src="vistas/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="vistas/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Select2 -->
  <script src="vistas/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
  <script src="vistas/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="vistas/plugins/jszip/jszip.min.js"></script>
  <script src="vistas/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="vistas/plugins/pdfmake/vfs_fonts.js"></script>
   <!-- FLOT CHARTS -->
  <script src="vistas/plugins/morris.js/morris.min.js"></script>
  <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
  <script src="vistas/plugins/raphael/raphael.min.js"></script>
  <!-- ChartJS -->
  <script src="vistas/plugins/chart.js/Chart.min.js"></script>
  

 

</head>



<?php 

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {
    echo '<body class="hold-transition sidebar-mini sidebar-collapse">';
    echo '<div class="wrapper">';

      /*=============================================
      CABEZOTE
      =============================================*/

      include "modulos/cabecera.php";
      /*=============================================
      MENU
      =============================================*/

      include "modulos/menu.php";

      /*=============================================
      CONTENIDO 
      =============================================*/

      if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||
         $_GET["ruta"] == "usuarios" ||
         $_GET["ruta"] == "categorias" ||
         $_GET["ruta"] == "editar-categoria" ||
         $_GET["ruta"] == "agregar-categorias" ||
         $_GET["ruta"] == "productos" ||
         $_GET["ruta"] == "clientes" ||
         $_GET["ruta"] == "ventas" ||
         $_GET["ruta"] == "crear-venta" ||
         $_GET["ruta"] == "editar-venta" ||
         $_GET["ruta"] == "empresa" ||
         $_GET["ruta"] == "agregar-usuarios" ||
         $_GET["ruta"] == "editar-usuario" ||
         $_GET["ruta"] == "agregar-productos" ||
         $_GET["ruta"] == "reporte-venta" ||
         $_GET["ruta"] == "editar-producto" ||
         $_GET["ruta"] == "cotizacion" ||
         $_GET["ruta"] == "crear-cotizacion" ||
         $_GET["ruta"] == "editar-cotizacion" ||
         $_GET["ruta"] == "ejemplochart" ||
         $_GET["ruta"] == "mantenimiento" ||
         $_GET["ruta"] == "crear-mantenimiento"||
         $_GET["ruta"] == "crear-orden-mantenimiento"||
         $_GET["ruta"] == "editar-orden-mantenimiento"||
         $_GET["ruta"] == "clientesI"||
         $_GET["ruta"] == "pagos-atrsados"||
         $_GET["ruta"] == "pagos"||
         $_GET["ruta"] == "serviciosI"||
         $_GET["ruta"] == "cobro-internet"||
         $_GET["ruta"] == "soporte" ||

         $_GET["ruta"] == "salir"){

        include "modulos/".$_GET["ruta"].".php";

      }else{
          
          include "modulos/404.php";
      }
    
    }else{

        include "modulos/crear-venta.php";
    
    }

      /*=============================================
      FOOTER
      =============================================*/
      include "modulos/footer.php";

      echo '</div>';
      echo '</body>';
      
    }else{
      echo '<body class="hold-transition light-mode sidebar-collapse sidebar-mini login-page">'; 
      include "modulos/login.php";   
      echo '</body>';
    }

    ?>  



  <!-- Summernote -->
  <script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>

  <!-- iCheck -->
  <!-- https://github.com/fronteed/iCheck/ -->
  <script src="vistas/plugins/nuevo/icheck.min.js"></script>
  

 <!-- AdminLTE for demo purposes -->
  <script src="vistas/dist/js/demo.js"></script>
  <!-- AdminLTE -->
  <script src="vistas/dist/js/adminlte.js"></script>




<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/clientes.js"></script>
<script src="vistas/js/productos.js"></script>
<script src="vistas/js/categorias.js"></script>
<script src="vistas/js/ventas.js"></script>
<script src="vistas/js/reportes.js"></script>
<script src="vistas/js/cotizacion.js"></script>
<script src="vistas/js/empresa.js"></script>
<script src="vistas/js/service.js"></script>
<script src="vistas/js/mantenimiento.js"></script>
<script src="vistas/js/servicio.js"></script>
<script src="vistas/js/clientesI.js"></script>
<script src="vistas/js/pagos.js"></script>
<script src="vistas/js/chat.js"></script>

</html>
