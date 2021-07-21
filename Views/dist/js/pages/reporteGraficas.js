var columnas= [];
var filas = [];
var pdf;
var fecha = '';
var contador = 0;
var sumaTotal = 0;

async function inicializarGraficasProducto() {
    try{
      let formatoGraficaProducto = new FormData();
      formatoGraficaProducto.append('top5Productos', 'OK');

      let peticion = await fetch('../Controllers/reportesGraficasController.php', {
        method: 'POST',
        body: formatoGraficaProducto
      });

      var respuesta = await peticion.json();
      if(respuesta.parametros !== "F"){
        const $graficaProducto = document.querySelector("#top5Productos");
        const parametros = respuesta.parametros;

        const top5Productos = {
            label: "Productos Más Vendidos",
            data: respuesta.valores,
            fill: false,
            backgroundColor: 'rgb(75, 192, 192)',
            borderColor: 'rgba(2,117,216,1)',
            borderWidth: 1,
            tension: 0.1
        };

        new Chart($graficaProducto, {
            type: 'bar',
            data: {
                labels: parametros,
                datasets: [
                    top5Productos,
                ]
            },
            options: {
              legend: { 
                display: true,
                position: 'top',
                labels: {
                    fontSize: 15,
                    fontColor: "#000000",
                }
              },
                scales: {
                  xAxes:[{
                    display:true,
                    ticks:{
                      autoSkip: false,
                      maxRotation: 0,
                      minRotation: 0,
                      maxTicksLimit: 200,
                      fontSize: 11.5,
                      fontColor: "#000000",
                    },
                    scaleLabel:{
                        display: true,
                        labelString: 'Productos',
                        fontSize: 15,
                        fontColor: "#000000",
                      }
                  }],
                  yAxes: [{
                      ticks: {
                          beginAtZero: true,
                          stepSize : 10,
                          fontSize: 13,
                          fontColor: "#000000",
                      },
                      scaleLabel:{
                        display: true,
                        labelString: 'Piezas',
                        fontSize: 15,
                        fontColor: "#000000",
                      }
                  }],
                },
            }
        });
      }
    } catch (error) {
        console.log(error);
    }
}

inicializarGraficasProducto();

function reporteComprasGeneral(datos,fechas,imagen){
  pdf = new jsPDF();
  pdf.setFontSize(18);
  pdf.text(7,12,"Reporte De Compras General");
  propiedadImagen(imagen);

  $.ajax({
    url:"../Controllers/reportesGraficasController.php",
    method:"POST",
    data:datos,
    dataType:"json",
    success:function(data)
    { 
      if(data.length != 0){ //¿Está vacío?
        if(fechas.length == 2){ //¿Es de rango o unico?
          pdf.setFontSize(12);
          pdf.text(7,22,"Fecha Inicial: " + fechas[0] + "."); //Fecha seleccionada.
          pdf.setFontSize(12);
          pdf.text(7,30,"Fecha Final: "+ fechas[1] + "."); //Fecha seleccionada.
          sumaTotalPagina(data,38);
        }else{
          pdf.setFontSize(12);
          pdf.text(7,22,"Fecha: " + fechas + "."); //Fecha seleccionada.
          pdf.setFontSize(12);
          sumaTotalPagina(data,30);
        }

        espacioFilas(5);
        var lista = new Array();
        for(var i = 0; i < data.length; i++){
          lista.splice(0,lista.length);
          fecha = data[i]["fecha"];
          for(var j = i; j < data.length; j++){
            if(fecha === data[j]["fecha"]){
              contador++;
              lista.push([data[j]["proveedor"],data[j]["producto"],data[j]["piezas"],"$ " + data[j]["precio_unitario"],"$ " + data[j]["subtotal"],data[j]["fecha"],data[j]["hora"]]);
            }
          }

          cabeceraFecha(data[i]["fecha"]);
          columns = ["Proveedor", "Producto", "Piezas", "Precio C/U", "Subtotal", "Fecha", "Hora"];
          guardarDatoDeFila(columns, lista);
          
          i = i + (contador-1);
          contador = 0;
        }
        pieDePagina();
        pdf.save('ReporteComprasGeneral.pdf');
        reporteCreado("Reporte Generado Con Éxito");
        $('#modalFrmReportesComprasGenerales').modal('hide');
        limpiarVariables();
      }else{
          notificacionNoEncontrado('No se pudo generar el reporte, porque no hubo alguna compra');
      }
    }
  });
}

