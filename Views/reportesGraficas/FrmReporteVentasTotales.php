<!-- Modal Reporte 1 -->
<div id="modalFrmReportesVentas" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generar Reportes De Ventas Totales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                            <div class="col-sm">
                                <label>Seleccione una opción</label><br>
                                <select id="seleccion_Ventas">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm" id="fecha_unica_Ventas">
                                    <label for="start">Fecha:</label><br>
                                    <input type="date" id="unique_Ventas" name="trip-start"
                                           min="2021-07-01"><br>
                            </div>
                            <div class="col-sm" id="fechas_Ventas">
                                <label>Fecha Inicial:</label><br>
                                <input type="date" id="inicio_Ventas" name="trip-start"
                                       min="2021-07-01"><br><br>
                            
                                <label> Fecha Final:</label><br>
                                <input type="date" id="final_Ventas" name="trip-start1"
                                       min="2021-07-01">
                            </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="Generar_Ventas">Generar Reporte</button>
            </div>
        </div>
    </div>
</div>