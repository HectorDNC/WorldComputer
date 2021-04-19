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
                        <form id="formularioRecuperarContrasena">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" name="user" class="form-control" placeholder="Usuario" value="<?= $usuario->usuario; ?>" readonly required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" placeholder="Nueva Contraseña" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-key"></i></span>
                                </div>
                                <input type="password" name="password_confirm" class="form-control" placeholder="Confirmar contraseña" required>
                            </div>

                            <div class="form-check mb-3">
                               
                            </div>
                            <input type="hidden" name="token-r" id="token-r">
                            <input type="hidden" name="usuario_id" id="usuario_id" value="<?= $usuario->id; ?>">
                            <div class="row">
                                <div class="col pr-2">
                                    <button type="submit" class="btn btn-block btn-primary">Recuperar Contraseña</button>
                                </div>
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

            var baseURL = "<?= URL; ?>"
    </script>

    <script src="<?= ROOT; ?>vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ROOT; ?>public/assets/js/config.js"></script>
    <script src="<?= ROOT; ?>public/assets/js/bootadmin.min.js"></script>
    <script src="<?= ROOT; ?>public/assets/js/login/recuperarContrasena.js"></script>
</body>

</html>