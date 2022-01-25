  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inicio</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class = "row">
            <?php
              include "inicio/cajas_superiores.php"
            ?>

          </div>

          <div class="row">
            <div class="col-lg-12">
              <?php
              //  include "inicio/piezas_mas_vendidas.php";
              ?>
            </div>
          </div>

        </div>
        <!-- /.card-body -->
        <!--div class="card-footer">
          
        </div -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->


    </section>
    <!-- /.content -->
  </div>