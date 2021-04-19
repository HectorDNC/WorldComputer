<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas</title>

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
                        <h1 class="text-center margin">REPORTE DE VENTAS</h1>                            
                    </td>
                </tr>
            </table>
              
            <hr>
            <div>
            
                <p>
                <?php if(!$vendedores){?>
                    <strong>Vendedor: </strong> <?=$vendedor?><br>
                <?php }?>
                <?php if(!$clientes){?>
                    <strong>Cliente: </strong> <?=$cliente?><br>
                <?php }?>
                <?php if(!$productos){?>
                    <strong>Producto: </strong> <?=$producto?><br>
                <?php }?>
                 <strong>Desde: </strong> <?=$desde?><br>
                 <strong>Hasta: </strong> <?=$hasta?>
                </p>
                
            </div>
            <!-- Ventas -->
            <?php if(isset($ventas) && count($ventas)>0){?>
            <div clas="separadorDos"></div>
            <h3 class="text-center margin"><u>VENTAS</u></h3><br>
        
        
        <?php if($vendedores){?>
            <div>
                <div style="width:15%; display:inline;" class="text-center">
                    <strong>CÓDIGO</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>FECHA</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>CLIENTE</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>VENDEDOR</strong>
                </div>
                <div style="width:18%; display:inline;" class="text-center">
                    <strong>TOTAL $</strong>
                </div>
                <div style="width:18%; display:inline;" class="text-center">
                    <strong>TOTAL BSS</strong>
                </div>
            </div>
            
            <hr><br>
            <?php                    
                $total = 0;
                $totalBss = 0;
                foreach($ventas AS $venta):
                    $cantidad++;
                    $total += $venta->total;
                    $totalBss += $venta->totalBss;
            ?>

            <div>
                <div style="width:15%; display:inline;" class="text-center" >
                    <span><?= $venta->codigo; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $venta->fecha; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $venta->cliente; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $venta->vendedor; ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $venta->total; ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $venta->totalBss; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
                <?php
                    endforeach;
                ?>
            <div>
                <div style="width:22.5%; display:inline;" class="text-center" >
                    <b>Cantidad de Ventas</b>
                </div>
                <div style="width:23.5%; display:inline;" class="text-center" >
                    <span><?= $cantidad; ?></span>
                </div>
                <!-- <div style="width:15.5%; display:inline;" class="text-center" >
                    <span></span>
                </div> -->
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <b>Total</b>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $total ?></span>
                </div>
                <div style="width:18%; display:inline;" class="text-center" >
                    <span><?= $totalBss; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
            <?php }else{?>
                <div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>CÓDIGO</strong>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center">
                        <strong>FECHA</strong>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>CLIENTE</strong>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>TOTAL $</strong>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center">
                        <strong>TOTAL BSS</strong>
                    </div>
                </div>

                <hr><br>
                <?php                    
                    $total = 0;
                    $totalBss = 0;
                    foreach($ventas AS $venta):
                        $cantidad++;
                        $total += $venta->total;
                        $totalBss += $venta->totalBss;
                ?>

                <div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->codigo; ?></span>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center" >
                        <span><?= $venta->fecha; ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->cliente; ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->total ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $venta->totalBss; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
                <?php
                    endforeach;
                ?>
                <div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <b>Cantidad de Ventas</b>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center" >
                        <span><?= $cantidad ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <b>Total</b>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $total ?></span>
                    </div>
                    <div style="width:18.5%; display:inline;" class="text-center" >
                        <span><?= $totalBss; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
            <?php }?>
            <?php } ?>
            <br> 
                
        </div>  
        <!-- Fin de Ventas -->
       
        <br>
        <div class="separadorDos"></div>
        <div class="separadorDos"></div>
        <!-- Métodos de Pago -->
        
           
            
    </div>
</body>
</html>