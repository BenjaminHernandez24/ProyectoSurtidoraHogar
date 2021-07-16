<!--Graficas-->
 <link href="dist/css/styles.css">
 
<div class="col-xl-6">
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-chart-area me-1">
            </i>
            Top 5 Productos Mas Vendidos.
        </div>
        <div class="card-body">
            <canvas height="40" id="top5Productos" width="100%">
            </canvas>
        </div>
    </div>
</div>
<div class="col-xl-6">
    <div class="card mb-4">
        <div class="card-header text-center" fon>
            ¿Quién me vendió mas barato el producto?
    </div>
    <div class="card-body">
        <label>Buscar Producto</label>
        <div class="input-group mb-3">
            <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
        <div class="modal-body">
                <div class="card">
                <!-- TABLA CLIENTES -->
                <table id="tblReportesGraficasProductos" class="table table-light text-justify">
                    <thead class="thead-light">
                       <tr class="table table-dark">
                        <th >Proveedor</th>
                        <th >Producto</th>
                        <th >Precio</th>
                        <th >Fecha</th>
                        <th >Hora</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        
                    </tbody>
                </table>
    <!-- /. TABLA CLIENTES -->
            </div>
        </div>
    </div>
    </div>
</div>

<!-- Modal Reporte 1 -->
<?php include("FrmReporteComprasGeneral.php"); ?>

<!-- Modal Reporte 2 -->
<?php include("FrmReporteComprasPorProveedor.php"); ?>