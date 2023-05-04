<?php 

  $item = "id";
  $valor = 1;
  $empres = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);

 ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="inicio" class="brand-link">
      <img src="<?php echo $empres["foto"] ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $empres["nombre"] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $_SESSION["foto"] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["usuario"] ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="inicio" class="nav-link">
              <i class="fas fa-home"></i>
              <p>
                Inicio
              </p>
            </a>
          </li>

          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-users"></i>
              <p>
                Personas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
            <?php if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {   

              echo'<li class="nav-item">
                <a href="usuarios" class="nav-link active">
                  <i class="fas fa-user"></i>
                  <p>Usuarios</p>
                </a>
              </li>';

             } 

            ?>  

              <li class="nav-item">
                <a href="clientes" class="nav-link ">
                  <i class="fas fa-user-circle"></i>
                  <p>Clientes</p>
                </a>
              </li>
            </ul>
          </li>
          
          <?php if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {   

              echo'<li class="nav-item">
                    <a href="categorias" class="nav-link">
                     <i class="fas fa-grip-horizontal"></i>
                      <p>
                        Categorías
                        
                      </p>
                    </a>
                  </li>';

             } 

           ?>
          
         <?php if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {   

            echo' <li class="nav-item">
                    <a href="productos" class="nav-link">
                     <i class="fab fa-product-hunt"></i>
                      <p>
                        Productos
                       
                      </p>
                    </a>
                  </li>';

             } 

          ?>

        <!-- APARTADO VENTAS -->
        
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-shopping-cart"></i>
             
              <p>
                Ventas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="crear-venta" class="nav-link">
                 <i class="fas fa-cart-plus"></i>
                  <p>Crear venta</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ventas" class="nav-link">
                  <i class="fas fa-cash-register"></i>
                  <p>Administrar Ventas</p>
                </a>
              </li>

              <?php if ($_SESSION["perfil"] == "Administrador") {   

            echo'
                 <li class="nav-item">
                  <a href="reporte-venta" class="nav-link ">
                    <i class="fas fa-chart-bar"></i>
                    <p>Reporte Ventas</p>
                  </a>
                </li>';

             } 

          ?>

            </ul>
          </li>
          
            <!-- APARTADO COTIZACION -->
        
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-shopping-bag"></i>
              <p>
                Cotización
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="crear-cotizacion" class="nav-link">
                 <i class="fas fa-shopping-basket"></i>
                  <p>Crear cotización</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="cotizacion" class="nav-link">
                  <i class="fas fa-shopping-basket"></i>
                  <p>Administrar cotización</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- APARTADO SERVICIOS -->
        
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-briefcase"></i>
             
              <p>
                Servicios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
          <?php if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {   

            echo'<li class="nav-item">
                  <a href="crear-mantenimiento" class="nav-link">
                   <i class="fas fa-business-time"></i>
                    <p>Servicios</p>
                  </a>
                </li>';

             } ?>

              <li class="nav-item">
                <a href="crear-orden-mantenimiento" class="nav-link">
                 <i class="fas fa-chalkboard-teacher"></i>
                  <p>Crear Servicio</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="mantenimiento" class="nav-link">
                  <i class="fas fa-file-signature"></i>
                  <p>Administrar Servicio</p>
                </a>
              </li>

            </ul>
          </li>

        


            <!-- APARTADO INTERNET -->
        
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="fas fa-broadcast-tower"></i>
              <p>
                Internet
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
          <?php if ($_SESSION["perfil"] == "Sub administrador" || $_SESSION["perfil"] == "Administrador") {   

            echo' <li class="nav-item">
                    <a href="serviciosI" class="nav-link">
                     <i class="fab fa-gitter"></i>
                      <p>Tipo Internet</p>
                    </a>
                  </li>';

             } ?>

              <li class="nav-item">
                <a href="clientesI" class="nav-link ">
                  <i class="fas fa-user-circle"></i>
                  <p>Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pagos" class="nav-link ">
                  <i class="far fa-chart-bar"></i>
                  <p>Administrar pagos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pagos-atrsados" class="nav-link ">
                  <i class="fa fa-user-tag"></i>
                  <p>Pagos atrasados</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
              <a href="soporte" class="nav-link ">
                <i class="fas fa-comment"></i>
                <p>chat</p>
              </a>
            </li>

            <?php if ($_SESSION["perfil"] == "Administrador") {   

            echo'<li class="nav-item">
                  <a class="nav-link btnEditarEmpresa" id="1">
                    <i class="nav-icon fa fa-home"></i>
                    <p>Empresa</p>
                  </a>
                </li>';

             } ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>