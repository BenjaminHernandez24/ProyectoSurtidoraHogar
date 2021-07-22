<!-- Modal Reporte 1 -->
<div id="modalFrmReportesImpresiones" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="nav-icon fas fa-receipt" style="color:#F29F05; font-size: 26px;"> Reporte De Tickets Y Facturas</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                </button>
                <img id="img4" src="dist/img/surtidora.png">
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                            <div class="col-sm-12">
                                <label style = "font-size: 115%;">Seleccione una opción:</label><br>
                                <select id="seleccionImpresion" style = "font-size: 110%;">
                                 <option value="Ticket">Tickets</option>
                                 <option value="Factura">Facturas</option>
                                 <option value="Ambos">Ambos</option>
                                 <option value="Ninguno">Ninguno</option>
                                </select>
                            </div>
                            <div class="col-sm-5">
                                <br><label style = "font-size: 110%;">Seleccione una opción:</label><br>
                                <select id="seleccionImpresionFecha" style = "font-size: 110%;">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-4" id="fecha_unica_Imp">
                                    <br><label for="start" style = "font-size: 110%;">Fecha:</label><br>
                                    <input type="date" id="uniqueImp" name="trip-start"
                                           min="2021-07-01" style = "font-size: 110%;">
                            </div>
                            <div class="col-sm-4" id="fechas_Imp">
                                <br><label style = "font-size: 110%;">Fecha Inicial:</label><br>
                                <input type="date" id="inicioImp" name="trip-start"
                                       min="2021-07-01" style = "font-size: 110%;"><br><br>
                            
                                <label style = "font-size: 110%;">Fecha Final:</label><br>
                                <input type="date" id="finalImp" name="trip-start1"
                                       min="2021-07-01" style = "font-size: 110%;">
                            </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="GenerarImp">Generar Reporte</button>
            </div>
        </div>
    </div>
</div>