
var tablaClientes;
var idClientes;
var datosClientes;
var peticion;
var resjson;
var data;

/* ===============================================
        LLENAMOS LA TABLA CON CLIENTES
   ===============================================*/
async function init(){
    tablaClientes = $("#tblClientes").DataTable({
        "responsive": true,
        "autoWidth" : false,
        "ajax" : {
            "url" : "../Controllers/ClienteController.php",
            "type": "POST",
            "data": {
                "getClientes" : ""
            },
            "dataSrc":""
        },
        "columns" : [
            {"data" : "id_cli"},
            {"data" : "nombre_cli"},
            {"data" : "tipo"},
            {"data" : "telefono"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button id='btnEditar' class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button id='btnBorrar' class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"}
        ]
    });
}

/* ===============================================
        INICIALIZAMOS LA TABLA LLENA DE CLIENTES
   ===============================================*/
init();

/* ===============================================
                DAR UN CLIENTE DE ALTA
   ===============================================*/
frmClientes.addEventListener('submit',async(e) =>{
    e.preventDefault();
    try{
        datosClientes = new FormData(frmClientes);
        datosClientes.append('AgregarCliente','OK');

            peticion = await fetch('../Controllers/ClienteController.php',{
            method : 'POST',
            body: datosClientes
        });

        /* ===============================================
                RECIBO RESPUESTA PARA PODER VALIDAR 
           ===============================================*/
            resjson= await peticion.json();

        if(resjson.respuesta == "OK"){
            notificacionExitosa('Cliente Registrado','nuevo_cliente');
            tablaClientes.ajax.reload(null,false);
        }else if(resjson.respuesta== "existe"){
            notificarError('El Cliente ya ha sido registrado');
        }else{
            notificarError('No se pudo registrar');
        }
        
    }catch(error){
        console.log(error + " CATCH");
    }
})


/* ===============================================
        OBTENER ID CUANDO DA CLICK EN EDITAR
   ===============================================*/     
$(document).on("click", ".btnEditar", function(){
    if(tablaClientes.row(this).child.isShown()){
        data = tablaClientes.row(this).data();
    }else{
        data = tablaClientes.row($(this).parents("tr")).data();
    }

    /* Cargamos los datos obtenidos al modal editar */
    idClientes = data[0];
    $("#nombre").val(data[1]);
    $("#tipo").val(data[2]);
    $("#telefono").val(data[3]);
    /* Hacemos visible el modal */
    $('#modalEditarCategoria').modal('show');          
});

/* ===============================================
       OBTENEMOS FORMULARIO Y CREAMOS UN OBJETO
   ===============================================*/  
formEditCategoria.addEventListener('submit', async (e) =>{
    e.preventDefault();

    try {
        datosClientes = new FormData(formEditCategoria);
        datosClientes.append('editarCliente', 'OK');
        datosClientes.append('idCliente', idClientes);
    
        peticion = await fetch('../Controllers/ClienteController.php', {
        method : 'POST',
        body : datosClientes
        });

        resjson = await peticion.json();

        if(resjson.respuesta == "OK"){
            notificacionExitosa('Cliente Modificado','modalEditarCategoria');
            tablaClientes.ajax.reload(null, false);
        }else{
            notificarError(resjson.respuesta);
        }
        
    } catch (error) {
        console.log(error);
    }
})

/* ===============================================
                OBTENER ID Y ELIMINAR
   ===============================================*/    
$(document).on('click', ".btnBorrar", async function() {

    if(tablaClientes.row(this).child.isShown()){
        data = tablaClientes.row(this).data();
    }else{
        data = tablaClientes.row($(this).parents("tr")).data();
    }

    idClientes = data[0];

    const result = await Swal.fire({
        title: '¿ESTÁ SEGURO DE ELIMINAR ESTE CLIENTE?',
        text: "¡La eliminación es permanente!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#5bc0de',
        cancelButtonColor: '#d9534f',
        confirmButtonText: '¡Estoy seguro!'
    });

    if(result.value){
        try {

            datosClientes = new FormData();
            datosClientes.append('eliminarCliente', 'OK');
            datosClientes.append('idCliente', idClientes);
        
            var peticion = await fetch('../Controllers/ClienteController.php', {
                method : 'POST',
                body : datosClientes
            });
    
            resjson = await peticion.json();
    
            if(resjson.respuesta == "OK"){
                notificacionExitosa('¡Cliente eliminado correctamente!','nuevo_cliente');
                tablaClientes.ajax.reload(null, false);
            }else{
                notificarError(resjson.respuesta);
            }
            
        } catch (error) {
            console.log(error);
        }
    }
    
})

/* ===============================================
            MENSAJES DE NOTIFICACIÓN
   ===============================================*/
function notificacionExitosa(mensaje,formulario){
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        frmClientes.reset();
        $("#"+formulario).modal("hide");
    });
}

function notificarError(mensaje){
    Swal.fire({
        icon: 'error',
        title: 'Ops...',
        text: mensaje
   })
}

/* Limpiar campos del formulario agregar Proveedor */
document.getElementById('altaCliente').addEventListener('click', () => {
    frmClientes.reset();
})
