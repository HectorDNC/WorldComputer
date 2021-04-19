<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Venta</h2>

    <div class="card mb-4">
        <!--<div class="card-header bg-white">
          <a  href="<?= ROOT;?>Venta/crear">
            <button class="btn btn-primary" 
            <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Ventas") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
            ><i class="fas fa-plus-square"></i> Agregar Venta</button>
          </a>
        </div> -->
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


<!-- Modal Detalle Venta -->
<div class="modal fade" id="modalDetalleVenta" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

        <div class="card">

            <div class="card-header">
                <div class="row justify-content-center">
                    <h2 class="card-tittle text-center">Detalle Venta</h2>
                </div>
            </div>

            <div class="card-body">
                <div class="row justify-content-end">
                    <label for="" class="col-form-label col-md-2"><strong>NRO VENTA:</strong> </label>
                    <div class="col-md-3">
                        <input type="text" class="form-control-plaintext" id="numero_venta" disabled>
                    </div>
                </div>
                <div class="row justify-content-end">
                    <label for="" class="col-form-label col-md-2"><strong>FECHA:</strong></label>
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
                        <input type="text" id="nombre_cliente" class="form-control-plaintext" value="MICROTECH" disabled>
                    </div>

                    <label for="" class="col-form-label col-md-2"><strong> CEDULA/RIF:</strong></label>
                    <div class="col-md-4">
                        <input type="text" id="rif_cliente" class="form-control-plaintext" value="J-26540950" disabled>
                    </div>
                </div>

                <div class="row pl-5">
                    <label for="" class="col-form-label col-md-2"><strong>DIRECCION:</strong></label>
                    <div class="col-md-10">
                        <input type="text" id="direccion_cliente" class="form-control-plaintext" value="BARQUISIMETO" disabled>
                    </div>

                    
                </div>

                <hr>

                <div class="row justify-content-center">
                    <h4>PRODUCTOS</h4>
                </div>

                <div class="row">
                    <div class=" table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>CANTIDAD</th>
                                    <th>CODIGO</th>
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
                <hr>
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
                    <label for="" class="col-form-label col-md-2"><strong>TOTAL:</strong> </label>
                    <div class="col-md-10">
                        <input type="text" class="form-control-plaintext" id="total" disabled>
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


<script src="<?= ROOT; ?>public/assets/js/venta/index.js"></script>

