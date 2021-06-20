 <!--=====================================
        MODAL EDITAR CLIENTE 
        ======================================-->

        <div id="modalEditarCliente" class="modal fade" role="dialog">

            <div class="modal-dialog">

                <div class="modal-content">

                    <form id="formEditCliente">

                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->

                        <div class="modal-header">

                            <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre Cliente" required>
                            </div>
                            <div class="mb-3">
                                <label for="tipo">Tipo</label>
                                <!--<input id="tipo" class="form-control" type="text" name="tipo" placeholder="Tipo" required>-->
                                <select class="form-control" name="tipo" id="tipo">
                                <option value="Mayoreo">Mayoreo</option>
                                <option value="Tecnico">Técnico</option>
                                <option value="Empresa">Empresa</option>
                              </select>
                            </div>
                            <div class="mb-3">
                                <label for="telefono">Teléfono</label>
                                <input id="telefono" class="form-control" type="number" name="telefono" placeholder="Teléfono" required>
                            </div>
                        </div>


                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->

                        <div class="modal-footer">
                            <button id="closeEdit" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>