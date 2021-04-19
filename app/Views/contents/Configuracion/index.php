<div class="content p-4 row  d-flex justify-content-center">
    

   <div class="col-md-8">
    <div class="card mb-4 ">
   
            <div class="card-header d-flex justify-content-center">
                <h2 class="mb-4">Configuración</h2>
            </div>        
            <form action="" method="post" id="formConfiguracion">
                <!-- <div class="card-body row">
                    <div class="col-md-5">
                        <label for="nombre_sistema" class=""> <i class="fa fa-ad"></i> <strong>Nombre del Sistema</strong></label> &nbsp; 
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="nombre_sistema" name="nombre_sistema" value="<?=$nombre_sistema?>" required maxlength="30">
                    </div>
                </div>
                <hr>  -->
                <div class="card-body row">
                    <div class="col-md-5">
                        <label for="dolar" class=""> <i class="fa fa-dollar-sign"></i> <strong>Precio del Dolar</strong></label> &nbsp; 
                    </div>
                    <div class="col-md-7">
                        <input type="number" class="form-control" id="dolar" name="dolar" step="any" value="<?=$dolar?>" min="0" required>
                    </div>
                </div>
                <hr> 
                <div class="card-body row">
                    <div class="col-md-5">
                        <label for="iva" class=""> <i class="fa fa-percent"></i> <strong>Porcentaje de IVA</strong></label> &nbsp; 
                    </div>
                    <div class="col-md-7">
                        <input type="number" class="form-control" id="iva" name="iva" step="any" value="<?=$iva?>" min="0" max="100" maxlength=3 required>
                    </div>
                </div>            
                <div class="card-footer d-flex justify-content-center">
                        <button type="submit" id="guardar" class="btn btn-success m-auto">Guardar</button>
                </div>
            </form>
        </div>
   </div>
</div>


<script src="<?= ROOT; ?>public/assets/js/configuracion/index.js"></script>

