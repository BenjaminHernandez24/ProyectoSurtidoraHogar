<!-- Modal -->
<div class="modal fade" id="ModalVentasTicket" tabindex="-1" aria-labelledby="ModalVentasTicket" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Generar Ticket/Factura</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <table id="tblVentaDia" class="table table-light">
                            <thead class="thead-light">
                                <tr class="table table-dark">
                                    <th>Cliente</th>
                                    <th>Método Pago</th>
                                    <th>total</th>
                                    <th>Hora</th>
                                    <th>Ticket</th>
                                    <th>Factura</th>
                                    <th>Ambos</th>
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