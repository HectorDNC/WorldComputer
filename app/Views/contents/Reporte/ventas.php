<div class="content p-4 d-flex justify-content-center align-items-center flex-column">
    
    <div class="card w-100 text-center mb-4" style="max-width: 65%;">
            <div class="card-header">
                <h2>Reporte de Ventas</h2>
            </div>
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/estadisticasVentas" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <div class="row form-group">
                        <label for="vendedor" class="col-form-label col-md-4 font-weight-bold">Vendedor: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2 w-100" name="vendedor" id="vendedor" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($usuarios as $usuario):?>
                                    <option value="<?=$usuario->id?>"><?=$usuario->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="cliente" class="col-form-label col-md-4 font-weight-bold">Cliente: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2 w-100" name="cliente" id="cliente" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($clientes as $cliente):?>
                                    <option value="<?=$cliente->id?>"><?=$cliente->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="producto" class="col-form-label col-md-4 font-weight-bold">Producto: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2 w-100" name="producto" id="producto" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($productos as $producto):?>
                                    <option value="<?=$producto->id?>"><?=$producto->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="desde" class="col-form-label col-md-4 font-weight-bold">Desde: </label>
                        <input type="date" class="form-control col-md-6" name="desde" id="desde" required>
                        
                    </div>
                    <div class="row form-group">
                        <label for="hasta" class="col-form-label col-md-4 font-weight-bold">Hasta: </label>
                        <input type="date" class="form-control col-md-6" name="hasta" id="hasta" required>
                    </div>
                    <hr>
                    <div class="row justify-content-center">
                        <button type="submit" class="btn btn-success"> <i class="fa fa-fw fa-list-alt"></i> Generar Reporte</button>
                    </div>
                </form>
            </div>
    </div>
</div>
<!-- Buscador en los selects -->
<link href="<?= ROOT; ?>vendor/select2/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="<?= ROOT; ?>vendor/select2/select2/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    $('.select2').select2();
});
</script>