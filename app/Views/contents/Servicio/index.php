<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Servicio</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroServicio"
          <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Servicios") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
          >
            <i class="fas fa-plus-circle"></i> Agregar Servicio
          </button>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Código</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio $</th>
                <th scope="col">Precio BSS</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
        </div>
    </div>
</div>


<!-- Modal de Registro -->
<div class="modal fade " id="modalRegistroServicio" tabindex="-1" role="dialog" aria-labelledby="modalRegistroServicioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h2 class="">Nuevo Servicio</h2>
        <hr>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioRegistrarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="45" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio"  required="required" class="form-control" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del servicio" rows="3" maxlength="45"></textarea>
            </div>
            
            <div class="modal-footer d-flex justify-content-center">
            <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
              <button type="submit"  class="btn btn-success m-2">Enviar</button>
              <button type="reset" class="btn btn-danger m-2">Limpiar</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal de mostrar -->
<div class="modal fade " id="modalMostrarServicio" tabindex="-1" role="dialog" aria-labelledby="mostrarServicioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h2 class="card-tittle text-center">Servicio</h2>
        <hr>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioMostrarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="nombre"><strong>Nombre:</strong></label>
                    <input disabled type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="45" required="required" class="form-control-plaintext" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="precio"><strong>Precio:</strong></label>
                    <input disabled type="number" name="precio" id="precio" maxlength="200" required="required" class="form-control-plaintext" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion"><strong>Descripción:</strong></label>
                <textarea disabled class="form-control-plaintext" id="descripcion" name="descripcion" placeholder="Descripción del servicio" rows="3"></textarea>
            </div>
            
            <div class="form-row justify-content-center">
                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>



<!-- Modal de Actualizar -->
<div class="modal fade " id="modalActualizarServicio" tabindex="-1" role="dialog" aria-labelledby="actualizarServicioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h2 class="card-tittle text-center">Actualizar Servicio</h2>
        <hr>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioActualizarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="nombre"><strong>Nombre:</strong></label>
                    <input type="text" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="50" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="precio"><strong>Precio:</strong></label>
                    <input type="number" name="precio" id="precio" maxlength="30" required="required" class="form-control" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion"><strong>Descripción:</strong></label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del servicio" rows="3" maxlength="45"></textarea>
            </div>
            
            <div class="modal-footer d-flex justify-content-center">
              <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
              <button type="submit"  class="btn btn-success m-2">Enviar</button>
              <button type="reset" class="btn btn-danger m-2">Limpiar</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script src="<?= ROOT; ?>public/assets/js/servicio/index.js"></script>
