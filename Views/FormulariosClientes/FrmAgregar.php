<!--=====================================
        MODAL AGREGAR NUEVO CLIENTE
        ======================================-->
        <div id="nuevo_cliente" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="frmClientes">
                        <!--=====================================
                        HEADER DEL MODAL
                        ======================================-->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
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
                                <input autocomplete="off" class="form-control" type="text" name="nombre" placeholder="Nombre Cliente" required>
                            </div>
                            <label for="tipo">Tipo</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user-friends"></i></span>
                               <select class="form-control" name="tipo">
                                <option value="Mayoreo">Mayoreo</option>
                                <option value="Tecnico">Técnico</option>
                                <option value="Empresa">Empresa</option>
                              </select>
                            </div>
                            <label for="telefono">Teléfono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fas fa-phone"></i></span>
                                    <input autocomplete="off" class="form-control" type="number" name="telefono" placeholder="Teléfono Cliente" required>
                                </div>
                        </div>

                        <!--=====================================
                        PIE DEL MODAL
                        ======================================-->
                        <div class="modal-footer">
                            <button id="closeCerrar" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>