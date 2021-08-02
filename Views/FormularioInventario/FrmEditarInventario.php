<!------------------------ EDITAR PRODUCTOS EN INVENTARIO ------------------------->
<div id="editar_producto_inventario" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_editar_productoInv">
                         <!--------------------- HEADER ----------------------->
                        <div class="modal-header">
                            <i class="fas fa-dolly-flatbed" style="color:#F29F05; font-size: 30px;"> Editar Producto en Inventario</i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      <!----------------------- BODY ----------------------->
                        <div class="modal-body">
                        <label for="producto">Producto</label>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                        <select class="form-control" name="producto_editar" id="producto_editar">
                        <option id="producto" value="default">Seleccione un Producto</option>
                           </select>
                           </div>
                        </div>
                        
                        <div class="modal-body">
                                <label for="estatus">Estatus Alerta</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"> <i class="fas fa-sort-amount-down"></i></span>
                                <input class="form-control" type="number" id="estatus_alert_editar" name="estatus_alert_editar" placeholder="escribe estatus" required>
                            </div>
                        </div>
                        <div class="modal-body">
                                <label for="stock">Stock</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"> <i class="nav-icon fas fa-boxes"></i></span>
                                <input class="form-control" type="number" id="stock_editar" name="stock_editar" placeholder="Introduzca la cantidad de producto" required>
                            </div>
                        </div>
                         <!---------------------- FOOTER ----------------------->
                        <div class="modal-footer">
                            <button id="cerrarEditar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>