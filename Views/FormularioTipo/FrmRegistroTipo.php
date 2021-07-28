<!------------------------ REGISTRO TIPO DE PRODUCTO------------------------->
<div id="nuevo_cat_tipo" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frm_tipo_producto">
                    <!----------------------- HEADER------------------------>
                        <div class="modal-header">
                            <i class="nav-icon fas fa-boxes" style="color:#F29F05; font-size: 30px;"> Nuevo Tipo Producto</i>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                   <!------------------------ BODY ------------------------->
                        <div class="modal-body">
                                <label for="des_tipo">Descripción de tipo Producto</label>
                                <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-blender"></i></span>
                                <input class="form-control" type="text" name="des_tipo" placeholder="Descripción de tipo" required>
                            </div>
                        </div>
                    <!------------------------ FOOTER ------------------------->
                        <div class="modal-footer">
                            <button id="cerrar" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>