const tabla = document.getElementById('tablaHumedad');
const filas = tabla.querySelectorAll('tbody tr');
const puntosX = [];
const puntosY = [];

filas.forEach((fila, index) => {
    if (index !== 0 && index !== 1){
        const hora = fila.children[1].textContent
        const horaCut = hora.slice(0, -4);

        const humedad = parseFloat(fila.children[2].textContent);

        puntosX.unshift(horaCut);
        puntosY.unshift(humedad);
    }else{
        console.log('Cabecera');
    }
});
 

function horaATimestamp(hora) {
    const [horas, minutos, segundos] = hora.split(':');
    const fecha = new Date();
    fecha.setHours(parseInt(horas, 10), parseInt(minutos, 10), parseInt(segundos, 10), 0);
    return fecha.getTime();
}

const timestampsX = puntosX.map(horaATimestamp);

function calcularRegresionLineal(x, y) {
    const n = x.length;
    let sumX = 0;
    let sumY = 0;
    let sumXY = 0;
    let sumXSquared = 0;

    for (let i = 0; i < n; i++) {
        sumX += x[i];
        sumY += y[i];
        sumXY += x[i] * y[i];
        sumXSquared += x[i] ** 2;
    }

    const m = (n * sumXY - sumX * sumY) / (n * sumXSquared - sumX ** 2);
    const b = (sumY - m * sumX) / n;

    return { m, b };
}

const regresion = calcularRegresionLineal(timestampsX, puntosY);

// Configurar la gráfica de regresión lineal con Chart.js
const canvas = document.getElementById('graficaHumedad');
const ctx = canvas.getContext('2d');

const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: puntosX,
        datasets: [
            {
                label: 'Humedad Real (%)',
                data: puntosY,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Humedad Prevista (%)',
                data: puntosX.map((x, index) => regresion.m * timestampsX[index] + regresion.b),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                fill: false
            }
        ]
    },
    options: {
        scales: {
            xAxes: [{
                type: 'time',
                time: {
                    parser: 'HH:mm:ss',
                    unit: 'hour',
                    displayFormats: {
                        hour: 'HH:mm'
                    }
                },
                ticks: {
                    autoSkip: true,
                    maxTicksLimit: 10
                }
            }],
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
