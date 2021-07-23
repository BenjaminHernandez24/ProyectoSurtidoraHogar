<!------------------------ REGISTRO PRODUCTO EN INVENTARIO ------------------------->
<div id="nuevo_producto_inv" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_registro_productoInv">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto en Inventario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <!------------------------ BODY ------------------------->
                   <div class="modal-body">
                        <label for="producto_inventario">Producto</label>
                        <div class="input-group mb-3">
                           <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                             <select class="form-control" name="producto" id="producto">
                              <option value="default">Selecciona un producto</option>
                            </select>
                        </div>
                    </div>
                        <div class="modal-body">
                                <label for="estatus_acept">Estatus Aceptable</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-sort-amount-up"></i></span>
                                <input class="form-control"  autocomplete="off"  id="estatus_acept" type="number" name="estatus_acept" placeholder="Introduzca Estatus Aceptable" required>
                            </div>
                        </div>
                        <div class="modal-body">
                                <label for="estatus_alert">Estatus Alerta</label>
                                <div class="input-group mb-3">   
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-sort-amount-down"></i></i></span>
                                <input class="form-control"  autocomplete="off" type="number" id="estatus_alert" name="estatus_alert" placeholder="Introduzca Estatus Alerta" required>
                            </div>
                        </div>
                        <div class="modal-body">
                                <label for="stock">Stock</label>
                                <div class="input-group mb-3">   
                                <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-boxes"></i></i></span>
                                <input class="form-control"  autocomplete="off" type="number" id="stock" name="stock" placeholder="Introduzca la cantidad de producto" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success"> Registrar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>