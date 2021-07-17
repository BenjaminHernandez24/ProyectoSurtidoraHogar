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

                            <i class="nav-icon fas fa-user-edit" style="color:#F29F05; font-size: 30px;"> Editar Cliente</i>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                        </div>

                        <!--=====================================
                        CUERPO DEL MODAL
                        ====================================== -->
                        <div class="modal-body">
                            
                            <label for="nombre">Nombre</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user-tie"></i></span>
                                <input autocomplete="off" class="form-control" type="text" id="nombre" name="nombre" placeholder="Nombre Cliente" required>
                            </div>
                            <label for="tipo">Tipo</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user-friends"></i></span>
                               <select class="form-control" name="tipo" id="tipo">
                                <option value="Mayoreo">Mayoreo</option>
                                <option value="Tecnico">Técnico</option>
                                <option value="Empresa">Empresa</option>
                              </select>
                            </div>
                            <label for="telefono">Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-phone"></i></span>
                                    <input autocomplete="off" class="form-control" type="number" id="telefono" name="telefono" placeholder="Teléfono Cliente" required>
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