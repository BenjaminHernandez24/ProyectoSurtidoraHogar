<!--Graficas-->
 <link href="dist/css/styles.css">
 
<div class="col-xl-12">
    <div class="card mb-4">
        <div class="card-header">
            <font style="font-size: 140%">
            <i class="fas fa-chart-area me-1">
            </i>
            Top 8 Productos Mas Vendidos.
        </font>
            <button class="col-md-2 float-right btn btn-primary" type="button" id="precioBarato"><font size="4">Precio más barato</font></button>
        </div>
        <div class="card-body">
        <canvas class="linear" height="55" id="top5Productos" width="100%">
        </canvas>
    </div>
    </div>
</div>

<!-- Modal Reporte 1 -->
<div id="modalFrmBarato" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="left: 50%;
   top: 27%; 
   margin-left: -365px;
   margin-top: -150px;">
        <div class="modal-content" style="width:750px;">
            <div class="modal-header">
                <i class="nav-icon fas fa-file-invoice-dollar" style="color:#F29F05; font-size: 26px;"> ¿Quién me vendió más barato el producto?</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                <div class="row">
                        <div class="col-sm-12">
                            <label style = "font-size: 110%;">Buscar Producto:</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                               <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
                               <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style>
                            </div>
                        </div>
                        <div class="col-sm-12">
                        <br>
                            <table id="tblReportesGraficasProductos" class="table table-light text-center">
                                <thead class="thead-light" >
                                   <tr class="table table-dark">
                                    <th >Proveedor</th>
                                    <th >Estatus</th>
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

            <div class="modal-footer">
                <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
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

<!-- Modal Reporte 3 -->
<?php include("FrmImpresiones.php"); ?>