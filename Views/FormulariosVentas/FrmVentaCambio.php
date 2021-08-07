<!-- Modal Reporte 1 -->
<div id="modalFrmVentaCambio" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="nav-icon fas fa-money-check-alt" style="color:#F29F05; font-size: 26px;"> Cambiar Venta</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm" style = "font-size: 110%;">
                            <label for="start">Fecha:</label><br>
                            <input type="date" id="fechaCambiosVentas" name="trip-start"
                            min="2021-07-01"><br>
                        </div>
                        <div class="col-sm" style = "font-size: 110%;">
                            <label for="start">Total de Venta:</label><br>
                            <input type="number" id="TotalCambioVentas" name="trip-start"><br>
                        </div>
                        <div class="col-sm-5" style = "font-size: 110%;">
                           <br><label for="start">Método de pago:</label><br>
                           <select class="form-control" name="MetodoCambiosVentas" style="height:33px;">
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta de crédito">Tarjeta de crédito</option>
                            <option value="Tarjeta de débito">Tarjeta de débito</option>
                        </select>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm" style = "font-size: 110%;">
                       <br><label for="start">Total Productos:</label><br>
                       <input type="number" id="TotalPiezas" name="trip-start"><br>
                   </div>
                   <div class="col-sm-5" style = "font-size: 110%;">
                    <br><label for="start">Cliente:</label><br>
                    <select class="form-control" name="ClienteTipo" style="height:33px;" >
                        <option value="No registrado">No registrado</option>
                        <option value="Registrado">Registrado</option>
                    </select>
                </div>
                <div class="col-sm-1">
                </div>
                <div class="col-sm-6" style = "font-size: 110%;">
                   <br><label for="start">Seleccione un producto:</label><br>
                   <div class="input-group mb-2" style="width:208px;">
                       <input id="buscarProducto" name="buscarProducto" type="text" list="anrede" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off" style = "font-size: 110%;height:33px;" required>
                       <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style>
                   </div>
               </div>
           </div>
       </div>
   </div>

   <div class="modal-footer">
    <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
    <button type="button" class="btn btn-success" id="CambiosVentas">Aceptar</button>
</div>
</div>
</div>
</div>