function humedad() {
    const graficaHumedad = document.getElementById('graficaHumedad');
    const tablaHumedad = document.getElementById('tablaHumedad');


    if (tablaHumedad.style.display === 'block') {
        graficaHumedad.style.display = 'none';
    } else {
        graficaHumedad.style.display = 'block';
        tablaHumedad.style.display = 'none';
    }


}