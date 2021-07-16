<!-- Modal Reporte 1 -->
<div id="modalFrmReportesComprasGenerales" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generar Reportes De Compras Generales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                            <div class="col-sm">
                                <label>Seleccione una opción</label><br>
                                <select id="seleccion">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm" id="fecha_unica">
                                    <label for="start">Fecha:</label><br>
                                    <input type="date" id="unique" name="trip-start"
                                           min="2021-07-01"><br>
                            </div>
                            <div class="col-sm" id="fechas">
                                <label>Fecha Inicial:</label><br>
                                <input type="date" id="inicio" name="trip-start"
                                       min="2021-07-01"><br><br>
                            
                                <label> Fecha Final:</label><br>
                                <input type="date" id="final" name="trip-start1"
                                       min="2021-07-01">
                            </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="Generar">Generar Reporte</button>
            </div>
        </div>
    </div>
</div>