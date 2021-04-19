<div class="container d-flex align-items-center justify-content-center">
	<div class="card w-75 mb-5">
		<div class="card-header text-center">
			<h2>Respaldar/Restaurar la Base de Datos</h2>
		</div>
		<div class="card-body">
			<div class="row text-center">
				
				<div class="col-md border-right py-1 btn btn-light " id="respaldar">					
					<span class="fa-stack fa-4x mb-4">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fa fa-file-archive fa-stack-1x fa-inverse"></i>
					</span>
					<h3>Respaldar</h3>
					<p>Crear un archivo de respaldo para la Base de Datos</p>					
				</div>
				<div class="col-md border-left py-1 btn btn-light " id="restaurar">					
					<span class="fa-stack fa-4x mb-4">
						<i class="fas fa-circle fa-stack-2x text-primary"></i>
						<i class="fa fa-history fa-stack-1x fa-inverse"></i>
					</span>
					<h3>Restaurar</h3>
					<p>Restaurar la Base de Datos a un punto anterior</p>					
				</div>
				
			</div>
		</div>
	</div>
	
</div>

<div class="modal fade" id="modalRestaurar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex">
        <div class="modal-content">

			<div class="card">
			<div class="card-body swal2-content text-black">
				<h2 class="card-tittle text-center">Restaurar</h2>
				<hr>
				<form action="respaldo/restaurar" method="POST" target="_blank" id="formularioRestaurar">
					<div class="row justify-content-center">
						<label for="respaldo" class="col-form-label"><strong>Escoja un archivo</strong></label>
					</div>
					<div class="form-row justify-content-center m-2">
						
						<select name="respaldo" class="form-control col-md-10" required>
							<option value="" disabled="" selected="">--Seleccionar--</option>
							<?php
								$ruta="public/assets/respaldo/";
								if(is_dir($ruta)){
									if($aux=opendir($ruta)){
										while(($archivo = readdir($aux)) !== false){
											if($archivo!="."&&$archivo!=".."){
												$nombrearchivo=str_replace(".sql", "", $archivo);
												$nombrearchivo=str_replace("-", ":", $nombrearchivo);
												$ruta_completa=$ruta.$archivo;
												if(is_dir($ruta_completa)){
												}else{
													echo '<option value="'.$ruta_completa.'">'.$nombrearchivo.'</option>';
												}
											}
										}
										closedir($aux);
									}
								}else{
									echo $ruta." No es ruta válida";
								}
							?>
						</select>
					</div>
					<div class="row">
							<span class="text-center m-2">Nota: Al restaurar la Base de Datos perderá todos los cambios realizados después de la fecha del respaldo</span>
							
					</div>
					
					<br>
					<div class="form-row justify-content-center m-2">
						<button type="submit" class="btn btn-warning  swal2-confirm swal2-styled"><i class="fa fa-history"></i> Restaurar</button>
					</div>
				</form>
			</div>


			</div>

        </div>
    </div>
</div>


<script src="<?= ROOT; ?>public/assets/js/respaldo/index.js"></script>