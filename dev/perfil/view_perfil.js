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
    var respuesta = confirm("Atención: Al eliminar su cuenta no podrá recuperarla. ¿Eliminar Usuario?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function saveData() {
    var respuesta = confirm("Atención: Al editar su perfil será necesario que inicie sesión otra vez. ¿Editar Usuario?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
    
}

function changePasswd(){
    var respuesta = confirm("Atención: Al editar su contraseña será necesario que inicie sesión otra vez. ¿Continuar?");
    if (respuesta == true) {
        return true;
    }else{
        return false;
    }
}

function changeCorreo(){
    var respuesta = confirm("Atención: Al editar su correo será necesario que confirme la nueva dirección e inicie sesión otra vez. ¿Continuar?");
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
        const btn_email = document.getElementById('btn-email');
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
        btn_email.setAttribute('hidden', true);
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
        const btn_email = document.getElementById('btn-email');
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
        btn_email.removeAttribute('hidden');
        btn_delete.removeAttribute('hidden');
        btn_cancel.setAttribute('hidden', true);
        label_imagen.setAttribute('hidden', true);
        input_imagen.setAttribute('hidden', true);


    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}


