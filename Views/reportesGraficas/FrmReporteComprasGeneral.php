<!-- Modal Reporte 1 -->
<div id="modalFrmReportesComprasGenerales" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="nav-icon fas fa-shopping-cart" style="color:#F29F05; font-size: 26px;"> Reporte De Compras Generales</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >&times;</span>
                </button>
                <img id="img1" src="dist/img/surtidora.png">
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                            <div class="col-sm">
                                <label style = "font-size: 115%;">Seleccione una opción:</label><br>
                                <select id="seleccion" style = "font-size: 110%;">
                                 <option value="1">Fecha única</option>
                                 <option value="2">Rango de Fechas</option>
                                </select>
                            </div>
                            <div class="col-sm" id="fecha_unica">
                                    <label for="start" style = "font-size: 110%;">Fecha:</label><br>
                                    <input type="date" id="unique" name="trip-start"
                                           min="2021-07-01" style = "font-size: 110%;"><br>
                            </div>
                            <div class="col-sm" id="fechas">
                                <label style = "font-size: 110%;">Fecha Inicial:</label><br>
                                <input type="date" id="inicio" name="trip-start"
                                       min="2021-07-01" style = "font-size: 110%;"><br><br>
                            
                                <label style = "font-size: 110%;">Fecha Final:</label><br>
                                <input type="date" id="final" name="trip-start1"
                                       min="2021-07-01" style = "font-size: 110%;">
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