<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>W&C</title>

    <!-- FONTAWESOME -->
    <link href="<?= ROOT; ?>vendor/fortawesome/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- JQUERY -->
    <script src="<?= ROOT; ?>node_modules/jquery/dist/jquery.js"></script>
    
    <!-- SWEETALERT -->
    <link rel="stylesheet" href="<?= ROOT; ?>node_modules/sweetalert2/dist/sweetalert2.css">
    <script src="<?= ROOT; ?>node_modules/sweetalert2/dist/sweetalert2.js"></script>

    <!-- BOOTSTRAP -->
    <link href="<?= ROOT; ?>vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- BOOTADMIN -->
    <link href="<?= ROOT; ?>public/assets/css/bootadmin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">

    <link href="<?= ROOT; ?>public/assets/css/notifications.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css">
    
    
</head>

<body>
<?php
    if(isset($alerta)){
        echo $alerta;
    }
?>
<div class="container-fluid login h-100">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-md-4">
                <h1 class="text-center mb-4">World & Computer</h1>
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

                            <div class="row">
                                <div class="col pr-2">
                                    <button type="submit" class="btn btn-block btn-primary">Iniciar sesión</button>
                                </div>
                                <!-- <div class="col pl-2">
                                    <a class="btn btn-block btn-link" href="#">Recuperar Contraseña</a>
                                </div> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>


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