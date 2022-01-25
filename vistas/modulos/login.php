<!-- div id="loginCristal"></div -->
<div id="back"></div>
<div class="login-box" >
  <div class="card card-outline card-primary" id="loginCristal">
    <div class="card-header text-center">
      <img src="vistas/img/plantilla/logo_login.png"    width="153px" class="img-responsive" >
    </div>

    <div class="card-body  loginSC" >
      <p class="login-box-msg">Ingresar al sistema</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" require>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">  
          <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" require>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">


          <div class="col-lg-12">
            <button type="submit" class="btn btn-primary btn-block rounded-pill">Ingresar</button>
          </div>

        </div>

        <?php
          $login = new ControladorUsuarios();
          $login -> ctrIngresoUsuario();
        ?>
      </form>

    


  
      </p>
    </div>

  </div>

</div>