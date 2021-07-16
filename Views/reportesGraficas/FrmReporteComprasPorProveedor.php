<!-- Modal Reporte 2 -->
<div id="modalFrmReportesComprasEspecificas" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generar Reportes De Compras Por Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Seleccione un proveedor: </label>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                               <input id="buscarProveedor" name="buscarProveedor" type="text" list="anrede" class="form-control" placeholder="Nombre del Proveedor" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off" required>
                               <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style>
                            </div>
                        </div>
                            <div class="col-sm-1">
                            </div>
                            <div class="col-sm-5">
                                <label>Seleccione una opción</label><br>
                                <select id="seleccionReporte2">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm-4" id="fecha_unica_Prov">
                                    <label for="start">Fecha:</label><br>
                                    <input type="date" id="uniqueProv" name="trip-start"
                                           min="2021-07-01">
                            </div>
                            <div class="col-sm-4" id="fechas_Prov">
                                <label>Fecha Inicial:</label><br>
                                <input type="date" id="inicioProv" name="trip-start"
                                       min="2021-07-01"><br><br>
                            
                                <label> Fecha Final:</label><br>
                                <input type="date" id="finalProv" name="trip-start1"
                                       min="2021-07-01">
                            </div>
                            <div class="col-sm-1">
                            </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="GenerarReporte2">Generar Reporte</button>
            </div>
        </div>
    </div>
</div>