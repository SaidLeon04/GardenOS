
    const apiUrl = 'https://gardenos-5a87b-default-rtdb.firebaseio.com/gardenos/2/valor.json';

    // Función para obtener el número y mostrarlo en HTML
    async function obtenerNumeroYMostrar() {
      try {
        // Hacer la solicitud GET a la URL
        const respuesta = await fetch(apiUrl);

        // Verificar si la respuesta es exitosa (código 200)
        if (respuesta.ok) {
          // Obtener el cuerpo de la respuesta como JSON
          const datos = await respuesta.json();

          // Verificar si los datos son un número
          if (typeof datos === 'number') {
            // Mostrar el número en el elemento HTML
            const numeroElemento = document.getElementById('numeroObtenido');
            numeroElemento.textContent = datos;
          } else {
            console.log('Los datos no son un número válido:', datos);
          }
        } else {
          console.log('Error al obtener los datos:', respuesta.status);
        }
      } catch (error) {
        console.error('Error en la solicitud:', error);
      }
    }


    obtenerNumeroYMostrar();