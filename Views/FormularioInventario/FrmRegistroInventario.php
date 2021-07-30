<!------------------------ REGISTRO PRODUCTO EN INVENTARIO ------------------------->
<div id="nuevo_producto_inv" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_registro_productoInv">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <i class="fas fa-dolly-flatbed" style="color:#F29F05; font-size: 30px;"> Nuevo Producto en Inventario</i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <!------------------------ BODY ------------------------->
                   <div class="modal-body">
                   <label for="nom_producto">Buscar Producto</label>
                         <div class="input-group mb-3">
                         <input id="buscar" name="buscar" type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Recipient's username" aria-describedby="button-addon2">
                         <style> .ui-autocomplete { position: absolute; z-index: 2150000000 !important; cursor: default; border: 2px solid #ccc; padding: 5px 0; border-radius: 2px; } </style> 
                        </div>

                        <label for="nom_producto">Producto</label>
                        <input id="nombre_producto" name="nombre_producto" autocomplete="off" class="form-control mb-3" type="text" placeholder="Nombre del Producto" readonly required>
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