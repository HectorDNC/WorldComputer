<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Compras</title>

    <style type="text/css">
        *{
            margin: 0;
            padding: 0;
        }
        .container{
            padding: 0px 0px;
            /* color:lightslategrey; */
            color:black;
        }
        .padding{
            padding: 2px;
        }
        .margin{
            margin: 2px 0px;
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
        .clear{
            clear: both;
        }
        .separador{
            display:block; 
            width:100%; 
            height:1px; 
            margin: 1px 0px;
            background: gray; 
        }
        .separadorDos{
            display:block; 
            width:100%; 
            height:1px; 
            margin: 2px 0px;
        }

    </style>
</head>
<body>
    <div class="container centrado" style="width: 98%;">

        <div class="centrado" style="width:98%;">
            <table>
                <tr>
                    <td colspan="4" style="width:50%">
                        <img class="centrado" style="width:80%;" src="<?=URL;?>public/assets/img/w&cLogoMini.png" alt=""> 
                    </td>
                    <td colspan="4" style="width:50%; padding-top:10px;">
                        <h1 class="text-center margin">REPORTE DE COMPRAS</h1>                            
                    </td>
                </tr>
            </table>
            <hr>
            <div>
            
                <p>
                <?php if(!$proveedores){?>
                    <strong>Proveedor: </strong> <?=$proveedor?><br>
                <?php }?>
                <?php if(!$productos){?>
                    <strong>Producto: </strong> <?=$producto?><br>
                <?php }?>
                 <strong>Desde: </strong> <?=$desde?><br>
                 <strong>Hasta: </strong> <?=$hasta?>
                </p>
                
            </div>
            <!-- Compras -->
            <?php if(isset($compras) && count($compras)>0){?>
            <div clas="separadorDos"></div>
            <h3 class="text-center margin"><u>COMPRAS</u></h3><br>
        
        
        <?php if($proveedores){?>
            <div>
                <div style="width:18%; display:inline;" class="text-center">
                    <strong>CÓDIGO</strong>
                </div>
                <div style="width:18.5%; display:inline;" class="text-center">
                    <strong>FECHA</strong>
                </div>
                <div style="width:18.5%; display:inline;" class="text-center">
                    <strong>PROVEEDOR</strong>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>IMPUESTO</strong>
                </div> -->
                <div style="width:21%; display:inline;" class="text-center">
                    <strong>TOTAL $</strong>
                </div>
                <div style="width:21%; display:inline;" class="text-center">
                    <strong>TOTAL BSS</strong>
                </div>
            </div>
            
            <hr><br>
            <?php                    
                $total = 0;
                $totalBss = 0;
                foreach($compras AS $compra):
                    $cantidad++;
                    $total += $compra->total;
                    $totalBss += $compra->totalBss;
            ?>

            <div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $compra->codigo; ?></span>
                </div>
                <div style="width:18.5%; display:inline;" class="text-center" >
                    <span><?= $compra->fecha; ?></span>
                </div>
                <div style="width:18.5%; display:inline;" class="text-center" >
                    <span><?= $compra->proveedor; ?></span>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $compra->impuesto; ?></span>
                </div> -->
                <div style="width:21%; display:inline;" class="text-center" >
                    <span><?= $compra->total ?></span>
                </div>
                <div style="width:21%; display:inline;" class="text-center" >
                    <span><?= $compra->totalBss; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
                <?php
                    endforeach;
                ?>
            <div>
                <div style="width:20.5%; display:inline;" class="text-center" >
                    <b>Cantidad de Compras</b>
                </div>
                <div style="width:19.5%; display:inline;" class="text-center" >
                    <span><?= $cantidad; ?></span>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <span></span>
                </div> -->
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <b>Total</b>
                </div>
                <div style="width:21%; display:inline;" class="text-center" >
                    <span><?= $total ?></span>
                </div>
                <div style="width:21%; display:inline;" class="text-center" >
                    <span><?= $totalBss; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
            <?php }else{?>
                <div>
                    <div style="width:25%; display:inline;" class="text-center">
                        <strong>CÓDIGO</strong>
                    </div>
                    <div style="width:25.5%; display:inline;" class="text-center">
                        <strong>FECHA</strong>
                    </div>
                    <!-- <div style="width:20.5%; display:inline;" class="text-center">
                        <strong>IMPUESTO</strong>
                    </div> -->
                    <div style="width:23%; display:inline;" class="text-center">
                        <strong>TOTAL $</strong>
                    </div>
                    <div style="width:23%; display:inline;" class="text-center">
                        <strong>TOTAL BSS</strong>
                    </div>
                </div>

                <hr><br>
                <?php                    
                    $total = 0;
                    $totalBss = 0;
                    foreach($compras AS $compra):
                        $cantidad++;
                        $total += $compra->total;
                        $totalBss += $compra->totalBss;
                ?>

                <div>
                    <div style="width:25%; display:inline;" class="text-center" >
                        <span><?= $compra->codigo; ?></span>
                    </div>
                    <div style="width:25.5%; display:inline;" class="text-center" >
                        <span><?= $compra->fecha; ?></span>
                    </div>
                    <!-- <div style="width:20.5%; display:inline;" class="text-center" >
                        <span><?= $compra->impuesto; ?></span>
                    </div> -->
                    <div style="width:23%; display:inline;" class="text-center" >
                        <span><?= $compra->total ?></span>
                    </div>
                    <div style="width:23%; display:inline;" class="text-center" >
                        <span><?= $compra->totalBss; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
                <?php
                    endforeach;
                ?>
                <div>
                    <div style="width:23.5%; display:inline;" class="text-center" >
                        <b>Cantidad de Compras</b>
                    </div>
                    <div style="width:13%; display:inline;" class="text-center" >
                        <span><?= $cantidad ?></span>
                    </div>
                    <div style="width:14.5%; display:inline;" class="text-center" >
                        <b>Total</b>
                    </div>
                    <div style="width:23%; display:inline;" class="text-center" >
                        <span><?= $total ?></span>
                    </div>
                    <div style="width:23%; display:inline;" class="text-center" >
                        <span><?= $totalBss; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
            <?php }?>
            <?php } ?>
            <br> 
                
        </div>  
        <!-- Fin de Compras -->
       
        <br>
        <div class="separadorDos"></div>
        <div class="separadorDos"></div>
           
            
    </div>
</body>
</html>