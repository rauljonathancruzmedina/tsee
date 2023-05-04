
  <div class="content-wrapper">
    
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Chat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Chat</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      

      <div class="container-fluid">
        
        <div class="content">
          
          <div class="row">
            
            <div class="col-md-3">
              
              <?php  

                include "soporte/botones.php";

              ?>

            </div>

            <div class="col-md-9">
              
              <?php  

                if (isset($_GET["soporte"])) {
                  
                  include "soporte/".$_GET["soporte"].".php";

                } else {

                  include "soporte/nuevo-msg.php";

                }

              ?>

            </div>

          </div>

        </div>

        <?php  

          //include "soporte/nuevo-msg.php";

        ?>


      </div>


    </section>
    <!-- /.content -->
  </div>