function showHide() {
    var tablaHumedad = document.getElementById('tablaHumedad');
    var tablaTemperatura = document.getElementById('tablaTemperatura');
    var graficaHumedad = document.getElementById('graficaHumedad');
    var graficaTemperatura = document.getElementById('graficaTemperatura');
    var tituloHumedad = document.getElementById('tituloHumedad');
    var tituloTemperatura = document.getElementById('tituloTemperatura');


    if(tablaTemperatura.style.display === 'none'){
        tablaTemperatura.style.display = 'block';
        graficaTemperatura.style.display = 'block';
        tituloTemperatura.style.display = 'block';
        tablaHumedad.style.display = 'none';
        graficaHumedad.style.display = 'none';
        tituloHumedad.style.display = 'none';
    }else if(tablaHumedad.style.display === 'none'){
        tablaHumedad.style.display = 'block';
        graficaHumedad.style.display = 'block';
        tituloHumedad.style.display = 'block';
        
        tablaTemperatura.style.display = 'none';
        graficaTemperatura.style.display = 'none';
        tituloTemperatura.style.display = 'none';
    }
}