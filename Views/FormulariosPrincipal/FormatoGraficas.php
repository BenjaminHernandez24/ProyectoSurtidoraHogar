<!--Graficas-->
 <link href="dist/css/styles.css">

<section class="content-header">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row vertical-divider" style="margin-top: 30px">
                <div class="col-xl-6">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1">
                        </i>
                        Los 3 Clientes Mas Frecuentes Del Mes
                    </div>
                    <div class="card-body">
                        <canvas height="40" id="frecuenciaDelCliente" width="100%">
                        </canvas>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1">
                        </i>
                        Ventas Totales Por Mes.
                    </div>
                    <div class="card-body">
                        <canvas height="40" id="ventasTotalesPorMes" width="100%">
                        </canvas>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Gráficas--> 
 <script src="plugins/chart.js/Chart.min.js"></script>
 <script src="dist/js/scripts.js"></script>
 <script src="dist/js/simple-datatables@latest.js"></script>
 <script src="dist/js/datatables-simple-demo.js"></script>
 <script src="dist/js/pages/Graficas.js"></script>