function reporteComprasEspecifico(datos,fechas,imagen){
  pdf = new jsPDF();
  pdf.setFontSize(18);
  pdf.text(7,12,"Reporte De Compras Específico");
  propiedadImagen(imagen);

  $.ajax({
    url:"../Controllers/reportesGraficasController.php",
    method:"POST",
    data:datos,
    dataType:"json",
    success:function(data)
    {
      if(data.length != 0){ //¿Está vacío?
        if(fechas.length > 2){ //¿Es de rango o unico?
            pdf.setFontSize(12);
            pdf.text(7,22,"Nombre del proveedor: " + fechas[2]); //Fecha seleccionada
            pdf.setFontSize(12);
            pdf.text(7,30,"Fecha Inicial: " + fechas[0] + "."); //Fecha seleccionada.
            pdf.setFontSize(12);
            pdf.text(7,38,"Fecha Final: "+ fechas[1] + "."); //Fecha seleccionada.
            sumaTotalPagina(data,46);
          }else{
            pdf.setFontSize(12);
            pdf.text(7,22,"Nombre del proveedor: " + fechas[1]); //Fecha seleccionada
            pdf.setFontSize(12);
            pdf.text(7,30,"Fecha: " + fechas[0] + "."); //Fecha seleccionada.
            pdf.setFontSize(12);
            sumaTotalPagina(data,38);
          }

        espacioFilas(5);
        lista = new Array();
        for(var i = 0; i < data.length; i++){
          lista.splice(0,lista.length);
          fecha = data[i]["fecha"];
          for(var j = i; j < data.length; j++){
            if(fecha === data[j]["fecha"]){
              contador++;
              lista.push([data[j]["producto"],data[j]["piezas"],"$ " + data[j]["precio_unitario"],"$ " + data[j]["subtotal"],data[j]["fecha"],data[j]["hora"]]);
            }
          }

          cabeceraFecha(data[i]["fecha"]);
          columns = ["Producto", "Piezas", "Precio C/U", "Subtotal", "Fecha", "Hora"];
          guardarDatoDeFila(columns,lista);
          
          i = i + (contador-1);
          contador = 0;
        }
        pieDePagina();
        if(fechas.length > 2){
          pdf.save('ComprasProveedor' + fechas[2]);
        }else{
          pdf.save('ComprasProveedor' + fechas[1]);
        }
        reporteCreado("Reporte Generado Con Éxito");
        $('#modalFrmReportesComprasEspecificas').modal('hide');
        limpiarVariables();
      }else{
        notificacionNoEncontrado('No se pudo generar el reporte, porque no hubo alguna venta');
      }
    }
  });
}

