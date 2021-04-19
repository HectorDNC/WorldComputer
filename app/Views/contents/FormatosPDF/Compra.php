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

    </style>
</head>
<body>
    <div class="container">

        <table style="width:725px">
            <tbody>
                <tr>
                    <td colspan="4" style="width:50%">
                        <img class="centrado" style="width:70%;" src="<?=URL;?>public/assets/img/w&cLogo.png" alt="">
                    </td>
                    <td colspan="4" style="width:50%;">
                            <p class="text-right" style="display:block"><strong>Fecha:</strong> <span><i><?= $compra->fecha." ".$compra->hora; ?></i></span></p>
                            <p class="text-right" style="display:block"><strong>Nro Compra:</strong> <span><i><?= $compra->codigo; ?></i></span></p>
                            <p class="text-right" style="display:block"><strong>Referencia:</strong> <span><i><?= $compra->referencia; ?></i></span></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h1 class="text-center">DETALLE COMPRA</h1>
                        <hr>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h3><u>PROVEEDOR</u></h3>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>RAZON SOCIAL:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $compra->proveedor;?></p>
                    </td>
                    <td colspan="1">
                        <p><strong>CÉDULA/RIF:</strong></p>
                    </td>
                    <td colspan="3">
                        <p><?= $compra->rif_proveedor;?></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="1">
                        <p><strong>DIRECCION:</strong></p>
                    </td>
                    <td colspan="7">
                        <p><?= $compra->direccion;?></p>
                    </td>
                </tr>

                <tr>
                    <td colspan="8">
                        <h3 class="text-center"><u>PRODUCTOS</u></h3>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div class="centrado" style="width:100%;">
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
                <strong>COSTO</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>TOTAL $</strong>
            </div>
            <div style="width:15.5%; display:inline;" class="text-center">
                <strong>TOTAL BSS</strong>
            </div>
            <hr>
            <?php 

                    $total = 0;

                    foreach($productos AS $producto):

                        $total += ($producto->cantidad * $producto->costo);
                        
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
                    <?= $producto->costo; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->costo * $producto->cantidad; ?>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->costo * $producto->cantidad * $compra->dolar; ?>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <?= $producto->costo * $producto->cantidad * $dolar; ?>
                </div> -->
                <br><br>

                <?php
                    endforeach;
                    $totalBss = $total * $compra->dolar;
                ?>
                <hr>
                <div>
                    
                  <!-- <strong>&nbsp;TOTAL:&nbsp; <?= $total; ?></strong> -->
                  <strong>&nbsp;TOTAL:&nbsp; <?= $total." $ - ".$totalBss." BSS"; ?></strong>
                </div>
        </div>
          
        
           
            
    </div>
</body>
</html>