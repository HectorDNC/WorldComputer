<div class="content p-4">
    <div class="card mb-4">
        <div class="card-header bg-white font-weight-bold">
            <h2 class="text-center">Reporte Estadístico de Ventas</h2>
        </div>
        <div class="card-body">
            <div class="container px-2">
                <h4><strong>Desde: </strong> <?=$desde?></h4> 
                <h4><strong>Hasta: </strong> <?=$hasta?></h4>
                <?php
                    if(isset($oVendedor)){
                        echo "<h4><strong>Vendedor: </strong> $oVendedor->nombre  $oVendedor->apellido</h4>";
                    }
                    if(isset($oProducto)){
                        echo "<h4><strong>Producto: </strong> $oProducto->nombre</h4>";
                    }
                    if(isset($oCliente)){
                        echo "<h4><strong>Cliente: </strong> $oCliente->nombre $oCliente->apellido</h4>";
                    }
                ?>
            </div>
        </div>
        <!-- Si hay regitros se muestran los gráficos -->
        <?php
            if($productosC[0]!="" && $clientesC[0]!=""){
        ?>
            <div class="card">
                <div class="card-body">
                <?php
                    if($productos){
                        echo "<h3>Productos más demandados</h3>";
                    }
                    else{
                        echo "<h3>Demanda del Producto</h3>";
                    }
                ?>
                    
                    <div class="m-auto"><canvas id="chartProductos" width="350" height="250"></canvas></div>
                    
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                <?php
                    if($clientes){
                        echo "<h3>Clientes frecuentes</h3>";
                    }
                    else{
                        echo "<h3>Frecuencia del Cliente</h3>";
                    }
                ?>
                    <div class="m-auto"><canvas id="chartClientes" width="350" height="250"></canvas></div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="<?=ROOT;?>Reporte/reporteVenta" method="POST" enctype="multipart/form-data" id="formularioReporte" target="_blank">
                        <input type="hidden" name="vendedor" value="<?=$_POST['vendedor']?>">
                        <input type="hidden" name="cliente" value="<?=$_POST['cliente']?>">
                        <input type="hidden" name="producto" value="<?=$_POST['producto']?>">
                        <input type="hidden" name="desde" value="<?=$_POST['desde']?>">
                        <input type="hidden" name="hasta" value="<?=$_POST['hasta']?>">
                        <div class="row text-center justify-content-center">
                            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-list-alt"></i>Reporte de Detalles de Ventas</button>
                        </div>
                        <div class="row text-center justify-content-center">
                            <span class="w-75">Extraiga un documento PDF con los detalles de las ventas realizadas con los parámetros escogidos</span>
                        </div>                  
                        
                    </form>
                </div>
            </div>
        <?php
            }else{//Si no hay registros muestra un mensaje
        ?>
            <div class="card p-3 justify-content-center">
                <h3>No hay registros que posean los parámetros escogidos</h3>
            </div>
        <?php
            }
        ?>
        
        
    </div>
    <script src="<?= ROOT; ?>node_modules/chart.js/dist/Chart.min.js"></script>
    <script>
        $(document).ready(function () {  
            var cp = document.getElementById('chartProductos');
            var chartProductos = new Chart(cp, {
                type: 'bar',
                data: {
                    labels: [
                        '<?=$productosN[0]?>', '<?=$productosN[1]?>', '<?=$productosN[2]?>', '<?=$productosN[3]?>', '<?=$productosN[4]?>', '<?=$productosN[5]?>', '<?=$productosN[6]?>',<?=$productosN[7]?>
                    ],
                    datasets: [{
                        label: 'Cantidad de Ventas en las que se demandó el producto',
                        data: [
                            '<?=$productosC[0]?>', '<?=$productosC[1]?>', '<?=$productosC[2]?>', '<?=$productosC[3]?>', '<?=$productosC[4]?>', '<?=$productosC[5]?>', '<?=$productosC[6]?>',<?=$productosC[7]?>
                        ],
                        backgroundColor: [                            
                            'rgba(54, 162, 235, 0.9)',
                            'rgba(255, 206, 86, 0.9)',
                            'rgba(24, 255, 255, 0.9)',
                            'rgba(200, 99, 132, 0.9)',
                            'rgba(153, 102, 255, 0.9)',
                            'rgba(255, 159, 64, 0.9)',
                            'rgba(238, 255, 65, 0.9)',
                            'rgba(67, 160, 71, 0.9)'
                        
                        ],
                        borderColor: [                            
                            'rgba(54, 182, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(24, 255, 255, 1)',
                            'rgba(200, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(238, 255, 65, 1)',
                            'rgba(67, 160, 71, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'black',
                            fontFamily: 'Arial',
                            fontSize: 12
                        }
                    },
                    
                }
            });

            var cc = document.getElementById('chartClientes');
            var chartClientes = new Chart(cc, {
                type: 'line',
                data: {
                    labels: [
                        '<?=$clientesN[0]?>', '<?=$clientesN[1]?>', '<?=$clientesN[2]?>', '<?=$clientesN[3]?>', '<?=$clientesN[4]?>', '<?=$clientesN[5]?>', '<?=$clientesN[6]?>',<?=$clientesN[7]?>
                    ],
                    datasets: [{
                        label: 'Cantidad de Ventas al cliente',
                        data: [
                            '<?=$clientesC[0]?>', '<?=$clientesC[1]?>', '<?=$clientesC[2]?>', '<?=$clientesC[3]?>', '<?=$clientesC[4]?>', '<?=$clientesC[5]?>', '<?=$clientesC[6]?>',<?=$clientesC[7]?>
                        ],
                        backgroundColor: [                            
                            'rgba(54, 162, 235, 0.45)',
                            'rgba(255, 206, 86, 0.45)',
                            'rgba(24, 255, 255, 0.45)',
                            'rgba(200, 99, 132, 0.45)',
                            'rgba(153, 102, 255, 0.45)',
                            'rgba(255, 159, 64, 0.45)',
                            'rgba(238, 255, 65, 0.45)',
                            'rgba(67, 160, 71, 0.45)'
                        
                        ],
                        borderColor: [                            
                            'rgba(54, 182, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(24, 255, 255, 1)',
                            'rgba(200, 99, 132, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(238, 255, 65, 1)',
                            'rgba(67, 160, 71, 1)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                // stepSize: 1,
                                beginAtZero: true
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontColor: "black",
                                fontSize: 12,
                                stepSize: 1,
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        labels: {
                            // This more specific font property overrides the global property
                            fontColor: 'black',
                            fontFamily: 'Arial',
                            fontSize: 12
                        }
                    },
                    
                }
            });
        });
        
    </script>