function reporteVentas(datos,fechas,imagen){
  pdf = new jsPDF();
  pdf.setFontSize(18);
  pdf.text(7,12,"Reporte De Ventas Totales");
  propiedadImagen(imagen);

  $.ajax({
    url:"../Controllers/reportesGraficasController.php",
    method:"POST",
    data:datos,
    dataType:"json",
    success:function(data)
    { 
      if(data.length != 0){ //¿Está vacío?
        var lista = new Array();
        var lista2 = new Array();
        var lista3 = new Array();
        var cliente = "";
        var nueva_lista = [];
        let variable = [];
        var contador2 = 0;
        var contadorCliente= 0;
        var contadorSumaDia = 0;
        var contadorSumaTotales = 0;

        if(fechas.length == 2){ //¿Es de rango o unico?
            pdf.setFontSize(12);
            pdf.text(7,22,"Fecha Inicial: " + fechas[0] + "."); //Fecha seleccionada.
            pdf.setFontSize(12);
            pdf.text(7,30,"Fecha Final: "+ fechas[1] + "."); //Fecha seleccionada.
            sumaTotalPaginaVentas(data,38,contadorCliente,contadorSumaTotales);
        }else{
            pdf.setFontSize(12);
            pdf.text(7,22,"Fecha: " + fechas + "."); //Fecha seleccionada.
            pdf.setFontSize(12);
            sumaTotalPaginaVentas(data,30,contadorCliente,contadorSumaTotales);
        }

          espacioFilas(5);
          for(var i = 0; i < data.length; i++){
            lista.splice(0, data.length);
            contadorSumaDia = 0;
            fecha = data[i]["fecha"];

            cabeceraFecha(data[i]["fecha"]);
            columns = ["Cliente", "Producto", "Piezas", "Precio", "Subtotal", "Fecha", "Hora", "Total"];
            
            //Separamos Ventas Por Dìas...
            for(var j = i; j < data.length; j++){
              if(fecha === data[j]["fecha"]){
                lista[j] = { 
                  "venta": data[j]["venta"],
                  "cliente": data[j]["cliente"],
                  "producto": data[j]["producto"],
                  "piezas": data[j]["piezas"],
                  "precio": data[j]["precio_pub"],
                  "subtotal": data[j]["subtotal"],
                  "fecha": data[j]["fecha"],
                  "hora": data[j]["hora"],
                  "total": data[j]["total"]
                };
                contador++;
              }
            }

            //Separo Ventas Por Salidas...
            cliente = "";
            nueva_lista = [];
            nueva_lista = Object.values(lista);

            for(var k = 0; k < nueva_lista.length; k++){
              lista2.splice(0, lista2.length);
              cliente = nueva_lista[k]["venta"];
              
              for(var m = k; m < nueva_lista.length; m++){
                if(cliente == nueva_lista[m]["venta"]){
                  lista2[m] = { 
                  "cliente": nueva_lista[m]["cliente"],
                  "producto": nueva_lista[m]["producto"],
                  "piezas": nueva_lista[m]["piezas"],
                  "precio": nueva_lista[m]["precio"],
                  "subtotal": nueva_lista[m]["subtotal"],
                  "fecha": nueva_lista[m]["fecha"],
                  "hora": nueva_lista[m]["hora"],
                  "total": nueva_lista[m]["total"]
                  };
                  contador2++;
                }else{
                  break;
                }
              }

              if(contador2 != 0){ //¿A cuantos les vendí?
                contadorCliente++;
              }

              variable = [];
              variable = Object.values(lista2);
              for(var n = 0; n < variable.length; n++){
                if(n == 0){
                  if(variable.length < 2){
                    lista3.push([variable[n]["cliente"],variable[n]["producto"],variable[n]["piezas"],"$ " + variable[n]["precio"],"$ " + variable[n]["subtotal"],variable[n]["fecha"],variable[n]["hora"],"$ " + variable[n]["total"]]);
                    contadorSumaTotales = contadorSumaTotales + parseFloat(variable[n]["total"]);
                    contadorSumaDia = contadorSumaDia + parseFloat(variable[n]["total"]);
                    break;
                  }else{
                    lista3.push([variable[n]["cliente"],variable[n]["producto"],variable[n]["piezas"],"$ " + variable[n]["precio"],"$ " + variable[n]["subtotal"],variable[n]["fecha"],variable[n]["hora"]]);
                  }
                }else{
                  if(n == variable.length-1){
                    lista3.push(["",variable[n]["producto"],variable[n]["piezas"],"$ " + variable[n]["precio"],"$ " + variable[n]["subtotal"],variable[n]["fecha"],variable[n]["hora"],"$ " + variable[n]["total"]]);
                    contadorSumaTotales = contadorSumaTotales + parseFloat(variable[n]["total"]);
                    contadorSumaDia = contadorSumaDia + parseFloat(variable[n]["total"]);
                  }else{
                    lista3.push(["",variable[n]["producto"],variable[n]["piezas"],"$ " + variable[n]["precio"],"$ " + variable[n]["subtotal"],variable[n]["fecha"],variable[n]["hora"]]);
                  }
                }
              }
                k = k + (contador2-1);
                contador2 = 0;
            }

            lista3.push(["","","","","","","Total de ventas","$ " + contadorSumaDia]);
            
            contadorSumaDia = 0;
            guardarDatoDeFila(columns, lista3);
            lista3.splice(0, lista3.length);
            i = i + (contador-1);
            contador = 0;
          }
          contadorCliente = 0;
          contadorSumaTotales = 0;
          pieDePagina();
          pdf.save('ReporteVentasTotales.pdf');
          reporteCreado("Reporte Generado Con Éxito");
          $('#modalFrmReportesVentas').modal('hide');
          limpiarVariables();
        }else{
        notificacionNoEncontrado('No se pudo generar el reporte, porque no hubo alguna venta');
        }
    }
  });
}

