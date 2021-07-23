<!------------------------ REGISTRO  DE PRODUCTOS ------------------------->
<div id="nuevo_producto" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_registro_producto">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                   <!------------------------ BODY ------------------------->
                        <div class="modal-body">
                                <label for="nom_producto">Nombre Producto</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="nav-icon fas fa-box-open"></i></span>
                                <input class="form-control" autocomplete="off" type="text" name="nom_producto" placeholder="Nombre producto" required>
                            </div>
                        </div>
                        <div class="modal-body">
                        <label for="tipo">Tipo Producto</label>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                        <select class="form-control" name="tipo_producto" id="tipo_producto">
                           <option value="default">Selecciona un tipo</option>
                           </select>
                           </div>
                        </div>
                        <div class="modal-body">
                        <label for="marca">Marca Producto</label>
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="addon-wrapping"> <i class="fas fa-tag"></i></span>
                        <select class="form-control" name="marca_producto" id="marca_producto">
                           <option value="default">Selecciona una Marca</option>
                           </select>
                           </div>
                        </div>
                        <div class="modal-body">
                                <label for="precio_pub">Precio Público</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"> <i class="fas fa-money-check-alt"></i></span>
                                <input class="form-control" autocomplete="off" type="number" step="any" id="precio_pub" name="precio_pub" placeholder="Precio" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">  Registrar   </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>