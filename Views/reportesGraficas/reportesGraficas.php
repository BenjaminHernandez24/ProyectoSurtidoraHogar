<!--Graficas-->
 <link href="dist/css/styles.css">
 
<div class="col-xl-6">
    <div class="card mb-4">
        <div class="card-header">
            <font style="font-size: 140%">
            <i class="fas fa-chart-area me-1">
            </i>
            Top 5 Productos Mas Vendidos.
        </font>
        </div>
        <canvas class="linear" height="92" id="top5Productos" width="100%">
        </canvas>
    </div>
</div>
<div class="col-xl-6">
    <div class="card" style="height: 96%;">
        <div class="card-header text-center">
            <font style="font-size: 140%">
            <i class="nav-icon fas fa-file-invoice-dollar"></i> ¿Quién me vendió mas barato el producto?
        </font>
    </div>
    <div class="card-body">
        <label><font size=5% FACE="roman">Buscar Producto</font></label>
        <div class="input-group mb-3">
            <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        
                    <br>
                <!-- TABLA CLIENTES -->
                <table id="tblReportesGraficasProductos" class="table table-light text-center">
                    <thead class="thead-light" >
                       <tr class="table table-dark">
                        <th >Proveedor</th>
                        <th >Producto</th>
                        <th >Precio</th>
                        <th >Fecha</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                    </tbody>
                </table>
        </div>
    </div>
</div>
</div>

<!-- Modal Reporte 1 -->
<?php include("FrmReporteComprasGeneral.php"); ?>

<!-- Modal Reporte 2 -->
<?php include("FrmReporteComprasPorProveedor.php"); ?>

<!-- Modal Reporte 3 -->
<?php include("FrmReporteVentasTotales.php"); ?>