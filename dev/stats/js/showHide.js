function showHideTable(id1, id2) {
    var tablaHumedad = document.getElementById(id1);
    var tablaTemperatura = document.getElementById(id2);

    if (tablaTemperatura.style.display == 'none') {
        tableHumedad.style.display = 'flex';
    } else {
        tableHumedad.style.display = 'none';
        tablaTemperatura.style.display = 'flex';
    }
}