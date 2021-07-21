<!-- Modal Reporte 1 -->
<div id="modalFrmReportesVentas" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="nav-icon fas fa-money-check-alt" style="color:#F29F05; font-size: 26px;"> Reporte De Ventas Totales</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <img id="img3" src="dist/img/surtidora.png">
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                            <div class="col-sm" style = "font-size: 110%;">
                                <label>Seleccione una opción</label><br>
                                <select id="seleccion_Ventas">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm" id="fecha_unica_Ventas" style = "font-size: 110%;">
                                    <label for="start">Fecha:</label><br>
                                    <input type="date" id="unique_Ventas" name="trip-start"
                                           min="2021-07-01"><br>
                            </div>
                            <div class="col-sm" id="fechas_Ventas" style = "font-size: 110%;">
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