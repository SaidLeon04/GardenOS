// Datos de ejemplo (reemplaza con tus propios datos)
const puntosX = ['2023-01-01', '2023-01-02', '2023-01-03', '2023-01-04', '2023-01-05'];
const puntosY = [2, 3, 5, 4, 6];

// Función para convertir fechas a timestamps Unix
function fechaATimestamp(fecha) {
    return new Date(fecha).getTime();
}

// Convertir fechas a timestamps Unix
const timestampsX = puntosX.map(fechaATimestamp);

// Calcular la regresión lineal (método de mínimos cuadrados)
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
                label: 'Datos',
                data: puntosY,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Regresión Lineal',
                data: puntosX.map(x => regresion.m * fechaATimestamp(x) + regresion.b),
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
                    unit: 'day',
                    displayFormats: {
                        day: 'DD/MM/YYYY'
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
