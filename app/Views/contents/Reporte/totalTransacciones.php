<div class="content p-4">
  <hr class="bg-danger" />

  <div class="row justify-content-center mb-3">
    <a href="#" class="btn btn-flat bg-primary mr-3 text-white">
      <i class="fas fa-chart-line fa-2x"></i>
    </a>

    <a href="#" class="btn bg-danger text-white">
      <i class="fas fa-file-pdf fa-2x"></i>
    </a>
  </div>

    <div class="card shadow">
      <div class="card-header">
        <h2 class="text-center">Resumen</h2>
      </div>

      <div class="card-body" with="100">
          <div class="container"></div>
        <div class="row">
          <div class="col-md-4 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>INGRESOS</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $ingresos ?></strong>
            </div>
          </div>

          <div class="col-md-4 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>EGRESOS</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $egresos ?></strong>
            </div>
          </div>

          <div class="col-md-4 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>BALANCE</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $ingresos - $egresos ?></strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mt-3">
      <div class="card-header bg-danger text-white">
        <h2 class="text-center">Total de Compras</h2>
      </div>

      <div class="card-body">
        <div class="form-row">
          <div class="col-md-6 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>CANTIDAD</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $compras ?></strong>
            </div>
          </div>

          <div class="col-md-6 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>EGRESOS</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $egresos ?></strong>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card shadow mt-3">
      <div class="card-header bg-success text-white">
        <h2 class="text-center">Total de Ventas</h2>
      </div>

      <div class="card-body">
        <div class="form-row">
          <div class="col-md-4 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>CANTIDAD</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $ventas ?></strong>
            </div>
          </div>

          <div class="col-md-4 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>INGRESOS</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $ingresos ?></strong>
            </div>
          </div>

          <div class="col-md-4 form-group">
            <div class="row justify-content-center">
              <strong>
                <h6>GANANCIAS</h6>
              </strong>
            </div>
            <div class="row justify-content-center">
              <strong class="format"><?= $ingresos - $egresos < 0 ? 0 : $ingresos - $egresos ?></strong>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<script src="<?= ROOT; ?>public/assets/js/reportes/totalTransacciones.js"></script>
