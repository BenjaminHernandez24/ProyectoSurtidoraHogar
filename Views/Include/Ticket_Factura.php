<!-- Modal -->
<div class="modal fade" id="ModalVentasTicket" tabindex="-1" aria-labelledby="ModalVentasTicket" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <i class="nav-icon fas fa-clipboard-list" style="color:#F29F05; font-size: 30px;"> Generar Ticket/Factura</i>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table id="tblImpresion" class="table table-light">
                            <thead class="thead-light">
                                <tr class="table table-dark">
                                    <th>ID Venta</th>
                                    <th>Cliente</th>
                                    <th>Método Pago</th>
                                    <th>total</th>
                                    <th>Hora</th>
                                    <th>Ticket</th>
                                    <th>Factura</th>
                                    <th>Ticket/Factura</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>