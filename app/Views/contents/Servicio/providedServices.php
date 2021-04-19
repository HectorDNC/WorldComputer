<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Servicio Prestado</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <a  href="<?= ROOT;?>Servicio/create">
            <button class="btn btn-primary" 
            <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Servicios Prestados") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
            ><i class="fas fa-plus-square"></i> Agregar Servicio Prestado</button>
          </a>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Código</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cliente</th>
                <th scope="col">Acción</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal de mostrar -->
<div class="modal fade" id="modalMostrarServicio" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <div class="card">

            <div class="card-header">
                <div class="row justify-content-center">
                    <h2 class="card-tittle text-center">Detalle Servicio Prestado</h2>
                </div>
            </div>

            <div class="card-body">
                <div class="row justify-content-end">
                    <label for="" class="col-form-label col-md-4"><strong>NRO SERVICIO PRESTADO:</strong> </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control-plaintext" id="servicio_codigo" disabled>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <label for="" class="col-form-label col-md-4"><strong>FECHA:</strong></label>
                    <div class="col-md-3">
                        <input type="text" id="fecha" class="form-control-plaintext" value="" disabled>
                    </div>
                </div>

                <hr>

                <div class="row pl-5">
                    <h4>CLIENTE</h4>
                </div>

                <div class="row pl-5">
                    <label for="" class="col-form-label col-md-2"><strong>NOMBRE:</strong></label>
                    <div class="col-md-4">
                        <input type="text" id="cliente" class="form-control-plaintext" value="MICROTECH" disabled>
                    </div>

                    <label for="" class="col-form-label col-md-2"><strong> CEDULA/RIF:</strong></label>
                    <div class="col-md-4">
                        <input type="text" id="cliente_documento" class="form-control-plaintext" value="J-26540950" disabled>
                    </div>
                </div>

                <div class="row pl-5">
                    <label for="" class="col-form-label col-md-2"><strong>DIRECCION:</strong></label>
                    <div class="col-md-10">
                        <input type="text" id="cliente_direccion" class="form-control-plaintext" value="BARQUISIMETO" disabled>
                    </div>                  
                </div>
                <hr>

                <div class="row pl-5">
                    <h4>EMPLEADO</h4>
                </div>

                <div class="row pl-5">
                    <label for="" class="col-form-label col-md-2"><strong>NOMBRE:</strong></label>
                    <div class="col-md-4">
                        <input type="text" id="empleado" class="form-control-plaintext" value="MICROTECH" disabled>
                    </div>

                    <label for="" class="col-form-label col-md-2"><strong> CEDULA/RIF:</strong></label>
                    <div class="col-md-4">
                        <input type="text" id="empleado_documento" class="form-control-plaintext" value="J-26540950" disabled>
                    </div>
                </div>

                <div class="row pl-5">
                    <label for="" class="col-form-label col-md-2"><strong>DIRECCION:</strong></label>
                    <div class="col-md-10">
                        <input type="text" id="empleado_direccion" class="form-control-plaintext" value="BARQUISIMETO" disabled>
                    </div>                  
                </div>

                <hr>

                <div class="row justify-content-center">
                    <h4>SERVICIOS</h4>
                </div>

                <div class="row">
                    <div class=" table-responsive">
                        <table class="table table-striped table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>CÓDIGO</th>
                                    <th>SERVICIO</th>
                                    <th>PRECIO $</th>
                                    <th>PRECIO BSS</th>
                                </tr>
                            </thead>
    
                            <tbody id="cuerpoServicios">
    
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row justify-content-start">
                      <label for="" class="col-form-label col-md-2"><strong>TOTAL DE LOS SERVICIOS:</strong> </label>
                      <div class="col-md-10">
                          <input type="text" class="form-control-plaintext" id="totalServicios" disabled>
                      </div>
                  </div>

                <hr class="productos bg-dark">
                <div class="row justify-content-end productos mb-3">
                  <label for="" class="col-form-label col-md-3"><strong>NRO VENTA:</strong> </label>
                  <div class="col-md-3">
                      <input type="text" class="form-control-plaintext" id="venta_codigo" disabled>
                  </div>
                </div>
                <div class="row justify-content-center productos">
                  
                  <h4>PRODUCTOS</h4>
                </div>

                <div class="row productos">
                    <div class=" table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>CANTIDAD</th>
                                    <th>CÓDIGO</th>
                                    <th>PRODUCTO</th>
                                    <th>PRECIO VENTA</th>
                                    <th>TOTAL $</th>
                                    <th>TOTAL BSS</th>
                                </tr>
                            </thead>
    
                            <tbody id="cuerpo">
    
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="content productos">
                  <div class="row justify-content-start">
                      <label for="" class="col-form-label col-md-2"><strong>SUB-TOTAL:</strong> </label>
                      <div class="col-md-10">
                          <input type="text" class="form-control-plaintext" id="subtotal" disabled>
                      </div>
                  </div>
                  <div class="row justify-content-start">
                      <label for="" class="col-form-label col-md-2"><strong>IVA(<span id="iva"></span>%):</strong> </label>
                      <div class="col-md-10">
                          <input type="text" class="form-control-plaintext" id="impuesto" disabled>
                      </div>
                  </div>
                  <div class="row justify-content-start">
                      <label for="" class="col-form-label col-md-2"><strong>TOTAL DE LOS PRODUCTOS:</strong> </label>
                      <div class="col-md-10">
                          <input type="text" class="form-control-plaintext" id="total" disabled>
                      </div>
                  </div>
                </div>
                
                <hr>
                <div class="row justify-content-start">
                  <label for="" class="col-form-label col-md-2"><strong>TOTAL:</strong> </label>
                  <div class="col-md-10">
                      <input type="text" class="form-control-plaintext" id="totalServicioPrestado" disabled>
                  </div>
                </div>

                <hr>
                <div class="row justify-content-center">
                    <button class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-window-close"></i> Cerrar</button>
                </div>
            
            </div>


        </div>

        </div>
    </div>
</div>

<script>
    let empleados = <?= json_encode($empleados) ?>;
    let ventas = <?= json_encode($ventas) ?>;
    let servicios = <?= json_encode($servicios) ?>;
</script>
<script src="<?= ROOT; ?>public/assets/js/servicio/providedServices.js"></script>
