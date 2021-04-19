<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Resumen de Inventario</h2>

    <div class="card mb-4">
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Precio Venta</th>
                <th>Stock</th>
                <th>Stock Min</th>
                <th>Stock Max</th>
                <!-- <th>Detalles</th>  -->
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal Mostrar -->
<div class="modal fade" id="modalMostrarProducto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Producto</h2>
            <hr>
          
                <form action="#" method="POST" id="formularioMostrarProducto" enctype="multipart/form-data">
    
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-barcode"></i> <label for="codigo"><strong>Codigo Producto</strong></label>
                            <input type="text" name="codigo" id="codigo" class=" form-control-plaintext" disabled placeholder="Codigo" required disabled >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-tag"></i> <label for="categoria"><strong>Categoria</strong></label>
                            <input type="text" name="categoria" id="categoria" class=" form-control-plaintext" disabled placeholder="Codigo" required disabled >
                            
                        </div>

                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <i class="fas fa-box"></i> <label for="nombre"><strong>Nombre</strong></label>
                            <input name="nombre" id="nombre" type="text" class=" form-control-plaintext" disabled placeholder="Nombre" required >
                        </div>

                        <div class="form-group col-md-6">
                            <i class="fas fa-hockey-puck"></i> <label for="unidad"><strong>Unidad de Medida</strong></label>
                            <input type="text" name="unidad" id="unidad" class=" form-control-plaintext" disabled placeholder="Codigo" required disabled >
                            
                        </div>
                    </div>

                    <div class="form-group">

                        <!-- <label> <i class="fas fa-tag"></i> <strong>Precio</strong> </label>
                        <input type="number" name="precio" id="precio" class="form-control-plaintext" disabled required > -->

                        <label> <i class="fas fa-tag"></i> <strong>Margen de Ganancia</strong> </label>
                        <input type="number" name="porcentaje" id="porcentaje" class="form-control-plaintext" placeholder="Ej. 30%" max="100" required disabled>
                        <small class=" form-text text-muted">Este porcentaje calculara la ganancia respecto al ultimo precio de compra del producto</small>
                        
                    </div>


                    <div class="form-group">
                        <i class="fas fa-clipboard"></i> <label for="descripcion"><strong>Descripcion</strong></label>
                        <textarea name="descripcion" id="descripcion" class="form-control-plaintext" disabled placeholder="Ej. Producto original..." ></textarea>
                    </div>

           
                    
                    <hr>

                    <h4 class="text-center">Datos de Inventario</h4>
                    
                    <hr class="bg-info">


                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <i class="fas fa-angle-double-down"></i> <label for="stock_min"><strong>Stock Minimo</strong></label>
                            <input class="form-control-plaintext" disabled type="number" name="stock_min" id="stock_min" placeholder="Ej. 5" required >
                        </div>

                        <div class="form-group col-md-4">
                            <i class="fas fa-angle-double-up"></i> <label for="stock_max"><strong>Stock Maximo</strong></label>
                            <input class="form-control-plaintext" disabled type="number" name="stock_max" id="stock_max" placeholder="E j. 10" required >
                        </div>

                        <div class="form-group col-md-4">
                            <i class="fas fa-angle-double-up"></i> <label for="stock"><strong>Stock</strong></label>
                            <input class="form-control-plaintext" disabled type="number" name="stock" id="stock" placeholder="E j. 10" required >
                        </div>
                    </div>

                    <hr>

                    <div class="form-row justify-content-center">
                        <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                        
                    </div>
                </form>      
        </div>


    </div>

        </div>
    </div>
</div>


<script src="<?= ROOT; ?>public/assets/js/inventario/index.js"></script>

