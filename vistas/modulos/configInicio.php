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
              <li class="breadcrumb-item active">Configuración ecommerce</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content configuracion ecommerce -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Configuración ecommerce</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <?php
              $mostrarConfigInicio = ControladorConfiguracion::ctrMostrarConfig($item = null, $valor = null);
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">

                  <!-- Entrada del nombre de la empresa -->
                  <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nombreEmpresa">Nombre de la empresa:</label> &nbsp;
                            <input type="text" class="form-control" name="nombreEmpresa" id="nombreEmpresa" placeholder="Nombre de la empresa" value="<?php echo $mostrarConfigInicio[0]["nombreTienda"] ?>">
                            <input type="hidden" class="form-control" name="idConfig" id="idConfig"  value="<?php echo $mostrarConfigInicio[0]["id"] ?>">
                            
                        </div>
                    </div>

                  <!-- Entrada del direccion de la empresa -->
                  <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="direccion">Dirección de la empresa (opcional):</label> &nbsp;
                            <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección de la empresa (opcional)" value="<?php echo $mostrarConfigInicio[0]["direccion"] ?>">
                            
                        </div>
                    </div>

                    <!-- Entrada de logos -->
                    <div class="form-group">
                        <div class="row"> 
                          <div class="col-6">
                            <label for="fotoActuallogo">Subir Foto del logo</label> <br>
                            <input type="file" name="fotologo" id="fotologo" class="fotologo">
                            <p class="help-block">Peso máximo de la foto 200 MB</p>
                            <img src="<?php echo $mostrarConfigInicio[0]["logo"] ?>" class="img-thumbnail previsualizarlogo" width="100px">
                            <input type="hidden" name="fotoActuallogo" id="fotoActuallogo" value="<?php echo $mostrarConfigInicio[0]["logo"] ?>">  
                          </div>  

                          <div class="col-6">
                            <label for="fotoActuallogoicon">Subir icono del logo</label> <br>
                            <input type="file" name="fotologoicon" id="fotologoicon" class="fotologoicon">
                            <p class="help-block">
                              Peso máximo de la foto 200 MB
                            </p>
                            <img src="<?php echo $mostrarConfigInicio[0]["logoIcon"] ?>" class="img-thumbnail previsualizarIcono" width="100px">
                            <input type="hidden" name="fotoActuallogoicon" id="fotoActuallogoicon" value="<?php echo $mostrarConfigInicio[0]["logoIcon"] ?>">  
                          </div>  
                            
                        </div>
                    </div>



                    <!-- Entrada del tamaño del logo en menu y pie de pagina -->
                    <div class="form-group">
                        <div class="row">  
                            <div class="col-6">
                              <label for="tamanioLogoMenu">Tamaño del logo en Menú:</label> &nbsp;
                              <input type="number" min="0" step="0.1" class="form-control" name="tamanioLogoMenu" id="tamanioLogoMenu" value="<?php echo $mostrarConfigInicio[0]["tamanioLogoMenu"] ?>">

                            </div>
                            <div class="col-6">
                              <label for="tamanioLogoPie">Tamaño del logo en pie de pagina:</label> &nbsp;
                              <input type="number" min="0" step="0.1" class="form-control" name="tamanioLogoPie" id="tamanioLogoPie" value="<?php echo $mostrarConfigInicio[0]["tamanioLogoPie"] ?>">
                            </div> 

                            
                        </div>
                    </div>

                    <!-- entrada de colores de la empresa -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <label for="colorCorporativo">Color corporativo:</label> <br>
                                <input type="color" title="Color corporativo" class="btnColor" name="colorCorporativo" id="colorCorporativo" value="<?php echo $mostrarConfigInicio[0]["colorCorporativo"] ?>">             
                            </div>
                            <div class="col-2">
                                <label for="colorTexto">Color del texto en web:</label> <br>
                                <input type="color" title="Color del texto" class="btnColor" name="colorTexto" id="colorTexto" value="<?php echo $mostrarConfigInicio[0]["colorTexto"] ?>">
                            </div>
                            <div class="col-2">
                              <label for="colorPie">Color del pie de pagina:</label> <br>
                              <input type="color" title="Color del texto" class="btnColor" name="colorPie" id="colorPie" value="<?php echo $mostrarConfigInicio[0]["colorPie"] ?>">              
                            </div>
                            <div class="col-2">
                              <label for="colorTextoPie">Color del texto en pie:</label> <br>
                              <input type="color" title="Color del texto" class="btnColor" name="colorTextoPie" id="colorTextoPie" value="<?php echo $mostrarConfigInicio[0]["colorTextoPie"] ?>">              
                            </div>
                            <div class="col-2">
                              <label for="colorMenu">Color del menú:</label> <br>
                              <input type="color" title="Color del menú" class="btnColor" name="colorMenu" id="colorMenu" value="<?php echo $mostrarConfigInicio[0]["colorMenu"] ?>">              
                            </div>
                            <div class="col-2">
                              <label for="colorTextoMenu">Color del texto en menú:</label> <br>
                              <input type="color" title="Color del contenido en menú" class="btnColor" name="colorTextoMenu" id="colorTextoMenu" value="<?php echo $mostrarConfigInicio[0]["colorTextoMenu"] ?>">              
                            </div>
                        </div>


                    </div>


                </div>
                <button type="submit" class="btn btn-info">Guardar</button>
                <?php
                
                  $editarConfigRedes = new ControladorConfiguracion();
                  $editarConfigRedes -> ctrEditaConfigPagina();
                  

                ?> 
            </form>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
        <!-- Main content configuracion pagina inicio -->
        <section class="content">
      <div class="container-fluid">
        <div class="card card-danger card-outline">
          <div class="card-header">
            <h3 class="card-title">Configuración ecommerce inicio</h3>
            <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          </div> <!-- /.card-body -->
          <div class="card-body">
            <?php
              $mostrarConfigInicio = ControladorConfiguracion::ctrMostrarConfigInicio($item = null, $valor = null);
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">

                  <!-- Entrada del titulo  slogan -->
                  <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="slogan">Titulo Slogan:</label> &nbsp;
                            <input type="text" class="form-control" name="slogan" id="slogan" placeholder="Titulo Slogan" value="<?php echo $mostrarConfigInicio[0]["slogan"] ?>">
                            <input type="hidden" class="form-control" name="idConfigInicio" id="idConfigInicio"  value="<?php echo $mostrarConfigInicio[0]["id"] ?>">
                            
                        </div>
                    </div>

                    <!-- Entrada de slogan -->
                    <div class="input-group mb-3">
                        <div class="form-group col-md-12">   
                            <label for="nuevoConfigslogan">Slogan:</label> &nbsp;
                            <textarea class="form-control" name="nuevoConfigslogan" id="nuevoConfigslogan" placeholder="Slogan"><?php echo $mostrarConfigInicio[0]["parrafoSlogan"] ?></textarea>

                            
                        </div>
                    </div>

                     <!-- entrada de colores del slogan -->
                     <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <label for="colorSpan">Color en palabra de slogan:</label> <br>
                                <input type="color" title="Color en palabra de slogan" class="btnColor" name="colorSpan" id="colorSpan" value="<?php echo $mostrarConfigInicio[0]["colorSpan"] ?>">             
                            </div>
                            <div class="col-3">
                                <label for="colorTexto">Color slogan:</label> <br>
                                <input type="color" title="Color slogan" class="btnColor" name="colorSlogan" id="colorSlogan" value="<?php echo $mostrarConfigInicio[0]["colorSlogan"] ?>">
                            </div>
                            <div class="col-3">
                              <label for="colorParrafo">Color del texto:</label> <br>
                              <input type="color" title="Color del texto" class="btnColor" name="colorParrafo" id="colorParrafo" value="<?php echo $mostrarConfigInicio[0]["colorParrafo"] ?>">              
                            </div>

                        </div>


                    </div>


                    <!-- Entrada del tamaño del slogan -->
                    <div class="form-group">
                        <div class="row">  
                            <div class="col-6">
                              <label for="tamanioSlogan">Tamaño de fuente del slogan:</label> &nbsp;
                              <input type="number" min="0" step="0.1" class="form-control" name="tamanioSlogan" id="tamanioSlogan" value="<?php echo $mostrarConfigInicio[0]["tamanioSlogan"] ?>">

                            </div>
                            <div class="col-6">
                              <label for="tamanioParrafo">Tamaño de fuente del párrafo:</label> &nbsp;
                              <input type="number" min="0" step="0.1" class="form-control" name="tamanioParrafo" id="tamanioParrafo" value="<?php echo $mostrarConfigInicio[0]["tamanioParrafo"] ?>">
                            </div> 

                            
                        </div>
                    </div>

                    <!-- Entrada de imagen -->
                    <div class="form-group">
                        <div class="row"> 
                          <div class="col-12">
                            <label for="fotoBanner">Subir Foto del banner</label> <br>
                            <input type="file" name="fotoBanner" id="fotoBanner" class="fotoBanner">
                            <p class="help-block">Peso máximo de la foto 200 MB</p>
                            <img src="<?php echo $mostrarConfigInicio[0]["img"] ?>" class="img-thumbnail previsualizarBanner" width="100px">
                            <input type="hidden" name="fotoActualbanner" id="fotoActualbanner" value="<?php echo $mostrarConfigInicio[0]["img"] ?>">  
                          </div>  

 
                            
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