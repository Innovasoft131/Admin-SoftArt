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
              <li class="breadcrumb-item active">Configuración página de inicio</li>
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
            <h3 class="card-title">Configuración página de inicio</h3>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <?php
                $mostrarConfigInicio = ControladorConfiguracion::ctrMostrarConfigInicio($item = null, $valor = null);

            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">


                    <!-- Entrada de Titulo del Slogan -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoTituloSlogan">Titulo del Slogan:</label> &nbsp;
                            <input type="text" class="form-control" name="nuevoTituloSlogan" id="nuevoTituloSlogan" placeholder="Titulo del Slogan" value="<?php echo $mostrarConfigInicio[0]["tituloSlogan"] ?>">
                            <input type="hidden" class="form-control" name="nuevoConfigInicioId" id="nuevoConfigInicioId" placeholder="id" value="<?php echo $mostrarConfigInicio[0]["id"] ?>">
                            
                        </div>
                    </div>



                    <!-- Entrada de slogan -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigslogan">Slogan:</label> &nbsp;
                            <textarea class="form-control" name="nuevoConfigslogan" id="nuevoConfigslogan" placeholder="Slogan"><?php echo $mostrarConfigInicio[0]["slogan"] ?></textarea>

                            
                        </div>
                    </div>

                    <!-- subir foto de hombre -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label for="fotoActualHombre">Subir Foto de Hombre</label> <br>
                                <input type="file" name="fotoHombre" id="fotoHombre" class="fotoHombre">
                                <p class="help-block">Peso máximo de la foto 200 MB</p>
                                <img src="<?php echo $mostrarConfigInicio[0]["imgHombre"] ?>" class="img-thumbnail previsualizarHombre" width="100px">
                                <input type="hidden" name="fotoActualHombre" id="fotoActualHombre" value="<?php echo $mostrarConfigInicio[0]["imgHombre"] ?>">                
                            </div>
                            <div class="col-4">
                                <label for="fotoActualMujer">Subir Foto de Mujer</label> <br>
                                <input type="file" name="fotoMujer" id="fotoMujer" class="fotoMujer">
                                <p class="help-block">Peso máximo de la foto 200 MB</p>
                                <img src="<?php echo $mostrarConfigInicio[0]["imgMujer"] ?>" class="img-thumbnail previsualizarMujer" width="100px">
                                <input type="hidden" name="fotoActualMujer" id="fotoActualMujer" value="<?php echo $mostrarConfigInicio[0]["imgMujer"] ?>">                
                            </div>
                            <div class="col-4">
                                <label for="fotoActualInfante">Subir Foto de Infante</label> <br>
                                <input type="file" name="fotoInfante" id="fotoInfante" class="fotoInfante">
                                <p class="help-block">Peso máximo de la foto 200 MB</p>
                                <img src="<?php echo $mostrarConfigInicio[0]["imgInfante"] ?>" class="img-thumbnail previsualizarInfante" width="100px">
                                <input type="hidden" name="fotoActualInfante" id="fotoActualInfante" value="<?php echo $mostrarConfigInicio[0]["imgInfante"] ?>">                
                            </div>
                        </div>


                    </div>



                    <!-- Entrada de Título de personalizado -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigTitPers">Título de personalizado:</label> &nbsp;
                            <input type="text" class="form-control" name="nuevoConfigTitPers" id="nuevoConfigTitPers" placeholder="Contraseña de correo" value="<?php echo $mostrarConfigInicio[0]["tituloPers"] ?>">
                            
                        </div>
                    </div>

                    <!-- Entrada de subTítulo de personalizado -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigsubTitPers">Subtítulo de personalizado:</label> &nbsp;
                            <input type="text" class="form-control" name="nuevoConfigsubTitPers" id="nuevoConfigsubTitPers" placeholder="Contraseña de correo" value="<?php echo $mostrarConfigInicio[0]["subTituloPers"] ?>">
                            
                        </div>
                    </div>

                    <!-- Entrada de texto de Personalizado -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigPers">Texto de Personalizado:</label> &nbsp;
                            <textarea class="form-control" name="nuevoConfigPers" id="nuevoConfigPers" placeholder="Texto de Personalizado"><?php echo $mostrarConfigInicio[0]["textoPers"] ?></textarea>

                            
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">
                            <label for="fotoActualPersonalizado">Subir Foto de Personalizado</label> <br>
                            <input type="file" name="fotoInPersonalizado" id="fotoInPersonalizado" class="fotoInPersonalizado">
                            <p class="help-block">Peso máximo de la foto 200 MB</p>
                            <img src="<?php echo $mostrarConfigInicio[0]["imgPers"] ?>" class="img-thumbnail previsualizarPersonalizado" width="100px">
                            <input type="hidden" name="fotoActualPersonalizado" id="fotoActualPersonalizado" value="<?php echo $mostrarConfigInicio[0]["imgPers"] ?>">                
                        </div>
                    </div>


                </div>
                <button type="submit" class="btn btn-info">Guardar</button>
                <?php
                
                  $editarConfigRedes = new ControladorConfiguracion();
                  $editarConfigRedes -> ctrEditaConfigInicio();
                  

                ?> 
            </form>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>