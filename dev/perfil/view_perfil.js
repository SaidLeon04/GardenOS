window.onload = () => {
    getDominantImageColor = ()=>{
        let sourceImage = document.getElementById('imagen_usuario');
        let background = document.querySelector(".form-info");
        let colorThief = new ColorThief();
        let color = colorThief.getColor(sourceImage);
        background.style.backgroundColor = "rgb(" + color + ")";
    }
    getDominantImageColor();
    }



function deleteUser() {
    var respuesta = confirm("¿Eliminar Usuario?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function saveData() {
    var respuesta = confirm("¿Editar Usuario?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
    
}

function editActive(formularioId) {
    alert("Edición activada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const inputs = formulario.querySelectorAll('input[type="text"]');
        const btn_editar = document.getElementById('btn-editar');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_passwd = document.getElementById('btn-passwd');
        const btn_delete = document.getElementById('btn-delete');
        const btn_cancel = document.getElementById('btn-cancel');
        const label_imagen = document.getElementById('label-imagen');
        const input_imagen = document.getElementById('input-imagen');
        
        inputs.forEach(input => {
            input.removeAttribute('readonly');
        });
        btn_editar.setAttribute('hidden', true);
        btn_guardar.removeAttribute('hidden');
        btn_passwd.setAttribute('hidden', true);
        btn_delete.setAttribute('hidden', true);
        btn_cancel.removeAttribute('hidden');
        label_imagen.removeAttribute('hidden');
        input_imagen.removeAttribute('hidden');

    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}

function editInactive(formularioId) {
    alert("Edición desactivada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const inputs = formulario.querySelectorAll('input[type="text"]');
        const btn_editar = document.getElementById('btn-editar');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_passwd = document.getElementById('btn-passwd');
        const btn_delete = document.getElementById('btn-delete');
        const btn_cancel = document.getElementById('btn-cancel');
        const label_imagen = document.getElementById('label-imagen');
        const input_imagen = document.getElementById('input-imagen');
        
        
        inputs.forEach(input => {
            input.setAttribute('readonly', true);
        });
        btn_editar.removeAttribute('hidden');
        btn_guardar.setAttribute('hidden', true);
        btn_passwd.removeAttribute('hidden');
        btn_delete.removeAttribute('hidden');
        btn_cancel.setAttribute('hidden', true);
        label_imagen.setAttribute('hidden', true);
        input_imagen.setAttribute('hidden', true);


    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}


