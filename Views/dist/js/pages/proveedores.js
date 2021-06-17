const formaddCategoria = document.getElementById('frmProveedor');

var tablaProveedores;

async function init(){
    tablaProveedores = $("#tblProveedores").DataTable({
        "responsive": true,
        "autoWidth" : false,
        "ajax" : {
            "url" : "../Controllers/ProveedoresController.php",
            "type": "POST",
            "data": {
                "obtenerProveedores" : "OK"
            },
            "dataSrc":""
        },
        "columns" : [
            {"data" : "id_prov"},
            {"data" : "nom_empresa"},
            {"data" : "tel_empresa"},
            {"data" : "nom_prov"},
            {"data" : "tel_prov"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-info btn-sm btnEditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash-alt'></i></button></div></div>"}
        ]
    });
}

init();

frmProveedor.addEventListener('submit',async(e) =>{
    e.preventDefault();

    try{
        var datosProveedores = new FormData(frmProveedor);
        datosProveedores.append('agregarProveedores','OK');

        var peticion = await fetch('../Controllers/ProveedoresController.php',{
            method : 'POST',
            body: datosProveedores
        });

        var resjson= await peticion.json();

        if(resjson.respuesta == "OK"){
            notificacionExitosa('Alta de Proveedores Exitoso');
            tablaProveedores.ajax.reload(null,false);

        }else{
            notificarError('Ocurrio un Error');
        }
    }catch(error){
        console.log(error);
    }
})

function notificacionExitosa(mensaje){
    Swal.fire(
        mensaje,
        '',
        'success'
    ).then(result => {
        frmProveedor.reset();
        $("#nuevo_proveedor").modal("hide");
        document.getElementById('cerrar').click();
        //document.getElementById('closeEdit').click();
    });
}

function notificarError(mensaje){
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: mensaje
    })
}

/* Limpiar campos del formulario agregar Proveedor */
document.getElementById('altaProveedor').addEventListener('click', () => {
    frmProveedor.reset();
})
