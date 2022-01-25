  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Configuración Web</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
              <li class="breadcrumb-item active">Configuración redes sociales</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Configuración redes sociales</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <?php
                $mostrarConfigRedes = ControladorConfiguracion::ctrMostrarConfigRedes($item = null, $valor = null);

            ?>
            <form action="" method="post">
                <div class="form-group">


                    <!-- Entrada de whatsapp -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigWhatsapp">Whatsapp:</label> &nbsp;
                            <input type="number" class="form-control" name="nuevoConfigWhatsapp" id="nuevoConfigWhatsapp" placeholder="Whatsapp" value="<?php echo $mostrarConfigRedes[0]["whatsapp"] ?>">
                            <input type="hidden" class="form-control" name="nuevoConfigId" id="nuevoConfigId" placeholder="Whatsapp" value="<?php echo $mostrarConfigRedes[0]["id"] ?>">
                            
                        </div>
                    </div>



                    <!-- Entrada de instagram -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigInstagram">Instagram:</label> &nbsp;
                            <input type="text" class="form-control" name="nuevoConfigInstagram" id="nuevoConfigInstagram" placeholder="Link instagram" value="<?php echo $mostrarConfigRedes[0]["instagram"] ?>">
                            
                        </div>
                    </div>

                    <!-- Entrada de email -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigEmail">Correo:</label> &nbsp;
                            <input type="text" class="form-control" name="nuevoConfigEmail" id="nuevoConfigEmail" placeholder="Correo gmail" value="<?php echo $mostrarConfigRedes[0]["email"] ?>">
                            
                        </div>
                    </div>

                    <!-- Entrada de email -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigfacebook">facebook:</label> &nbsp;
                            <input type="text" class="form-control" name="nuevoConfigfacebook" id="nuevoConfigfacebook" placeholder="facebook" value="<?php echo $mostrarConfigRedes[0]["facebook"] ?>">
                            
                        </div>
                    </div>



                </div>
                <button type="submit" class="btn btn-info">Guardar</button>
                <?php
                
                  $editarConfigRedes = new ControladorConfiguracion();
                  $editarConfigRedes -> ctrEditarConfigRedes();
                  

                ?> 
            </form>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>