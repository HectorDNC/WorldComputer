<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>

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

        <div class="centrado" style="width=98%;">
            <h1 class="text-center margin">REPORTE DE PRODUCTOS</h1>
            <hr>
            <div>
            
                <p>
                <?php if(!$categorias){?>
                    <strong>Categoria: </strong> <?=$categoria?><br>
                <?php }?>
                <?php if(!$productosFiltro){?>
                    <strong>Producto: </strong> <?=$producto?><br>
                <?php }?>
                </p>
                
            </div>
            <!-- Productos -->
            <?php if(isset($productos) && count($productos)>0){?>
            <div clas="separadorDos"></div>
            <h3 class="text-center margin"><u>PRODUCTOS</u></h3><br>
        
        
        <?php if($categorias){?>
            <div>
                <div style="width:11%; display:inline;" class="text-center">
                    <strong>CÓDIGO</strong>
                </div>
                <div style="width:14.5%; display:inline;" class="text-center">
                    <strong>PRODUCTO</strong>
                </div>
                <div style="width:14%; display:inline;" class="text-center">
                    <strong>CATEGORIA</strong>
                </div>
                <div style="width:14%; display:inline;" class="text-center">
                    <strong>PRECIO VENTA</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>STOCK</strong>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center">
                    <strong>STOCK MAX.</strong>
                </div>
                <div style="width:14%; display:inline;" class="text-center">
                    <strong>STOCK MIN.</strong>
                </div>
            </div>
            
            <hr><br>
            <?php                    
                $total = 0;
                foreach($productos AS $producto):
                    $cantidad++;
            ?>

            <div>
                <div style="width:11%; display:inline;" class="text-center" >
                    <span><?= $producto->codigo; ?></span>
                </div>
                <div style="width:14.5%; display:inline;" class="text-center" >
                    <span><?= $producto->nombre; ?></span>
                </div>
                <div style="width:14%; display:inline;" class="text-center" >
                    <span><?= $producto->categoria; ?></span>
                </div>
                <div style="width:14%; display:inline;" class="text-center" >
                    <span><?= $producto->precio_venta; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $producto->stock; ?></span>
                </div>
                <div style="width:15.5%; display:inline;" class="text-center" >
                    <span><?= $producto->stock_max; ?></span>
                </div>
                <div style="width:14%; display:inline;" class="text-center" >
                    <span><?= $producto->stock_min; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
                <?php
                    endforeach;
                ?>
            <div>
                <div style="width:22.5%; display:inline;" class="text-center" >
                    <b>Cantidad de Productos</b>
                </div>
                <div style="width:23.5%; display:inline;" class="text-center" >
                    <span><?= $cantidad; ?></span>
                </div>
            </div>
                
            <br>
            <div class="separador"></div>
            <?php }else{?>
                <div>
                    <div style="width:11%; display:inline;" class="text-center">
                        <strong>CÓDIGO</strong>
                    </div>
                    <div style="width:25.5%; display:inline;" class="text-center">
                        <strong>PRODUCTO</strong>
                    </div>
                    <div style="width:14%; display:inline;" class="text-center">
                        <strong>PRECIO VENTA</strong>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center">
                        <strong>STOCK</strong>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center">
                        <strong>STOCK MAX.</strong>
                    </div>
                    <div style="width:14%; display:inline;" class="text-center">
                        <strong>STOCK MIN.</strong>
                    </div>
                </div>

                <hr><br>
                <?php                    
                    $total = 0;
                    foreach($productos AS $producto):
                        $cantidad++;
                ?>

                <div>
                    <div style="width:11%; display:inline;" class="text-center" >
                        <span><?= $producto->codigo; ?></span>
                    </div>
                    <div style="width:25.5%; display:inline;" class="text-center" >
                        <span><?= $producto->nombre; ?></span>
                    </div>
                    <div style="width:14%; display:inline;" class="text-center" >
                        <span><?= $producto->precio_venta; ?></span>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center" >
                        <span><?= $producto->stock; ?></span>
                    </div>
                    <div style="width:15.5%; display:inline;" class="text-center" >
                        <span><?= $producto->stock_max; ?></span>
                    </div>
                    <div style="width:14%; display:inline;" class="text-center" >
                        <span><?= $producto->stock_min; ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
                <?php
                    endforeach;
                ?>
                <div>
                    <div style="width:33.33%; display:inline;" class="text-center" >
                        <b>Cantidad de Productos</b>
                    </div>
                    <div style="width:16.6%; display:inline;" class="text-center" >
                        <span><?= $cantidad ?></span>
                    </div>
                </div>
                
                <br>
                <div class="separador"></div>
            <?php }?>
            <?php } ?>
            <br> 
                
        </div>  
        <!-- Fin de Servicios -->
       
        <br>
        <div class="separadorDos"></div>
        <div class="separadorDos"></div>
            
    </div>
</body>
</html>