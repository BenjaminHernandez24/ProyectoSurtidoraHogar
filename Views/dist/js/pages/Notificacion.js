 var j = 0;
 var dataUno = 0;
 var ciclo;
 var condicion = 1;
 var contador = 0;

async function verNotificaciones(view = '')
 {
  $.ajax({
   url:"../Controllers/NotificacionController.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('#menu').html(data.lista);
   }
  });
 }

async function numeroNotificaciones(view = '')
 {
  $.ajax({
   url:"../Controllers/NotificacionController.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    if(data.totalNotificacion > 0){
      $('#contador').html(data.totalNotificacion); //Mostramos el numero que hay
    }
   }
  });
 }

async function tablaNotificaciones(){
    tablaNotificacion = $("#tblNotificacion").DataTable({
        "responsive": true,
        "autoWidth": false,
        "ajax": {
            "url": "../Controllers/NotificacionController.php",
            "type": "POST",
            "data": {
                "getNotificacion": ""
            },
            "dataSrc": ""
        },
        "columns": [{
            "data": "titulo"
        }, {
            "data": "descripcion"
        }, {
            "data": "producto"
        }, {
            "data": "recomendacion"
        }]
    });
}

async function notificacionesNuevas() //¿Ya dió click anteriormente?
 {
  $.ajax({
   url:"../Controllers/NotificacionController.php",
   method:"POST",
   data:'validarBoton',
   dataType:"json",
   success:function(data)
   {
    if(data.valor == 0){ //Si no a dado click, muestrame el numerito. 
        numeroNotificaciones();
    }else{ //De lo contrario, vamos a revisar si las notificaciones son iguales
           //A la que estan en la bd notificaciones.
           //
        ciclo = setInterval(function(){ 
          comprobarCambios();
         }, 2500);
    }
   }
  });
 }

async function comprobarCambios()
 {
  $.ajax({
   url:"../Controllers/NotificacionController.php",
   method:"POST",
   data:'prueba',
   dataType:"json",
   success:function(data)
   {
    dataUno = data.c; //Dame las notificaciones que tienes.
        $.ajax({
           url:"../Controllers/NotificacionController.php",
           method:"POST",
           data:'validarTotal',
           dataType:"json",
           success:function(data)//Dame la notificacion que tenías con anterioridad.
           {
                if(dataUno == data.total){
                    console.log("NO HAY CAMBIOS");
               }else{ //Si son diferentes, hubo cambios.
                    condicion = 0;
                    numeroNotificaciones();
                    verNotificaciones();
                    LlamarNotificacion(0);
               }
            }
          });
   }
  });
 }

function LlamarNotificacion(numero) {
    contador++;
    if(numero === 0 && contador===1){
        Push.create("USTED TIENE UN MENSAJE NUEVO",{
        body: "VERIFIQUE EL CONTENIDO DE SUS NOTIFICACIONES",
        icon: "dist/img/surtidora.png",
        timeout: 10000});
    }else if(numero ===1){
        contador = 0;
    }
}


verNotificaciones();
notificacionesNuevas();

function apretarBotonNotificacion() {
    $('#contador').html('');
    $.ajax({
       url:"../Controllers/NotificacionController.php",
       method:"POST",
       data:'cambiarUno',
       dataType:"json"
    });
    clearInterval(ciclo);
    enviarNumeroNotificacion();//Insertamos el nuevo numero de notificacion.
    notificacionesNuevas();//Reiniciamos...
}

async function enviarNumeroNotificacion(){
    try {
        let datos = new FormData();
        datos.append('enviar_Total', 'OK');
        datos.append('enviar', dataUno);
        let peticion = await fetch('../Controllers/NotificacionController.php', {
            method: 'POST',
            body: datos
        });
    } catch (error) {
        console.log(error);
    }
}

 //Cuando quiera ver todas las notificaciones mostramos el modal
 $(document).on("click", ".btnVer", function() {
        $("#tblNotificacion").DataTable().clear().draw();
        $("#tblNotificacion").DataTable().destroy();
        $("#tituloModal").html('Ver Todas Las Notificaciones');
        tablaNotificaciones();

        $('#modalFrmNotificacion').modal('show');
 });


//Recibo el id del item seleccionado
function prueba(pocision){
        $("#tblNotificacion").DataTable().clear().draw();
        $("#tblNotificacion").DataTable().destroy();
        
    $.ajax({
       url:"../Controllers/NotificacionController.php",
       method:"POST",
       data:'getNotificacion',
       dataType:"json",
       success:function(data)
       {
        $("#tituloModal").html('Notificaciones');
        $('#tblNotificacion').find('tbody').append(`
         <tr id="">
             <td class="row-index">
             <p>${data[pocision]["titulo"]}</p>
             </td>
             <td class="row-index">
             <p>${data[pocision]["descripcion"]}</p>
             </td>
             <td class="row-index">
             <p>${data[pocision]["producto"]}</p>
             </td>
             <td class="row-index">
             <p>${data[pocision]["recomendacion"]}</p>
             </td>
          </tr>`);
        $('#modalFrmNotificacion').modal('show');
       }
    });
}