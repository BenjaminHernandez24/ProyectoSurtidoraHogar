<!-- Modal Reporte 2 -->
<div id="modalFrmReportesComprasEspecificas" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="nav-icon fas fa-parachute-box" style="color:#F29F05; font-size: 25px;"> Reporte De Compras Por Proveedor</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <label style = "font-size: 110%;">Seleccione un proveedor:</label>
                        </div>
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                               <input id="buscarProveedor" name="buscarProveedor" type="text" list="anrede" class="form-control" placeholder="Nombre del Proveedor" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off" style = "font-size: 110%;" required>
                               <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style>
                            </div>
                        </div>
                            
                            <div class="col-sm-5">
                                <label style = "font-size: 110%;">Seleccione una opción:</label><br>
                                <select id="seleccionReporte2" style = "font-size: 110%;">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-4" id="fecha_unica_Prov">
                                    <label for="start" style = "font-size: 110%;">Fecha:</label><br>
                                    <input type="date" id="uniqueProv" name="trip-start"
                                           min="2021-07-01" style = "font-size: 110%;">
                            </div>
                            <div class="col-sm-4" id="fechas_Prov">
                                <label style = "font-size: 110%;">Fecha Inicial:</label><br>
                                <input type="date" id="inicioProv" name="trip-start"
                                       min="2021-07-01" style = "font-size: 110%;"><br><br>
                            
                                <label style = "font-size: 110%;">Fecha Final:</label><br>
                                <input type="date" id="finalProv" name="trip-start1"
                                       min="2021-07-01" style = "font-size: 110%;">
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