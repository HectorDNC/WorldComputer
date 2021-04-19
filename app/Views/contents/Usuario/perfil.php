<div class="content p-42">

    
    <div class="card">
        <div class="card-header">
                <h2 class="text-center">Actualizar Usuario</h2>
        </div>
        <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data" id="formularioActualizarUsuario">

                <div class="form-row justify-content-center">
                    <h4 class="text-center">Datos Personales</h4>
                </div>

                <hr>

                <div class="row form-group">
                    <input  name="perfil" id="perfil" value="1" hidden>
                    <input  name="id" id="id" value="<?=$usuario->id?>" hidden>
                    <label for="nombre" class="col-form-label col-md-2">Nombre:</label>
                    <div class="col-md-4 ">
                        <input type="text" value="<?=$usuario->nombre?>" name="nombre" id="nombre" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required" class="form-control" placeholder="Nombre">
                    </div> 

                    <label for="apellido" class="col-form-label col-md-2">Apellido:</label>
                    <div class="col-md-4 ">
                        <input type="text" value="<?=$usuario->apellido?>" name="apellido" id="apellido" pattern="[A-Za-z ]+" title="Ingrese solo letras" maxlength="30" required="required"  class="form-control" placeholder="Apellido">
                    </div>
                </div>

                <div class="row form-group">
                    <label for="cedula_cliente" class="col-form-label col-md-2">Cedula/RIF:</label>
                    <div class="col-md-1 ">
                        <input type="hidden" id="inicial_documentoH" value="<?=$inicial_documento?>">
                        <select class="form-control pl-0 pr-0"  name="inicial_documento" id="inicial_documento" required="">
                            <option value="" selected="">-</option>
                            <option value="V">V</option>
                            <option value="E">E</option>
                            <option value="J">J</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                    <script>
                        $(document).ready(function(){
                            $("#inicial_documento").val($("#inicial_documentoH").val());
                            $("#rolUsuario").val($("#rolH").val());
                        });
                            
                    </script>
                    <div class="col-md-3">
                        <input type="text" value="<?=$documento?>" pattern="[0-9]{6,8}" name="documento" id="documento" minlength="6" maxlength="8" title="Ingrese entre 6 y 8 digitos" class="form-control" placeholder="Identificaion" required="">
                    </div>
                    <label for="telefono" class="col-form-label col-md-2" >Telefono:</label>
                    <div class="col-md-4 ">
                        <input type="tel" value="<?=$usuario->telefono?>" name="telefono" id="telefono" title="Debe Contener minimo 11 Caracteres numericos" minlength="10"  maxlength="12" pattern="[0-9-]+" required class="form-control" placeholder="Telefono">
                    </div>
                </div>
                <div class="row form-group">
                    <label for="correo" class="col-form-label col-md-2">Correo:</label>
                    <div class="col-md-4 ">
                        <input type="email" value="<?=$usuario->email?>" name="correo" id="correo" required class="form-control" placeholder="Correo Electronico">
                    </div>

                    <label for="direccion" class="col-form-label col-md-2">Direccion:</label>
                    <div class="col-md-4">
                        <input type="text" value="<?=$usuario->direccion?>" name="direccion" id="direccion" pattern="[A-Za-z0-9/ ]+" required maxlength="150" class="form-control" placeholder="Direccion" >
                    </div>
                </div>

                <hr class="bg-secondary">

                <div class="form-row justify-content-center">
                    <h4 class="text-center">Usuario</h4>
                </div>

                <hr>

                <div class="form-group">
                    <label for="user">Nombre de Usuario</label>
                    <input  value="<?=$usuario->usuario?>" id="usuario" name="usuario" type="text" class="form-control" required minlength="8" maxlength="20">
                </div>

                <div class="form-row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="pass">Password</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" minlength="8" maxlength="20">
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="pass">Confirmar Password</label>
                            <input type="password" class="form-control" name="confirmarContrasena" id="confirmarContrasena" minlength="8" maxlength="20">
                        </div>
                    </div>
                </div>

                <hr class="bg-secondary">
                <?php if($_SESSION['rol']==1){?>

                <div class="form-row justify-content-center">
                    <h4 class="text-center">Rol de Usuario</h4>
                </div>

                
                <div class="form-row">
                    <small class=" form-text">**Por favor seleccione un rol de usuario</small>
                </div>
                <hr>

                <div class="form-row" id="listadoRoles">

                    <input type="hidden" value="<?=$usuario->rol_id?>" id="rolH">
                    <select class="form-control w-50" name="rolUsuario" id="rolUsuario">
                    <?php foreach($roles AS $rol): ?>
                        <option value="<?=$rol->id?>"><?=$rol->nombre?></option>
                        
                    <?php endforeach; ?>
                    </select>
                </div>
                <?php }else{?>
                    <input id="rolUsuarioN" name="rolUsuarioN" value="<?=$usuario->rol_id?>" hidden>
                <?php }?>
                <hr>

                <div class="row form-group justify-content-md-center">
                    <!-- <a href="#" class="btn btn-secondary m-2" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Cerrar</a> -->
                    <button type="submit"  class="btn btn-success m-2">Enviar</button>
                    <!-- <button type="reset" class="btn btn-danger m-2">Limpiar</button> -->
                </div>
            </form>
        </div>
    </div>
   
</div>
<script src="<?= ROOT; ?>public/assets/js/usuario/perfil.js"></script>