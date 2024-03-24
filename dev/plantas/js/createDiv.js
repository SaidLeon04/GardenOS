function generarDivs(cantidad) {
    const contenedor = document.getElementById('main-container');

    for (let i = 0; i < cantidad; i++) {
        const div = document.createElement('div');
        div.textContent = `Registro ${i + 1}`;
        contenedor.appendChild(div);
    }
}