function reporteImpresiones(datos,fechas,imagen){
  pdf = new jsPDF();
  pdf.setFontSize(18);
  pdf.text(7,12,"Reporte De Ventas Totales");

  var tipo = "";
  switch(datos["impresion"]){
    case 1:
      pdf.text(7,12,"Reporte De Ventas Por Ticket");
      tipo = " Ticket";
    break;
    case 2:
      pdf.text(7,12,"Reporte De Ventas Por Factura");
      tipo = " Factura";
    break;
    case 3:
      pdf.text(7,12,"Reporte De Ventas Por Factura Y Ticket");
      tipo = " Factura Y Ticket";
    break;
    case 4:
    pdf.text(7,12,"Reporte De Ventas Sin Ticket o Factura");
      tipo = " Sin FacturaYTicket";
    break;
  }
  propiedadImagen(imagen);
  $.ajax({
    url:"../Controllers/reportesGraficasController.php",
    method:"POST",
    data:datos,
    dataType:"json",
    success:function(data)
    { 
      if(data.length != 0){ //¿Está vacío?
        var lista = new Array();
        var lista2 = new Array();
        var lista3 = new Array();
        var cliente = "";
        var nueva_lista = [];
        let variable = [];
        var contador2 = 0;
        var contadorCliente= 0;
        var contadorSumaDia = 0;
        var contadorSumaTotales = 0;

        if(fechas.length == 2){ //¿Es de rango o unico?
            pdf.setFontSize(12);
            pdf.text(7,22,"Fecha Inicial: " + fechas[0] + "."); //Fecha seleccionada.
            pdf.setFontSize(12);
            pdf.text(7,30,"Fecha Final: "+ fechas[1] + "."); //Fecha seleccionada.
            sumaTotalPaginaVentas(data,38,contadorCliente,contadorSumaTotales);
        }else{
            pdf.setFontSize(12);
            pdf.text(7,22,"Fecha: " + fechas + "."); //Fecha seleccionada.
            pdf.setFontSize(12);
            sumaTotalPaginaVentas(data,30,contadorCliente,contadorSumaTotales);
        }

          espacioFilas(5);
          for(var i = 0; i < data.length; i++){
            lista.splice(0, data.length);
            contadorSumaDia = 0;
            fecha = data[i]["fecha"];

            cabeceraFecha(data[i]["fecha"]);
            columns = ["Cliente", "Fecha", "Hora", "Total"];
            
            //Separamos Ventas Por Dìas...
            for(var j = i; j < data.length; j++){
              if(fecha === data[j]["fecha"]){
                lista[j] = { 
                  "cliente": data[j]["cliente"],
                  "fecha": data[j]["fecha"],
                  "hora": data[j]["hora"],
                  "total": data[j]["total"]
                };
                contador++;
              }
            }

            for(var n = 0; n < lista.length; n++){
              lista2.push([lista[n]["cliente"],lista[n]["fecha"],lista[n]["hora"],lista[n]["total"]]);
              contadorSumaDia += lista[n]["total"];
            }

            lista2.push("","","Total Venta Día: ",contadorSumaDia);
            contadorSumaDia = 0;
            guardarDatoDeFila(columns, lista);
            i = i + (contador-1);
            contador = 0;
          }
          pieDePagina();
          pdf.save('ReporteVentasTotales.pdf');
        }else{
        notificacionNoEncontrado('No se pudo generar el reporte, porque no hubo alguna venta');
        }
    }
  });
}

function getBase64Image(img) {
  var canvas = document.createElement("canvas");
  canvas.width = img.width;
  canvas.height = img.height;
  var ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0);
  var dataURL = canvas.toDataURL();
  return dataURL;
}

function propiedadImagen(imagen){
  //Definimos Linea Horizontal debajo
  pdf.setLineWidth(0.6);
  pdf.line(5, 15, 113, 15);

  //Imagen La Surtidora Del Hogar
  var base64 = getBase64Image(imagen);
  pdf.addImage(base64, 'PNG', 157, 5.5,42,27);

  pdf.setFontSize(10);
  pdf.text(160,37,"Avenida Central Norte"); 

  pdf.setFontSize(10);
  pdf.text(155,42,"Ref. Calle Primera Poniente"); 

  pdf.setFontSize(10);
  pdf.text(150,47,"Calle Tercera Poniente, Avenida"); 

  pdf.setFontSize(10);
  pdf.text(155,52,"Segunda Norte. CP. 30700.");

  pdf.setFontSize(10);
  pdf.text(162,57,"Tapachula, Chiapas.");
}

