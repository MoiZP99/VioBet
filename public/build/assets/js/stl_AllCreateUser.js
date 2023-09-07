//-----VER CONTRASEÑA inicio-----------------------------------------------------------|
window.addEventListener("load", function() {

    // icono para mostrar contraseña
    showPassword = document.querySelector('.show-password');
    showPassword.addEventListener('click', () => {

        // elementos input de tipo clave
        password1 = document.querySelector('.password1');
        password2 = document.querySelector('.password2');

        if ( password1.type === "text" ) {
            password1.type = "password"
            password2.type = "password"
            showPassword.classList.remove('fa-eye-slash');
        } else {
            password1.type = "text"
            password2.type = "text"
            showPassword.classList.toggle("fa-eye-slash");
        }

    })

});
//-----VER CONTRASEÑA fin-----------------------------------------------------------|

// Almacenar referencias a los elementos del DOM - para mejorar el rendimiento
var boton = document.getElementById("submit_data");
var formulario = document.getElementById("regiration_form");

function enviarFormulario() {
    var spinner = document.createElement("span");
    spinner.className = "spinner-border spinner-border-sm";
    spinner.setAttribute("role", "status");
    spinner.setAttribute("aria-hidden", "true");

    boton.innerHTML = "";
    boton.disabled = true;
    boton.classList.add("verificando");
    boton.appendChild(spinner);
    boton.innerHTML += " Verificando...";

    setTimeout(function() {
        formulario.submit();
        boton.disabled = true;
        boton.classList.remove("verificando");
        boton.removeChild(spinner);
    }, 1000);

    return false; // Evita el envío automático del form y permite que el envío lo realice la función
}

var errorAlert = null; // Variable para almacenar la instancia de la alerta de error

function validateMail(idMail) {
    // Se obtiene el objeto del campo de correo
    var object = document.getElementById(idMail);
    var valueForm = object.value;

    // Verificar si el campo está vacío
    if (valueForm.trim() === '') {
        object.classList.remove('is-valid');
        object.classList.remove('is-invalid');

        // Cerrar la alerta si está abierta
        if (errorAlert) {
            errorAlert.close();
            errorAlert = null;
        }

        return;
    }

    // Patrón para el correo
    var patron = /^(\W|^)[a-zA-Z][\.,\w,+\-]{0,25}@(yahoo|hotmail|gmail)\.com(\W|$)$/;
    if (valueForm.search(patron) === 0) {
        // Correo válido
        object.style.color = "#000";
        object.classList.remove('is-invalid');
        object.classList.add('is-valid');

        // Cerrar la alerta si está abierta
        if (errorAlert) {
            errorAlert.close();
            errorAlert = null;
        }
    } else {
        // Correo inválido
        object.style.color = "#f00";
        object.classList.remove('is-valid');
        object.classList.add('is-invalid');

        if (!errorAlert) {
            errorAlert = Swal.fire({
                icon: 'error',
                text: '¡Debe ingresar un correo electrónico válido!',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                },
                willClose: () => {
                    errorAlert = null; // Reiniciar la instancia de la alerta
                }
            });
        }
    }
}


function validateText(idText) {
    //Se crea un objeto 
    object = document.getElementById(idText);
    valueForm = object.value;

    // Patron para los textos
    var patron = /^([A-Za-záéíóúÁÉÍÓÚÑñ\s]*$)/;
    if (valueForm.search(patron) == 0) {
        //Texto correcto
        object.style.color = "#000";
        object.classList.remove('is-invalid');
        if (valueForm.trim() === '') {
            object.classList.remove('is-valid');
        } else {
            object.classList.add('is-valid');
        }

          // Cerrar la alerta si está abierta
        if (errorAlert) {
            errorAlert.close();
            errorAlert = null;
        }
        return;
    }

    //Texto incorrecto
    object.style.color = "#f00";
    object.classList.remove('is-valid');
    object.classList.add('is-invalid');

    // Mostrar la alerta si no está abierta
    if (!errorAlert) {
        errorAlert = Swal.fire({
            icon: 'error',
            // title: '¡Advertencia!',
            text: '¡Solo letras, acentos y espacios son permitidos!',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            willClose: () => {
                errorAlert = null; // Reiniciar la instancia de la alerta
            }
        });
    }
}

function validatePass(idTel) {
    //Se crea un objeto 
    object = document.getElementById(idTel);
    valueForm = object.value;

    // Patron para el tel..
    var patron = /^(?=.*[A-Z])(?=.*[a-z].*[a-z].*[a-z])(?=.*\d.*\d.*\d.*\d)(?=.*[*#@])[A-Za-z\d*#@]{8,16}$/; //OPTIMIZADA
    // var patron = /^(?=.*[a-z]{4,})(?=.*[A-Z])(?=(?:.*?\d){4})(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,16}$/; //PRUEBA CORREGIDA
    // var patron = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,16}$/; //ANTERIOR
    // /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/
    if (valueForm.search(patron) == 0) {
        //Tel correcto
        object.style.color = "#000";
        object.classList.remove('is-invalid');
        if (valueForm.trim() === '') {
            object.classList.remove('is-valid');
        } else {
            object.classList.add('is-valid');
        }

          // Cerrar la alerta si está abierta
        if (errorAlert) {
            errorAlert.close();
            errorAlert = null;
        }
        return;
    }
    
    //Texto incorrecto
    object.style.color = "#f00";
    object.classList.remove('is-valid');
    object.classList.add('is-invalid');

    if (!errorAlert) {
        errorAlert = Swal.fire({
            icon: 'error',
            // title: '¡Advertencia!',
            text: '¡Debe complir con los requisitos!',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            willClose: () => {
                errorAlert = null; // Reiniciar la instancia de la alerta
            }
        });
    }
}

var selectObjectTipoEspacio = document.getElementById('tipo_espacio');
selectObjectTipoEspacio.addEventListener('change', function() {
    validateSelectTipoEspacio(selectObjectTipoEspacio);
});

function validateSelectTipoEspacio(select) {
    var selectedOption = select.options[select.selectedIndex];

    if (selectedOption.value !== "") {
        // Opción seleccionada válida
        select.classList.remove('is-invalid');
        select.classList.add('is-valid');
    } else {
        // Opción seleccionada inválida
        select.classList.remove('is-valid');
        select.classList.add('is-invalid');
    }
}
