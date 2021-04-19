<div class="content p-4 d-flex justify-content-center align-items-center flex-column">
    <div class="card w-100 text-center" style="max-width: 65%;">
            <div class="card-header">
                <h2>Reporte de Productos</h2>
            </div>
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/reporteProducto" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <div class="row form-group">
                        <label for="categoria" class="col-form-label col-md-4 font-weight-bold">Categoria: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2" name="categoria" id="categoria" required>
                                <option value="TODOS">TODOS</option>
                                
                                <?php foreach($categorias as $categoria):?>
                                    <option value="<?=$categoria->nombre?>"><?=$categoria->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="producto" class="col-form-label col-md-4 font-weight-bold">Producto: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2" name="producto" id="producto" required>
                                <option value="TODOS">TODOS</option>
                                <?php foreach($productos as $producto):?>
                                    <option value="<?=$producto->nombre?>"><?=$producto->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
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