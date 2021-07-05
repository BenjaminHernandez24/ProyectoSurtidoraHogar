<!------------------------ EDITAR PRODUCTOS ------------------------->
<div id="editar_producto" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_editar_producto">
                         <!--------------------- HEADER ----------------------->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                      <!----------------------- BODY ----------------------->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nom_producto">Nombre de Producto</label>
                                <input class="form-control" type="text" id="nom_producto_editar" name="nom_producto_editar" placeholder="Nombre" required>
                            </div>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                        <label for="tipo">Tipo Producto</label>
                        <select class="form-control" name="tipo_producto_editar" id="tipo_producto_editar">
                           <option value="default">Selecciona un tipo</option>
                           </select>
                           </div>
                        </div>
                        <div class="modal-body">
                        <div class="mb-3">
                        <label for="marca">Marca Producto</label>
                        <select class="form-control" name="marca_producto_editar" id="marca_producto_editar">
                           <option value="default">Selecciona una Marca</option>
                           </select>
                           </div>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="precio_pub">Precio Público</label>
                                <input class="form-control" type="text" id="precio_pub_editar" name="precio_pub_editar" placeholder="Precio" required>
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