function cabeceraFecha(fecha){
    columns = [];
    pdf.autoTable(columns,filas,
    { 
      margin:{ top: 25  }
    });

    columns = ["Fecha: "+ fecha];
    pdf.autoTable(columns,filas,
    { 
       theme: 'plain',
       styles : {  fillColor : [ 192 ,  192 ,  192]  },
      margin:{ top: 25  },
      headStyles: {fontSize: 12, valign: 'middle'},
      margin: {horizontal: 12},
    });
}

function espacioFilas(numero){
  for( var i = 0; i < numero; i++){
    columns = [];
    pdf.autoTable(columns,filas,
    { 
      margin:{ top: 25  }
    });
  }
}

function guardarDatoDeFila(columns,lista){
  pdf.autoTable(columns,lista,
  {
    margin:{ top: 25 },
    styles: {cellWidth: '100', fontSize: 11.3, cellPadding: 1},
    headStyles: {fontSize: 11.3, valign: 'middle',halign: 'center',fillColor : [ 255 ,  127 ,  0] },
    bodyStyles: {minCellHeight: 10.2, fontSize: 11.3, valign: 'middle', halign: 'center',textColor : [ 0 ,  0 ,  0]},
    margin: {horizontal: 12, top:10, bottom:20},
    columnStyles: { 
      0: { halign: 'center',cellWidth:32} ,
      1: { halign: 'center',cellWidth:32},
    },
  });
}

function sumaTotalPagina(data,pocision){
  var sumaTotal = 0;
  for(var i = 0; i < data.length; i++){
    sumaTotal = sumaTotal + parseFloat(data[i]["subtotal"]);
  }

  pdf.setFontSize(12.2);
  pdf.text(7,pocision,"Productos comprados: " + data.length + ".");
  pocision = pocision + 8;
  pdf.text(7,pocision,"Total de gastos: $" + sumaTotal + " pesos.");
  pocision = 0;
}

function sumaTotalPaginaVentas(data,pocision,clientes,total){
  var lista = new Array();
  var lista2 = new Array();
  var cliente = "";
  var contadorCliente = 0;
  var contadorSumaTotales = 0;
  var nueva_lista = [];
  let variable = [];
  var contador2 = 0;

  for(var i = 0; i < data.length; i++){
    lista.splice(0, data.length);
    contadorSumaDia = 0;
    var fecha = data[i]["fecha"];

    //Separamos Ventas Por Dìas...
    for(var j = i; j < data.length; j++){
      if(fecha === data[j]["fecha"]){
        lista[j] = { 
          "venta": data[j]["venta"],
          "total": data[j]["total"]
        };
        contador++;
      }
    }

    //Separo Ventas Por Salidas...
    cliente = "";
    nueva_lista = [];
    nueva_lista = Object.values(lista);
    for(var k = 0; k < nueva_lista.length; k++){
      lista2.splice(0, lista2.length);
      cliente = nueva_lista[k]["venta"];
      
      for(var m = k; m < nueva_lista.length; m++){
        if(cliente == nueva_lista[m]["venta"]){
          lista2[m] = { 
          "total": nueva_lista[m]["total"]
          };
          contador2++;
        }else{
          break;
        }
      }

      if(contador2 != 0){ //¿A cuantos les vendí?
        contadorCliente++;
      }

      variable = [];
      variable = Object.values(lista2);
      for(var n = 0; n < variable.length; n++){
        if(n == 0){
          if(variable.length < 2){
            contadorSumaTotales = contadorSumaTotales + parseFloat(variable[n]["total"]);
            break;
          }
        }else{
          if(n == variable.length-1){
            contadorSumaTotales = contadorSumaTotales + parseFloat(variable[n]["total"]);
          }
        }
      }
        k = k + (contador2-1);
        contador2 = 0;
    }
      i = i + (contador-1);
      contador = 0;
  }
          
  var sumaTotal = 0;
  var productosVendidos = 0;
  for(var i = 0; i < data.length; i++){
    sumaTotal = sumaTotal + parseFloat(data[i]["total"]);
  }

  for(var i = 0; i < data.length; i++){
    productosVendidos = productosVendidos + parseFloat(data[i]["piezas"]);
  }

  pdf.setFontSize(12.2);
  pdf.text(7,pocision,"Numero de Ventas: " + contadorCliente + ".");
  pocision = pocision + 8;
  pdf.setFontSize(12.2);
  pdf.text(7,pocision,"Productos vendidos: " + productosVendidos + ".");
  pocision = pocision + 8;
  pdf.text(7,pocision,"Total de ventas: $" + contadorSumaTotales + " pesos.");
  pocision = 0;
}

