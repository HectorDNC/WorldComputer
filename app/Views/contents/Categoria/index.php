<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Categoría</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroCategoria"
          <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Categorias") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
          >
            <i class="fas fa-plus-square"></i> Agregar Categoría
          </button>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Categoría</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estatus</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table>
        </div>
    </div>
</div>

<!-- Modal Registro -->
<div class="modal fade" id="modalRegistroCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Nueva Categoría</h2>
            <hr>
          
                <form action="#" method="POST" id="formularioRegistrarCategoria" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="nombre"> <i class="fas fa-tag"></i> Nombre Categoria</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" onkeyup = "this.value=this.value.toUpperCase()" maxlength="50" placeholder="ej. cajas">
                    </div>
                    
                    <div class="form-group">
                        <label for="descripcion"> <i class="fas fa-id-card-alt"></i> Descripcion</label>
                        <textarea name="descripcion" onkeyup = "this.value=this.value.toUpperCase()" id="descripcion" class="form-control" cols="30" rows="3" placeholder="descripcion de la categoria..." maxlength="200"></textarea>
                    </div>


                    <div class="form-row justify-content-center align-items-center">
                        <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                        <button class="btn btn-success" type="submit">Enviar</button>
                    </div>
                    
                </form>   
        </div>


    </div>

        </div>
    </div>
</div>

<!-- Modal Mostrar -->
<div class="modal fade" id="modalMostrarCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Categoría</h2>
            <hr>
            <form action="#" method="POST" id="formularioMostrarCategoria" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="nombre"> <i class="fas fa-tag"></i> <strong>Nombre Categoria</strong></label>
                    <input type="text" name="nombre" id="nombre" class="form-control-plaintext" disabled onkeyup = "this.value=this.value.toUpperCase()" placeholder="ej. cajas">
                </div>
                
                <div class="form-group">
                    <label for="descripcion"> <i class="fas fa-id-card-alt"></i> <strong>Descripcion</strong></label>
                    <textarea name="descripcion" onkeyup = "this.value=this.value.toUpperCase()" id="descripcion" class="form-control-plaintext" disabled cols="30" rows="3" placeholder="descripcion de la categoria..."></textarea>
                </div>


                <div class="form-row justify-content-center">
                    <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                </div>
                
            </form>
        </div>


    </div>

        </div>
    </div>
</div>

<!-- Modal Actualizar -->
<div class="modal fade" id="modalActualizarCategoria" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Actualizar Categoría</h2>
            <hr>
          
            <form action="#" method="POST" id="formularioActualizarCategoria" enctype="multipart/form-data">
                <input type="text" name="id" id="id" hidden>
                <div class="form-group">
                    <label for="nombre"> <i class="fas fa-tag"></i> Nombre Categoria</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" onkeyup = "this.value=this.value.toUpperCase()" placeholder="ej. cajas">
                </div>
                
                <div class="form-group">
                    <label for="descripcion"> <i class="fas fa-id-card-alt"></i> Descripcion</label>
                    <textarea name="descripcion" onkeyup = "this.value=this.value.toUpperCase()" id="descripcion" class="form-control" cols="30" rows="3" placeholder="descripcion de la categoria..."></textarea>
                </div>


                <div class="form-row justify-content-center align-items-center">
                    <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                    <button class="btn btn-success" type="submit">Enviar</button>
                </div>
                
            </form>   
        </div>


    </div>

        </div>
    </div>
</div>


<script src="<?= ROOT; ?>public/assets/js/categoria/index.js"></script>

