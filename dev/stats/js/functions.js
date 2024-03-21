function editarValores() {
    var respuesta = confirm("Editar valores óptimos alterara el flujo del lote, ¿continuar?");
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
        const temperaturaInput = document.getElementById('temperatura');
        const humedadInput = document.getElementById('humedad')
        const btn_comparar = document.getElementById('btn-comparar');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_edit = document.getElementById('btn-edit');
        const btn_volver = document.getElementById('btn-volver');
        const btn_cancel = document.getElementById('btn-cancel');
        
        temperaturaInput.removeAttribute('readonly');
        humedadInput.removeAttribute('readonly');
        btn_comparar.setAttribute('hidden', true);
        btn_guardar.removeAttribute('hidden');
        btn_edit.setAttribute('hidden', true);
        btn_volver.setAttribute('hidden', true);
        btn_cancel.removeAttribute('hidden');
    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}

function editInactive(formularioId) {
    alert("Edición desactivada")
    const formulario = document.getElementById(formularioId);
    if (formulario) {
        const temperaturaInput = document.getElementById('temperatura');
        const humedadInput = document.getElementById('humedad')
        const btn_comparar = document.getElementById('btn-comparar');
        const btn_guardar = document.getElementById('btn-guardar');
        const btn_edit = document.getElementById('btn-edit');
        const btn_volver = document.getElementById('btn-volver');
        const btn_cancel = document.getElementById('btn-cancel');
        
        temperaturaInput.setAttribute('readonly', true);
        humedadInput.setAttribute('readonly', true);
        btn_comparar.removeAttribute('hidden');
        btn_guardar.setAttribute('hidden', true);
        btn_edit.removeAttribute('hidden');
        btn_volver.removeAttribute('hidden');
        btn_cancel.setAttribute('hidden', true);
    } else {
        console.error('El formulario especificado no fue encontrado.');
    }
}


