const nombre = document.getElementById("name");
const email = document.getElementById("email");
const passwd = document.getElementById("passwd");
const passwd_r = document.getElementById("passwd_r");
const form = document.getElementById("form");
const advertencia = document.getElementById("advertencia");

form.addEventListener("submit", e=>{
	e.preventDefault()
	entrar = false
	let cadena_advertencia = ""
	if(nombre.value.length < 5){
		cadena_advertencia += 'Nombre no valido<br>'
		entrar = true
	}
	if(nombre.value.length < 5){
		cadena_advertencia += 'Nombre no valido<br>'
		entrar = true
	}

	if(nombre.value.length < 5){
		cadena_advertencia += 'Nombre no valido<br>'
		entrar = true
	}

	if(nombre.value.length < 5){
		cadena_advertencia += 'Nombre no valido<br>'
		entrar = true
	}

	if (entrar) {
		advertencia.innerHTML = cadena_advertencia
	}
})