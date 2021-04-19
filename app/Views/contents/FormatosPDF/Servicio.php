<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>

    <style type="text/css">

        .container{
            padding: 0px 0px;
            color:#424242;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
        .centrado{
            margin: auto;
        }
        .margin{
            margin: 2px 0px;
        }
        .separador{
            display:block; 
            width:100%; 
            height:1px; 
            margin: 1px 0px;
            color: black; 
        }
        .separadorDos{
            display:block; 
            width:100%; 
            height:1px; 
            margin: 1px 0px;
            color: lightslategrey; 
        }

    </style>
</head>
<body>
    <div class="container centrado" style="width: 98%;">

        <table style="width:100%">
            <tbody>
                <tr>
                    <td colspan="4" style="width:50%">
                        <img class="centrado" style="width:70%;" src="<?=URL;?>public/assets/img/w&cLogo.png" alt="">
                    </td>
                    <td colspan="4" style="width:50%">
                            <p class="text-right" style="display:block"><strong>FECHA:</strong> <span><i><?= $servicio_prestado->fecha; ?></i></span></p>
                            <p class="text-right" style="display:block"><strong>CODIGO:</strong> <span><i><?= $servicio_prestado->codigo; ?></i></span></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h1 class="text-center">DETALLE SERVICIO PRESTADO</h1>
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h3><u>CLIENTE</u></h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>NOMBRE:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $servicio_prestado->cliente;?></p>
                    </td>
                    <td colspan="1">
                        <p><strong>CÉDULA/RIF:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $servicio_prestado->cliente_documento;?></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>DIRECCION:</strong></p>
                    </td>
                    <td colspan="7">
                        <p><?= $servicio_prestado->cliente_direccion;?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="8">
                        <h3><u>EMPLEADO</u></h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>NOMBRE:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $servicio_prestado->empleado;?></p>
                    </td>
                    <td colspan="1">
                        <p><strong>CÉDULA/RIF:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $servicio_prestado->empleado_documento;?></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>DIRECCION:</strong></p>
                    </td>
                    <td colspan="7">
                        <p><?= $servicio_prestado->empleado_direccion;?></p>
                    </td>
                </tr>

                
            </tbody>
        </table>
        <div class="centrado margin" style="width:100%;">
            <br><h3 class="text-center margin"><u>SERVICIOS</u></h3><br>
            <div style="width:24.5%; display:inline;" class="text-center">
                <strong>CODIGO</strong>
            </div>
            <div style="width:24.5%; display:inline;" class="text-center">
                <strong>SERVICIO</strong>
            </div>
            <div style="width:24.5%; display:inline;" class="text-center">
                <strong>PRECIO $</strong>
            </div>
            <div style="width:24.5%; display:inline;" class="text-center">
                <strong>PRECIO BSS</strong>
            </div>
           
            <!-- <div style="width:15.5%; display:inline;" class="text-center">
                <strong>TOTAL BSS</strong>
            </div> -->
            <hr class="separadorDos">
            <?php 

                    $totalServicios = 0;

                    foreach($servicios AS $servicio):

                        $totalServicios += $servicio->precio;
                        // $totalBss = $total * $dolar;
                ?>

              
                <div style="width:24.5%; display:inline;" class="text-center" >
                    <?= $servicio->id; ?>
                </div>
                <div style="width:24.5%; display:inline;" class="text-center" >
                    <?= $servicio->nombre; ?>
                </div>
                <div style="width:24.5%; display:inline;" class="text-center" >
                    <?= $servicio->precio; ?>
                </div>
                <div style="width:24.5%; display:inline;" class="text-center" >
                    <?= $servicio->precio * $servicio_prestado->dolar; ?>
                </div>
                
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $servicio->precio * $servicio->cantidad * $dolar; ?>
                </div> -->
                <br><br>

                <?php
                    endforeach;
                    
                    $totalServiciosBss = $totalServicios*$servicio_prestado->dolar;
                ?>
                <hr class="separadorDos">
                <div>
                    
                  <strong>&nbsp;TOTAL DE LOS SERVICIOS:&nbsp; <?= $totalServicios." $ - ".$totalServiciosBss." BSS"; ?></strong>
                </div>
        </div>  
        <br>
        <?php 
            if (isset($venta)) {  
                   
        ?>
        <br>
        <hr class="separador">
        <table style="width:725px">
            <tbody>
                <tr>
                    <td colspan="4" style="width:50%">
                        <!-- <img style="width:375px;height:70px;" src="<?=ROOT?>public/assets/img/logo.png" alt=""> -->
                    </td>
                    <td colspan="4" style="width:50%">
                            <p class="text-right" style="display:block"><strong>CODIGO DE LA VENTA:</strong> <span><i><?= $venta->codigo; ?></i></span></p>
                    </td>
                </tr>
            </tbody>
        </table>    
        <div class="centrado margin" style="width:100%;">
            <br><h3 class="text-center margin"><u>PRODUCTOS</u></h3><br>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>CANTIDAD</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>CODIGO</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>PRODUCTO</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>PRECIO</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>TOTAL $</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>TOTAL BSS</strong>
            </div>
            <hr class="separadorDos">
            <?php 

                    $total = 0;
                    $totalBss = 0;

                    foreach($productos AS $producto):

                        $total += ($producto->cantidad * $producto->precio);
                        // $totalBss = $total * $dolar;
                ?>

              
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->cantidad; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->codigo; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->nombre; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->precio; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->precio * $producto->cantidad; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->precio * $producto->cantidad * $venta->dolar; ?>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->precio * $producto->cantidad * $dolar; ?>
                </div> -->
                <br><br>

                <?php
                    endforeach;
                ?>
                <hr class="separadorDos">
                <div>
                    <strong>&nbsp;SUB-TOTAL:&nbsp; <?= $total?></strong><br>
                    <?php 
                        $impuesto = $total * $venta->iva/100;
                        $total += $impuesto;                        
                        $totalBss = $total * $venta->dolar;
                    ?>
                    
                    <strong>&nbsp;IVA(<?= $venta->iva; ?>%):&nbsp; <?= $impuesto; ?></strong><br>
                    <strong>&nbsp;TOTAL DE LOS PRODUCTOS:&nbsp; <?= $total." $ - ".$totalBss." BSS"; ?></strong><br>
                  <!-- <strong>&nbsp;TOTAL:&nbsp; <?= $total." $ - ".$totalBss." BSS"; ?></strong> -->
                </div>
        </div>  
        <?php                 
            }           
        ?>
        <br>
        <hr class="">
        <div>
            <?php 
                if (isset($venta)) {
                    $totalFinal = $totalServicios + $total;
                    $totalFinalBss = $totalServiciosBss + $totalBss;
                   
            ?>
                <strong>&nbsp;TOTAL:&nbsp; <?= $totalFinal." $ - ".$totalFinalBss." BSS"; ?></strong><br>
            <?php                 
                }else{  
                    $totalFinal = $totalServicios;
                    $totalFinalBss = $totalServiciosBss;       
            ?>
                <strong>&nbsp;TOTAL:&nbsp; <?= $totalFinal." $ - ".$totalFinalBss." BSS"; ?></strong>
            <?php                 
                }           
            ?>
            
        </div>
            
    </div>
</body>
</html>