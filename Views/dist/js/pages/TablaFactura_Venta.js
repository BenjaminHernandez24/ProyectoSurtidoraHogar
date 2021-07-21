/* FUNCION PARA ABRIR EL MODAL DE LA TABLA DE CLIENTES */
document.getElementById('boton_factura').addEventListener('click', (e) => {
    e.preventDefault();
    $("#ModalVentasTicket").modal("show");
})