
async function grafica_1(){

    let formato = new FormData();
    formato.append('frecuenciaClientes', 'OK');

    let peticion = await fetch('../Controllers/GraficasController.php', {
      method: 'POST',
      body: formato
    });

    let respuesta = await peticion.json();
    if(respuesta.parametros !== "F"){
        grafica_1_Resguardo(respuesta);
    }
}

function grafica_1_Resguardo(respuesta){
    const $grafica = document.querySelector("#frecuenciaDelCliente");
    const parametros = respuesta.parametros;

    const frecuenciaClientes = {
        label: "Compras Realizadas Por El Cliente",
        data: respuesta.valores,
        fill: false,
        backgroundColor: 'rgb(153, 102, 255)',
        borderColor: 'rgb(54, 162, 235)',
        borderWidth: 2.5,
        tension: 0.1,
    };

    new Chart($grafica, {
        type: 'line',
        data: {
            labels: parametros,
            datasets: [
                frecuenciaClientes,
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
                ticks: {
                    autoSkip: false,
                    maxRotation: 0,
                    minRotation: 0,
                    fontSize: 14,
                    fontColor: "#000000",
                },
                scaleLabel:{
                    display: true,
                    labelString: 'Clientes',
                    fontColor: "#000000",
                    fontSize: 15,
                  }
              }],
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      fontSize: 14,
                      fontColor: "#000000",
                      stepSize : 2,
                  },
                  scaleLabel:{
                    display: true,
                    labelString: 'Número De Visitas',
                    fontColor: "#000000",
                    fontSize: 15,
                  }
              }],
            },
        }
    });
}

grafica_1();


async function grafica_2(){

    let formato = new FormData();
    formato.append('ventasTotalesPorMes', 'OK');

    let peticion = await fetch('../Controllers/GraficasController.php', {
      method: 'POST',
      body: formato
    });

    let respuesta = await peticion.json();
    if(respuesta.parametros !== "F"){
        grafica_2_Resguardo(respuesta);
    }
}

function grafica_2_Resguardo(respuesta){
    const $grafica = document.querySelector("#ventasTotalesPorMes");
    const parametros = respuesta.parametros; 

    const ventasPorMes = {
        label: "Ventas Totales Por Mes",
        data: respuesta.valores,
        backgroundColor: 'rgb(75, 192, 192)',
        borderColor: 'rgba(2,117,216,1)',
        borderWidth: 1,
        tension: 0.1,
    };

    new Chart($grafica, {
        type: 'bar',
        data: {
            labels: parametros,
            datasets: [
                ventasPorMes,
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
                ticks:{
                    fontSize: 12,
                    fontColor: "#000000",
                },
                scaleLabel:{
                    display: true,
                    labelString: 'Meses',
                    fontSize: 14,
                    fontColor: "#000000",
                  }
              }],
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      stepSize : 300,
                      fontSize: 14,
                    fontColor: "#000000",
                  },
                  scaleLabel:{
                    display: true,
                    labelString: 'Ventas',
                    fontSize: 15,
                    fontColor: "#000000",
                  }
              }],
            },
        }
    });
}

grafica_2();