function pieDePagina(){
  const pageCount = pdf.internal.getNumberOfPages();
  // For each page, print the page number and the total pages
  for(var i = 1; i <= pageCount; i++) {
    //Marco de Pagina
    pdf.setLineWidth(0.8);
    pdf.rect(5, 5, 200, 288);
    // Go to page i
    pdf.setPage(i);
     //Print Page 1 of 4 for example
    pdf.setFontSize(10);
    pdf.setFont("times");
    pdf.setFontType("italic");
    pdf.text('Página ' + String(i),210-15,297-15,null,null,"right");
  }
}

 /*======================================
                REPORTE 1
   ======================================*/
$(document).ready(async function() {
    try {
        var productos = new FormData();
        productos.append('obtenerProductos', 'OK');

        var peticion = await fetch('../Controllers/reportesGraficasController.php', {
            method: 'POST',
            body: productos
        });
        var dato = await peticion.json();
        if(dato[0] !== "F"){
          $('#buscar').autocomplete({
              source: dato,
              select: async function(event, item) {
              
              var datosProveedor = {
              'datosProveedor': 'OK',
              'valor': item.item.value
              };

              $.ajax({
                url:"../Controllers/reportesGraficasController.php",
                method:"POST",
                data: datosProveedor,
                dataType:"json",
                success:function(data)
                {
                  $("#tblReportesGraficasProductos").DataTable().clear().draw();
                  $("#tblReportesGraficasProductos").DataTable().destroy();
                  if(data.length != 0){
                      $('#tblReportesGraficasProductos').find('tbody').append(`
                       <tr id="" height="75%">
                           <td class="row-index">
                           <p>${data[0]["proveedor"]}</p>
                           </td>
                           <td class="row-index">
                           <p>${item.item.value}</p>
                           </td>
                           <td class="row-index text-center" width="10%">
                           <p>${data[0]["precio"]}</p>
                           </td>
                           <td class="row-index text-center" width="25%">
                           <p>${data[0]["fecha"]}</p>
                           </td>
                        </tr>`);
                    }else{
                        notificacionNoEncontrado("Aún No Se Han Hecho Compras De Este Producto");
                    }
                    document.getElementById("buscar").value = "";
                  }
                });
              }
                  
          });
        }
    } catch (error) {
        console.log(error);
    }
});

/*Al abrir el modal, escondemos las dos fechas*/
$("#reporteGeneral").click(function(){
  limpiarVariables();
  $('#modalFrmReportesComprasGenerales').modal('show');
  document.getElementById("img1").style.display='none';
  document.getElementById("fecha_unica").style.display='block';
  document.getElementById("fechas").style.display = 'none';
});

document.querySelector("#seleccion").addEventListener('change', esconder_Mostrar_Fechas);

function esconder_Mostrar_Fechas(){
  var SeleccionDeFechas = document.querySelector("#seleccion").value;
  if(SeleccionDeFechas == 2){
    document.getElementById("fechas").style.display = 'block';
    document.getElementById("fecha_unica").style.display='none';
  }else{
    document.getElementById("fecha_unica").style.display = 'block';
    document.getElementById("fechas").style.display = 'none';
  }
}

/*Si apreta el boton de generar reporte*/
$("#Generar").click(function(){
  var imagen = document.getElementById("img1");
  var SeleccionDeFechas = document.querySelector("#seleccion").value;
  if(SeleccionDeFechas == 2){
    var fecha_inicio = document.getElementById("inicio").value;
    var fecha_final = document.getElementById("final").value;

    if(fecha_inicio === "" || fecha_final === ""){
      notificacionNoEncontrado("Seleccione fechas en ambas casillas");
    }else{
      var datosReportes = {
      'getComprasGeneralesRango': 'OK',
      'fecha_inicial': fecha_inicio,
      'fecha_final' : fecha_final
      };

      var fechas = [fecha_inicio,fecha_final];
      reporteComprasGeneral(datosReportes, fechas, imagen);
    }
  }else{
    var fecha = document.getElementById("unique").value;
    if(fecha === ""){
      notificacionNoEncontrado("Seleccione una fecha");
    }else{
      var datosReportes = {
      'getComprasGeneralesUnicas': 'OK',
      'fecha': fecha,
      };
      reporteComprasGeneral(datosReportes, fecha, imagen);
    }
  }
});


/* ======================================
                REPORTE 2
   ======================================*/
