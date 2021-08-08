<!-- Modal Reporte 1 -->
<div id="modalFrmVentaCambio" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
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
                        <div class="col-8">
                            <label for="nom_empresa">Producto(s) que devuelve</label>
                            <div class="input-group mb-3">
                                <input id="buscar_devuelve" name="buscar_devuelve" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
                                <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style>
                            </div>
                        </div>
                        <div class="col">
                            <label for="nom_empresa">Total</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                <input id="total_devuelve" name="total_devuelve" style="font-size: 25px;" type="number" step="any" class="form-control input-lg" placeholder="0" readonly required>
                            </div>
                        </div>
                    </div>

                    <table id="productos_devuelve" class="table table-light">
                        <thead class="thead-light">
                            <tr class="table table-dark">
                                <th>ID_Inventario</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_devuelve">

                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-8">
                            <label for="nom_empresa">Producto(s) que cambia</label>
                            <div class="input-group mb-3">
                                <input id="buscar_cambia" name="buscar_cambia" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style>
                            </div>
                        </div>
                        <div class="col">
                            <label for="nom_empresa">Total</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                                <input id="total_cambia" name="total_cambia" style="font-size: 25px;" type="number" step="any" class="form-control input-lg" placeholder="0" readonly required>
                            </div>
                        </div>
                    </div>

                    <table id="productos_cambia" class="table table-light">
                        <thead class="thead-light">
                            <tr class="table table-dark">
                                <th>ID_Inventario</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_cambia">

                        </tbody>
                    </table>

                    <label for="nom_empresa">Diferencia a cobrar</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-dollar-sign"></i></span>
                        <input id="diferencia_cobro" name="diferencia_cobro" style="font-size: 25px;" type="number" step="any" class="form-control input-lg" placeholder="0" readonly required>
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