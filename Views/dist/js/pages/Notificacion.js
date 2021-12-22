var j = 0;
var dataUno = 0;
var contador = 0;
var filas = [];

async function verNotificaciones(view = '') {
  $.ajax({
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: { view: view },
    dataType: "json",
    success: function (data) {
      $('#menu').html(data.lista);
    }
  });
}

async function numeroNotificaciones(view = '') {
  $.ajax({
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: { view: view },
    dataType: "json",
    success: function (data) {
      if (data.totalNotificacion > 0) {
        $('#contador').html(data.totalNotificacion); //Mostramos el numero que hay
      }
    }
  });
}

async function tablaNotificaciones() {
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
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: 'validarBoton',
    dataType: "json",
    success: function (data) {
      if (data.valor == 0) { //Si no a dado click, muestrame el numerito. 
        numeroNotificaciones();
      } else {
        comprobarCambios();
      }
    }
  });
}

async function comprobarCambios() {
  $.ajax({
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: 'prueba',
    dataType: "json",
    success: function (data) {
      dataUno = data.c; //Dame las notificaciones que tienes.
      $.ajax({
        url: "../Controllers/NotificacionController.php",
        method: "POST",
        data: 'validarTotal',
        dataType: "json",
        success: function (data)//Dame la notificacion que tenías con anterioridad.
        {
          if (dataUno != data.total) {
            numeroNotificaciones();
            verNotificaciones();
            LlamarNotificacion();
          }
        }
      });
    }
  });
}

function LlamarNotificacion() {

  Push.create("USTED TIENE UN MENSAJE NUEVO", {
    body: "VERIFIQUE EL CONTENIDO DE SUS NOTIFICACIONES",
    icon: "dist/img/surtidora.png",
    timeout: 10000
  });
}


verNotificaciones();
notificacionesNuevas();

function apretarBotonNotificacion() {
  $('#contador').html('');
  $.ajax({
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: 'cambiarUno',
    dataType: "json"
  });
  enviarNumeroNotificacion();//Insertamos el nuevo numero de notificacion.
  notificacionesNuevas();//Reiniciamos...
}

async function enviarNumeroNotificacion() {
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
$(document).on("click", ".btnVer", function () {
  $("#tblNotificacion").DataTable().clear().draw();
  $("#tblNotificacion").DataTable().destroy();
  tablaNotificaciones();

  $('#modalFrmNotificacion').modal('show');
});


//Recibo el id del item seleccionado
function prueba(pocision) {
  $("#tblNotificacion").DataTable().clear().draw();
  $("#tblNotificacion").DataTable().destroy();

  $.ajax({
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: 'getNotificacion',
    dataType: "json",
    success: function (data) {
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

//-------------------- REPORTES DE LAS NOTIFICACIONES ------------------------//

function reporteNotificaciones() {
  pdf = new jsPDF();
  pdf.setFontSize(18);
  pdf.text(85, 14, "Notificaciones");
  pdf.setLineWidth(0.6);
  pdf.line(65, 17, 142, 17);
  acomodarFecha();
  espacioFilas(3);
  columns = ["Producto", "Stock"];
  $.ajax({
    url: "../Controllers/NotificacionController.php",
    method: "POST",
    data: 'recibirNombreStock',
    dataType: "json",
    success: function (data) {

      //if(data.length != 0){ //¿Está vacío?

      var lista = new Array();
      for (var i = 0; i < data.length; i++) {
        lista.push([data[i]["nombre"], data[i]["stock"]]);
      }

      guardarDatoDeFila(columns, lista);
      pieDePagina();
      pdf.save('ReporteNotificacion.pdf');
      //reporteCreado("Reporte Generado Con Éxito");
      /*}else{
          //notificacionNoEncontrado('No hay notificaciones previas');
          console.log('No hay notificaciones previas');
      }*/
    }
  });
}

function espacioFilas(numero) {
  for (var i = 0; i < numero; i++) {
    columns = [];
    pdf.autoTable(columns, filas,
      {
        margin: { top: 15 }
      });
  }
}

function guardarDatoDeFila(columns, lista) {
  pdf.autoTable(columns, lista,
    {
      rowPageBreak: 'avoid',
      styles: { cellWidth: '100', fontSize: 11.3, cellPadding: 1 },
      headStyles: { fontSize: 13.3, valign: 'middle', halign: 'center', fillColor: [255, 127, 0] },
      bodyStyles: { minCellHeight: 11.2, fontSize: 13.3, valign: 'middle', halign: 'center', textColor: [0, 0, 0] },
      margin: { horizontal: 47, top: 10, bottom: 14 },
      columnStyles: {
        0: { halign: 'center', cellWidth: 57 },
        1: { halign: 'center', cellWidth: 57 },
      },
    });
}

function pieDePagina() {
  const pageCount = pdf.internal.getNumberOfPages();
  // For each page, print the page number and the total pages
  for (var i = 1; i <= pageCount; i++) {
    //Marco de Pagina
    pdf.setLineWidth(0.8);
    pdf.rect(5, 5, 200, 288);
    // Go to page i
    pdf.setPage(i);
    //Print Page 1 of 4 for example
    pdf.setFontSize(10);
    pdf.setFont("times");
    pdf.setFontType("italic");
    pdf.text('Página ' + String(i), 210 - 15, 297 - 15, null, null, "right");
  }
}

function acomodarFecha() {
  var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  var diasSemana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
  var f = new Date();
  var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear() + ".";
  pdf.setFontSize(14);
  pdf.text(49, 28, fecha);

  var hora = f.getHours();
  var minuto = f.getMinutes();
  var segundo = f.getSeconds();
  var temp = '' + ((hora > 12) ? hora - 12 : hora);
  if (hora == 0)
    temp = '12';
  temp += ((minuto < 10) ? ':0' : ':') + minuto;
  temp += ((segundo < 10) ? ':0' : ':') + segundo;
  temp += (hora >= 12) ? ' P.M.' : ' A.M.';

  pdf.setFontSize(14);
  pdf.text(131, 28, temp);
}