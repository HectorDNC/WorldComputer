<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestion de Servicio</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarServicio">
            <i class="fas fa-plus-circle"></i> Agregar Servicio
          </button>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
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
<div class="modal fade " id="agregarServicio" tabindex="-1" role="dialog" aria-labelledby="agregarServicioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="agregarServicioLabel">Agregar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioRegistrarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="agregarNombre">Nombre:</label>
                    <input type="text" name="agregarNombre" id="agregarNombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="agregarPrecio">Precio:</label>
                    <input type="number" name="agregarPrecio" id="agregarPrecio" maxlength="30" required="required" class="form-control" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="agregarDescripcion">Descripción</label>
                <textarea class="form-control" id="agregarDescripcion" placeholder="Descripción del servicio" rows="3"></textarea>
            </div>
            
            <div class="modal-footer">
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
      <div class="modal-header">
        <h5 class="modal-title" id="mostrarServicioLabel">mostrar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioMostrarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="mostrarNombre">Nombre:</label>
                    <input disabled type="text" name="mostrarNombre" id="mostrarNombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="mostrarPrecio">Precio:</label>
                    <input disabled type="number" name="mostrarPrecio" id="mostrarPrecio" maxlength="30" required="required" class="form-control" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="mostrarDescripcion">Descripción</label>
                <textarea disabled class="form-control" id="mostrarDescripcion" placeholder="Descripción del servicio" rows="3"></textarea>
            </div>
            
            <div class="modal-footer">
              <button type="submit"  class="btn btn-success m-2">Enviar</button>
              <button type="reset" class="btn btn-danger m-2">Limpiar</button>
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
      <div class="modal-header">
        <h5 class="modal-title" id="actualizarServicioLabel">actualizar Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST" enctype="multipart/form-data" id="formularioActualizarServicio">
            <div class="row form-group">
                <div class="col-md-6">
                    <input  name="id" id="id" hidden>
                    <label for="actualizarNombre">Nombre:</label>
                    <input type="text" name="actualizarNombre" id="actualizarNombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6">
                    <label for="actualizarPrecio">Precio:</label>
                    <input type="number" name="actualizarPrecio" id="actualizarPrecio" maxlength="30" required="required" class="form-control" placeholder="Precio">
                </div>
            </div>

            <div class="form-group">
                <label for="actualizarDescripcion">Descripción</label>
                <textarea class="form-control" id="actualizarDescripcion" placeholder="Descripción del servicio" rows="3"></textarea>
            </div>
            
            <div class="modal-footer">
              <button type="submit"  class="btn btn-success m-2">Enviar</button>
              <button type="reset" class="btn btn-danger m-2">Limpiar</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<script src="<?= ROOT; ?>public/assets/js/servicio/index.js"></script>
