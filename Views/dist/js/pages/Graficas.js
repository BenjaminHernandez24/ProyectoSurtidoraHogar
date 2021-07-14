
(async () => {

    let formato = new FormData();
    formato.append('frecuenciaClientes', 'OK');

    let peticion = await fetch('../Controllers/GraficasController.php', {
      method: 'POST',
      body: formato
    });

    let respuesta = await peticion.json();

    const $grafica = document.querySelector("#frecuenciaDelCliente");
    const parametros = respuesta.parametros;

    const frecuenciaClientes = {
        label: "Compras Realizadas Por El Cliente",
        data: respuesta.valores,
        fill: false,
        backgroundColor: 'rgb(153, 102, 255)',
        borderColor: 'rgb(54, 162, 235)',
        borderWidth: 2,
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
            scales: {
              xAxes:[{
                scaleLabel:{
                    display: true,
                    labelString: 'Clientes',
                    fontColor: "#041072"
                  }
              }],
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      stepSize : 1
                  },
                  scaleLabel:{
                    display: true,
                    labelString: 'Visitas',
                    fontColor: "#546372"
                  }
              }],
            },
        }
    });
})();



(async () => {

    let formato = new FormData();
    formato.append('ventasTotalesPorMes', 'OK');

    let peticion = await fetch('../Controllers/GraficasController.php', {
      method: 'POST',
      body: formato
    });

    let respuesta = await peticion.json();

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
            scales: {
              xAxes:[{
                scaleLabel:{
                    display: true,
                    labelString: 'Meses',
                    fontColor: "#546372"
                  }
              }],
              yAxes: [{
                  ticks: {
                      beginAtZero: true,
                      stepSize : 50
                  },
                  scaleLabel:{
                    display: true,
                    labelString: 'Ventas',
                    fontColor: "#546372"
                  }
              }],
            },
        }
    });
})();