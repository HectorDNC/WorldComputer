<div class="content p-4 d-flex justify-content-center align-items-center flex-column">
    <div class="card w-100 text-center mb-4" style="max-width: 65%;">
            <div class="card-header">
                <h2>Reporte de Servicios</h2>
            </div>
            <div class="card-body">
                <form action="<?=ROOT;?>Reporte/estadisticasServicios" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                    <div class="row form-group">
                        <label for="tecnico" class="col-form-label col-md-4 font-weight-bold">Técnico: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2" name="tecnico" id="tecnico" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($tecnicos as $tecnico):?>
                                    <option value="<?=$tecnico->id?>"><?=$tecnico->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="cliente" class="col-form-label col-md-4 font-weight-bold">Cliente: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2" name="cliente" id="cliente" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($clientes as $cliente):?>
                                    <option value="<?=$cliente->id?>"><?=$cliente->nombre?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row form-group">
                        <label for="servicio" class="col-form-label col-md-4 font-weight-bold">Servicio: </label>
                        <div class="col-md-8 d-flex align-items-center px-1">
                            <select class="form-control select2" name="servicio" id="servicio" required>
                                <option value="0">TODOS</option>
                                
                                <?php foreach($servicios as $servicio):?>
                                    <option value="<?=$servicio->id?>"><?=$servicio->nombre?></option>
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