$(document).ready(async function() {
  try {
      var proveedor = new FormData();
      proveedor.append('obtenerProveedor', 'OK');

      var peticion = await fetch('../Controllers/reportesGraficasController.php', {
          method: 'POST',
          body: proveedor
      });
      var dato = await peticion.json();
      if(dato[0] !== "F"){
        $("#buscarProveedor").autocomplete({
            source: dato,
        });
      }
  } catch (error) {
      console.log(error);
  }
});

$("#reporteGeneralPorProveedor").click(function(){
  limpiarVariables();
  $('#modalFrmReportesComprasEspecificas').modal('show');
  document.getElementById("img2").style.display='none';
  document.getElementById("fecha_unica_Prov").style.display='block';
  document.getElementById("fechas_Prov").style.display = 'none';
});


document.querySelector("#seleccionReporte2").addEventListener('change', capturarValorReporte2);

function capturarValorReporte2(){
  var SeleccionDeFechas = document.querySelector("#seleccionReporte2").value;
  if(SeleccionDeFechas == 2){
    document.getElementById("fechas_Prov").style.display = 'block';
    document.getElementById("fecha_unica_Prov").style.display='none';
  }else{
    document.getElementById("fecha_unica_Prov").style.display = 'block';
    document.getElementById("fechas_Prov").style.display = 'none';
  }
}


$("#GenerarReporte2").click(function(){
  var imagen = document.getElementById("img2");
  var SeleccionDeFechas = document.querySelector("#seleccionReporte2").value;
  if($('#buscarProveedor').val() === ""){
    notificacionNoEncontrado('Por favor, Seleccione un proveedor');
  }else{
    if(SeleccionDeFechas == 2){
      var fecha_inicial = document.getElementById("inicioProv").value;
      var fecha_final = document.getElementById("finalProv").value;

      if(fecha_inicial === "" || fecha_final === ""){
        notificacionNoEncontrado("Seleccione fechas en ambas casillas");
      }else{
        var datosProveedor = {
          'getComprasEspecificoRango': 'OK',
          'fecha_inicial': fecha_inicial,
          'fecha_final' : fecha_final,
          'proveedor' : $('#buscarProveedor').val()
          };

          var fecha = [fecha_inicial,fecha_final,$('#buscarProveedor').val()];
          reporteComprasEspecifico(datosProveedor,fecha,imagen);
        }
    }else{
      var fecha = document.getElementById("uniqueProv").value;
      if(fecha === ""){
        notificacionNoEncontrado("Seleccione una fecha");
      }else{
        var datosProveedor = {
        'getComprasEspecificoUnico': 'OK',
        'fecha': fecha,
        'proveedor' : $('#buscarProveedor').val()
        };
        var enviar = [fecha,$('#buscarProveedor').val()];
        reporteComprasEspecifico(datosProveedor, enviar, imagen);
      }
    }
  }
});

/* ======================================
                REPORTE 3
   ======================================*/
$("#reporteGeneralVentas").click(function(){
  limpiarVariables();
  $('#modalFrmReportesVentas').modal('show');
  document.getElementById("img3").style.display="none";
  document.getElementById("fecha_unica_Ventas").style.display='block';
  document.getElementById("fechas_Ventas").style.display = 'none';
});

document.querySelector("#seleccion_Ventas").addEventListener('change', capturarReporteVentas);

function capturarReporteVentas(){
  var SeleccionDeFechas = document.querySelector("#seleccion_Ventas").value;
  if(SeleccionDeFechas == 2){
    document.getElementById("fechas_Ventas").style.display = 'block';
    document.getElementById("fecha_unica_Ventas").style.display='none';
  }else{
    document.getElementById("fecha_unica_Ventas").style.display = 'block';
    document.getElementById("fechas_Ventas").style.display = 'none';
  }
}

/*Si apreta el boton de generar reporte*/
$("#Generar_Ventas").click(function(){
  var imagen = document.getElementById("img3");
  var SeleccionDeFechas = document.querySelector("#seleccion_Ventas").value;
  if(SeleccionDeFechas == 2){
    var fecha_inicio = document.getElementById("inicio_Ventas").value;
    var fecha_final = document.getElementById("final_Ventas").value;

    if(fecha_inicio === "" || fecha_final === ""){
      notificacionNoEncontrado("Seleccione fechas en ambas casillas");
    }else{
      var datosReportes = {
      'getVentasRango': 'OK',
      'fecha_inicial': fecha_inicio,
      'fecha_final' : fecha_final
      };

      var fechas = [fecha_inicio,fecha_final];
      reporteVentas(datosReportes, fechas,imagen);
    }
  }else{
    var fecha = document.getElementById("unique_Ventas").value;
    if(fecha === ""){
      notificacionNoEncontrado("Seleccione una fecha");
    }else{
      var datosReportes = {
      'getVentasUnicas': 'OK',
      'fecha': fecha,
      };
      reporteVentas(datosReportes, fecha, imagen);
    }
  }
});

