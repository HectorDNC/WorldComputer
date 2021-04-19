<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php 
        if(isset($_COOKIE['title'])){
            echo $_COOKIE['title'];
        }
        else{
            echo "World & Computer";
        }
    ?></title>

    <!-- FONTAWESOME -->
    <link href="<?= ROOT; ?>vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- JQUERY -->
    <script src="<?= ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
    
    <!-- SWEETALERT -->
    <link rel="stylesheet" href="<?= ROOT; ?>node_modules/sweetalert2/dist/sweetalert2.min.css">
    <script src="<?= ROOT; ?>node_modules/sweetalert2/dist/sweetalert2.js"></script>

    <!-- BOOTSTRAP -->
    <link href="<?= ROOT; ?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- BOOTADMIN -->
    <link href="<?= ROOT; ?>public/assets/css/bootadmin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <link href="<?= ROOT; ?>public/assets/css/notifications.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?= ROOT; ?>public/assets/img/w&cLogoFavicon.png" type="image/x-icon">
    
    
</head>

<body>

<div class="container-fluid login h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-4">
                <h1 class="text-center mb-4"><?php 
                    if(isset($_COOKIE['title'])){
                        echo $_COOKIE['title'];
                    }
                    else{
                        echo "World & Computer";
                    }
                ?></h1>
                <div class="card">
                    <div class="card-body">
                        <form id="loginForm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="user" class="form-control" placeholder="Usuario" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                            </div>

                            <div class="form-check mb-3">
                                <!-- <label class="form-check-label">
                                    <input type="checkbox" name="remember" class="form-check-input">
                                    Recuerdame
                                </label> -->
                            </div>
                            <input type="hidden" name="token-r" id="token-r">
                            <div class="row">
                                <div class="col pr-2">
                                    <button type="submit" class="btn btn-block btn-primary">Iniciar sesión</button>
                                </div>
                                <div class="col pl-2">
                                    <a class="btn btn-block btn-link" href="javascript:void(0);" id="recuperarContrasena">Recuperar Contraseña</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>

<div class="modal fade" id="modalRecuperarContrasena" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

        <div class="card">
        <div class="card-body">
            <h2 class="card-tittle text-center">Recuperar Contraseña</h2>
            <hr>
          
                <form action="#" method="POST" id="formularioRecuperarContrasena" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="email"> <i class="fas fa-envelope-square"></i> Ingrese su email</label>
                        <input type="text" name="email" id="email" class="form-control" maxlength="50" placeholder="...">
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

    <script src="https://www.google.com/recaptcha/api.js?render=<?=SITE_KEY?>"></script>

    <script>
         
            grecaptcha.ready(function() {
                grecaptcha.execute('<?php echo SITE_KEY;?>', {action: 'homepage'})
                .then(function(token) {
                    // Add your logic to submit to your backend server here.
                    console.log(token);
                    $('#token-r').val(token);
                });
            });
    </script>

    <script src="<?= ROOT; ?>vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT; ?>public/assets/js/config.js"></script>
    <script src="<?= ROOT; ?>public/assets/js/bootadmin.min.js"></script>
    <script src="<?= ROOT; ?>public/assets/js/login/validation.js"></script>
    
    
    
 
    <!-- Bootstrap core JavaScript -->
<!--     <script src="Assets/js/jquery/jquery-3.2.1.js"></script> -->
<!--     <script src="Assets/js/bootstrap/bootstrap.js"></script> -->
<!--     <script src="Assets/js/menu_lateral.js"></script> -->
<!--     <script src="Assets/js/validacion.js"></script> -->
<!-- 	<script src="Assets/js/select2.js"></script> -->
</body>

</html>