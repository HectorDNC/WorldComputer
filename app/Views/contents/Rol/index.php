<div class="content p-4 dataTables_wrapper">
    <h2 class="mb-4">Gestión de Rol</h2>

    <div class="card mb-4">
        <div class="card-header bg-white">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRegistroRol"
          <?php $band = false;
                foreach ($_SESSION['permisos'] as $p):
                    if ($p->permiso == "Registrar Roles") {     
                        $band = true;
                }endforeach;     
                if (!$band) {
                    echo "disabled";
                }           
            ?>
          >
            <i class="fas fa-plus-square"></i> Agregar Rol
          </button>
        </div>
        <div class="card-body">
          <table class="table" id="datatable">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Rol</th>
                <th scope="col">Descripción</th>
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
    <div class="modal fade" id="modalRegistroRol" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header">
                            <h2 class="text-center">Nuevo Rol</h2>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="formularioRegistrarRol">

                            <div class="form-group">
                                <label for="nombre">Nombre del Rol</label>
                                <input type="text" name="nombre" class="form-control" pattern="[A-Za-z ]+" maxlength="40" required title="Ingrese un nombre. Solo letras">
                            </div>

                            <div class="form-group">
                                <label for="nombre">Descripcion del Rol</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control" maxlength="45"></textarea>
                            </div>

                            <h4 class="text-center">Listado de Permisos</h4>
                            <hr>

                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck1" value="1">
                                            <label class="custom-control-label" for="customCheck1"><strong>Usuarios</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck2" value="2">
                                            <label class="custom-control-label" for="customCheck2">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck3" value="3">
                                            <label class="custom-control-label" for="customCheck3">Editar</label>
                                        </div>
                                    </div>
            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck4" value="4">
                                            <label class="custom-control-label" for="customCheck4">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck5" value="5">
                                                    <label class="custom-control-label" for="customCheck5"><strong>Clientes</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck6" value="6">
                                                    <label class="custom-control-label" for="customCheck6">Registrar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck7" value="7">
                                                    <label class="custom-control-label" for="customCheck7">Editar</label>
                                                </div>
                                            </div>
                    
    
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck27" value="8">
                                                    <label class="custom-control-label" for="customCheck27">Eliminar</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                

                                
                            </div>

                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck8" value="9">
                                            <label class="custom-control-label" for="customCheck8"><strong>Empleados</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck9" value="10">
                                            <label class="custom-control-label" for="customCheck9">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck10" value="11">
                                            <label class="custom-control-label" for="customCheck10">Editar</label>
                                        </div>
                                    </div>
            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck11" value="12">
                                            <label class="custom-control-label" for="customCheck11">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck12" value="13">
                                                    <label class="custom-control-label" for="customCheck12"><strong>Proveedores</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck13" value="14">
                                                    <label class="custom-control-label" for="customCheck13">Registrar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck14" value="15">
                                                    <label class="custom-control-label" for="customCheck14">Editar</label>
                                                </div>
                                            </div>
                    
    
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck15" value="16">
                                                    <label class="custom-control-label" for="customCheck15">Eliminar</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                                <hr>
                                
                            </div>

                                    
                            <div class="form-row p-1">
                                <!-- <div class="col-md-4">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck121" value="17">
                                                    <label class="custom-control-label" for="customCheck121"><strong>Inventario</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                        </div>
                                    </div>

                                </div> -->
                                <div class="col-md-6">
                                    <hr class="bg-secondary">                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck22" value="18">
                                            <label class="custom-control-label" for="customCheck22"><strong>Productos</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck23" value="19">
                                            <label class="custom-control-label" for="customCheck23">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck24" value="20">
                                            <label class="custom-control-label" for="customCheck24">Editar</label>
                                        </div>
                                    </div>
            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck25" value="21">
                                            <label class="custom-control-label" for="customCheck25">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck262" value="22">
                                                    <label class="custom-control-label" for="customCheck262"><strong>Categorias (Productos)</strong></label>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck263" value="23">
                                                    <label class="custom-control-label" for="customCheck263">Registrar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck264" value="24">
                                                    <label class="custom-control-label" for="customCheck264">Editar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck265" value="25">
                                                    <label class="custom-control-label" for="customCheck265">Eliminar</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                

                                
                            </div>
                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck81" value="26">
                                            <label class="custom-control-label" for="customCheck81"><strong>Servicios</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck91" value="27">
                                            <label class="custom-control-label" for="customCheck91">Registrar</label>
                                        </div>
                                    </div>            
                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck910" value="28">
                                            <label class="custom-control-label" for="customCheck910">Editar</label>
                                        </div>
                                    </div>            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck101" value="29">
                                            <label class="custom-control-label" for="customCheck101">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck081" value="30">
                                            <label class="custom-control-label" for="customCheck081"><strong>Servicios Prestados</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck091" value="31">
                                            <label class="custom-control-label" for="customCheck091">Registrar</label>
                                        </div>
                                    </div>

            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck0101" value="32">
                                            <label class="custom-control-label" for="customCheck0101">Anular</label>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </div>

                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">                            
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck16" value="33">
                                            <label class="custom-control-label" for="customCheck16"><strong>Compras</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck17" value="34">
                                            <label class="custom-control-label" for="customCheck17">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck18" value="35"> 
                                            <label class="custom-control-label" for="customCheck18">Anular</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck19" value="36">
                                                    <label class="custom-control-label" for="customCheck19"><strong>Ventas</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck20" value="37">
                                                    <label class="custom-control-label" for="customCheck20">Registrar</label>
                                                </div>
                                            </div>                    
    
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck21" value="38">
                                                    <label class="custom-control-label" for="customCheck21">Anular</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                

                                
                            </div>

                            <div class="form-row p-1">
                                <div class="col-md-6">
                                    <hr class="bg-secondary">                               
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck161" value="39">
                                            <label class="custom-control-label" for="customCheck161"><strong>Roles</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck171" value="40">
                                            <label class="custom-control-label" for="customCheck171">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck181" value="41"> 
                                            <label class="custom-control-label" for="customCheck181">Editar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck1811" value="42"> 
                                            <label class="custom-control-label" for="customCheck1811">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheck16123" value="43">
                                                    <label class="custom-control-label" for="customCheck16123"><strong>Reportes</strong></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>  
                                
                            </div>

                            <hr>

                            <div class="row form-group justify-content-md-center">
                                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                                <button type="submit"  class="btn btn-success m-2">Enviar</button>
                                <button type="reset" class="btn btn-danger m-2">Limpiar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal mostrar -->
    <div class="modal fade" id="modalMostrarRol" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header">
                            <h2 class="text-center">Rol</h2>
                    </div>
                    <div class="card-body">
                        <form id="formularioMostrarRol">
                            <div class="form-group">
                                <label for="nombre"><strong>Nombre del Rol</strong></label>
                                <input type="text" name="nombre" id="nombre" class="form-control-plaintext" pattern="[A-Za-z ]+" maxlength="40" required title="Ingrese un nombre. Solo letras" disabled>
                            </div>

                            <div class="form-group">
                                <label for="descripcion"><strong>Descripcion del Rol</strong></label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control-plaintext" maxlength="45" disabled></textarea>
                            </div>
                            <div class="form-group">
                                <label for="permisos"><strong>Listado de Permisos</strong></label>
                                <ul id="listaPermisos" class="m-2 p-2">
                                </ul>
                            </div>

                            <hr class="bg-secondary">
                            
                            <div class="row form-group justify-content-md-center">
                                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal actualizar -->
    <div class="modal fade" id="modalActualizarRol" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="card">
                    <div class="card-header">
                            <h2 class="text-center">Actualizar Rol</h2>
                    </div>
                    <div class="card-body">
                        <form action="#" method="POST" enctype="multipart/form-data" id="formularioActualizarRol">
                            <input type="hidden" id="id" name="id">
                            <div class="form-group">
                                <label for="nombre">Nombre del Rol</label>
                                <input type="text" id="nombre" name="nombre" class="form-control" pattern="[A-Za-z ]+" maxlength="40" required title="Ingrese un nombre. Solo letras">
                            </div>

                            <div class="form-group">
                                <label for="nombre">Descripcion del Rol</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="2" class="form-control" maxlength="45"></textarea>
                            </div>

                            <h4 class="text-center">Listado de Permisos</h4>
                            <hr>

                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU1" value="1">
                                            <label class="custom-control-label" for="customCheckU1"><strong>Usuarios</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU2" value="2">
                                            <label class="custom-control-label" for="customCheckU2">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU3" value="3">
                                            <label class="custom-control-label" for="customCheckU3">Editar</label>
                                        </div>
                                    </div>
            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU4" value="4">
                                            <label class="custom-control-label" for="customCheckU4">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU5" value="5">
                                                    <label class="custom-control-label" for="customCheckU5"><strong>Clientes</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU6" value="6">
                                                    <label class="custom-control-label" for="customCheckU6">Registrar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU7" value="7">
                                                    <label class="custom-control-label" for="customCheckU7">Editar</label>
                                                </div>
                                            </div>
                    
    
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU27" value="8">
                                                    <label class="custom-control-label" for="customCheckU27">Eliminar</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                

                                
                            </div>

                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU8" value="9">
                                            <label class="custom-control-label" for="customCheckU8"><strong>Empleados</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU9" value="10">
                                            <label class="custom-control-label" for="customCheckU9">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU10" value="11">
                                            <label class="custom-control-label" for="customCheckU10">Editar</label>
                                        </div>
                                    </div>
            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU11" value="12">
                                            <label class="custom-control-label" for="customCheckU11">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU12" value="13">
                                                    <label class="custom-control-label" for="customCheckU12"><strong>Proveedores</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU13" value="14">
                                                    <label class="custom-control-label" for="customCheckU13">Registrar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU14" value="15">
                                                    <label class="custom-control-label" for="customCheckU14">Editar</label>
                                                </div>
                                            </div>
                    
    
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU15" value="16">
                                                    <label class="custom-control-label" for="customCheckU15">Eliminar</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>

                                <hr>
                                
                            </div>

                                    
                            <div class="form-row p-1">
                                <!-- <div class="col-md-4">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU121" value="17">
                                                    <label class="custom-control-label" for="customCheckU121"><strong>Inventario</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                        </div>
                                    </div>

                                </div> -->
                                <div class="col-md-6">
                                    <hr class="bg-secondary">                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU22" value="18">
                                            <label class="custom-control-label" for="customCheckU22"><strong>Productos</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU23" value="19">
                                            <label class="custom-control-label" for="customCheckU23">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU24" value="20">
                                            <label class="custom-control-label" for="customCheckU24">Editar</label>
                                        </div>
                                    </div>
            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU25" value="21">
                                            <label class="custom-control-label" for="customCheckU25">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU262" value="22">
                                                    <label class="custom-control-label" for="customCheckU262"><strong>Categorias (Productos)</strong></label>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU263" value="23">
                                                    <label class="custom-control-label" for="customCheckU263">Registrar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU264" value="24">
                                                    <label class="custom-control-label" for="customCheckU264">Editar</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU265" value="25">
                                                    <label class="custom-control-label" for="customCheckU265">Eliminar</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                

                                
                            </div>
                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU81" value="26">
                                            <label class="custom-control-label" for="customCheckU81"><strong>Servicios</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU91" value="27">
                                            <label class="custom-control-label" for="customCheckU91">Registrar</label>
                                        </div>
                                    </div>            
                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU910" value="28">
                                            <label class="custom-control-label" for="customCheckU910">Editar</label>
                                        </div>
                                    </div>            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU101" value="29">
                                            <label class="custom-control-label" for="customCheckU101">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU081" value="30">
                                            <label class="custom-control-label" for="customCheckU081"><strong>Servicios Prestados</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU091" value="31">
                                            <label class="custom-control-label" for="customCheckU091">Registrar</label>
                                        </div>
                                    </div>

            

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU0101" value="32">
                                            <label class="custom-control-label" for="customCheckU0101">Anular</label>
                                        </div>
                                    </div>

                                </div>
                                
                                
                            </div>

                            <div class="form-row p-1">

                                <div class="col-md-6">
                                    <hr class="bg-secondary">                            
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU16" value="33">
                                            <label class="custom-control-label" for="customCheckU16"><strong>Compras</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU17" value="34">
                                            <label class="custom-control-label" for="customCheckU17">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU18" value="35"> 
                                            <label class="custom-control-label" for="customCheckU18">Anular</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU19" value="36">
                                                    <label class="custom-control-label" for="customCheckU19"><strong>Ventas</strong></label>
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU20" value="37">
                                                    <label class="custom-control-label" for="customCheckU20">Registrar</label>
                                                </div>
                                            </div>                    
    
                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU21" value="38">
                                                    <label class="custom-control-label" for="customCheckU21">Anular</label>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                

                                
                            </div>

                            <div class="form-row p-1">
                                <div class="col-md-6">
                                    <hr class="bg-secondary">                               
                                
                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU161" value="39">
                                            <label class="custom-control-label" for="customCheckU161"><strong>Roles</strong></label>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU171" value="40">
                                            <label class="custom-control-label" for="customCheckU171">Registrar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU181" value="41"> 
                                            <label class="custom-control-label" for="customCheckU181">Editar</label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="custom-control custom-checkbox pr-3">
                                            <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU1811" value="42"> 
                                            <label class="custom-control-label" for="customCheckU1811">Eliminar</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <hr class="bg-secondary">
                                    <div class="row">
                                        <div class="col-md">

                                            <div class="row">
                                                <div class="custom-control custom-checkbox pr-3">
                                                    <input type="checkbox" name="permisos[]" class="custom-control-input" id="customCheckU16123" value="43">
                                                    <label class="custom-control-label" for="customCheckU16123"><strong>Reportes</strong></label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>  
                                
                            </div>

                            <hr>

                            <hr class="bg-secondary">

                            <div class="row form-group justify-content-md-center">
                                <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a>
                                <button type="submit"  class="btn btn-success m-2">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script src="<?= ROOT; ?>public/assets/js/rol/index.js"></script>