/* ======================================
                REPORTE 4
   ======================================*/
$("#reporteGeneralImpresion").click(function(){
  limpiarVariables();
  $('#modalFrmReportesImpresiones').modal('show');
  document.getElementById("img4").style.display = 'none';
  document.getElementById("fecha_unica_Imp").style.display='block';
  document.getElementById("fechas_Imp").style.display = 'none';
}); 

document.querySelector("#seleccionImpresionFecha").addEventListener('change', capturarReporteImpresion);

function capturarReporteImpresion(){
  var SeleccionDeImpresion = document.querySelector("#seleccionImpresionFecha").value;
  if(SeleccionDeImpresion == 2){
    document.getElementById("fechas_Imp").style.display = 'block';
    document.getElementById("fecha_unica_Imp").style.display='none';
  }else{
    document.getElementById("fecha_unica_Imp").style.display = 'block';
    document.getElementById("fechas_Imp").style.display = 'none';
  }
}  

/*Si apreta el boton de generar reporte*/
$("#GenerarImp").click(function(){
  var imagen = document.getElementById("img4");
  var SeleccionImpresion = document.querySelector("#seleccionImpresion").value;
  var SeleccionDeFechasImp = document.querySelector("#seleccionImpresionFecha").value;

  if(SeleccionDeFechasImp == 2){
    var fecha_inicio = document.getElementById("inicioImp").value;
    var fecha_final = document.getElementById("finalImp").value;

    if(fecha_inicio === "" || fecha_final === ""){
      notificacionNoEncontrado("Seleccione fechas en ambas casillas");
    }else{
      var datosReportes = {
      'getImpresionesRango': 'OK',
      'fecha_inicial': fecha_inicio,
      'fecha_final' : fecha_final,
      'impresion' : SeleccionImpresion
      };

      var fechas = [fecha_inicio,fecha_final];
      reporteImpresiones(datosReportes,fechas,imagen);
    }
  }else{
    var fecha = document.getElementById("uniqueImp").value;
    if(fecha === ""){
      notificacionNoEncontrado("Seleccione una fecha");
    }else{
      var datosReportes = {
      'getImpresionesUnicas': 'OK',
      'fecha': fecha,
      'impresion' : SeleccionImpresion
      };

      reporteImpresiones(datosReportes,fecha,imagen);
    }
  }
});

function limpiarVariables(){
  document.querySelector("#seleccion").value = "1";
  document.getElementById("fecha_unica").value = "";
  document.getElementById("fechas").value = "";
  document.getElementById("inicio").value = "";
  document.getElementById("final").value = "";
  document.getElementById("unique").value = "";

  document.getElementById("buscarProveedor").value = "";
  document.querySelector("#seleccionReporte2").value = "1";
  document.getElementById("fecha_unica_Prov").value = "";
  document.getElementById("fechas_Prov").value = "";
  document.getElementById("inicioProv").value = "";
  document.getElementById("finalProv").value = "";
  document.getElementById("uniqueProv").value = "";

  document.querySelector("#seleccion_Ventas").value = "1";
  document.getElementById("fecha_unica_Ventas").value = "";
  document.getElementById("fechas_Ventas").value = "";
  document.getElementById("inicio_Ventas").value = "";
  document.getElementById("final_Ventas").value = "";
  document.getElementById("unique_Ventas").value = "";

  document.querySelector("#seleccionImpresion").value = "1";
  document.querySelector("#seleccionImpresionFecha").value = "1";
  document.getElementById("fecha_unica_Imp").value = "";
  document.getElementById("fechas_Imp").value = "";
  document.getElementById("inicioImp").value = "";
  document.getElementById("finalImp").value = "";
  document.getElementById("uniqueImp").value = "";
}

function notificacionNoEncontrado(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'warning',
        title: mensaje,
        showConfirmButton: false,
        timer: 2000
    })
}

function reporteCreado(mensaje) {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: mensaje,
        showConfirmButton: false,
        timer: 2000
    })
}