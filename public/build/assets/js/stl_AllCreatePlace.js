//---CONTADOR DE CARACTERES inicio---------------------------------------------------------|
const mensaje = document.getElementById("descripcion");
const contador = document.getElementById("contador");
const minimo = document.getElementById("minimo");

mensaje.addEventListener("input", function(e) {
    const target = e.target;
    const longitudAct = target.value.length;

    contador.innerHTML = longitudAct;

    if (longitudAct < 50) {
        contador.style.color = "orange";
        minimo.style.color = "#737C83"; // Restaurar el color predeterminado si se había alcanzado el mínimo anteriormente
    } else if (longitudAct >= 50 && longitudAct <= 70) {
        contador.style.color = "green";
        minimo.style.color = "green";
    } else {
        contador.style.color = "#737C83"; // Restaurar el color predeterminado si se supera el máximo
        minimo.style.color = "#737C83";
    }
});

//---CONTADOR DE CARACTERES fin---------------------------------------------------------|

// -----PAGINACIÓN inicio-------------------------------------------------------------------------|
function validarPaso(pasoActual, pasoSiguiente) {
    // Obtener el fieldset actual y el siguiente
    var fieldsetActual = document.getElementById(pasoActual);
    var fieldsetSiguiente = document.getElementById(pasoSiguiente);

    // Validar que todos los campos requeridos del fieldset actual estén completos
    var inputs = fieldsetActual.querySelectorAll('input[required], select[required], textarea[required]');
    var completos = true;
    for (var i = 0; i < inputs.length; i++) {
        var input = inputs[i];
        if (input.value === '') {
            completos = false;
            break;
        }

        // Validar tipos de input específicos
        var inputType = input.getAttribute('type');
        if (inputType === 'file') {
            // Validar el input de tipo file
            if (!input.files || input.files.length === 0) {
                completos = false;
                break;
            }
        } else if (inputType === 'time') {
            // Validar el input de tipo time
            if (!isValidTime(input.value)) {
                completos = false;
                break;
            }
        } else if (inputType === 'text') {
            // Validar el input de tipo text según tus requisitos específicos
            if (!isValidText(input.value)) {
                completos = false;
                break;
            }
        }
    }

    // Validar que el textarea tenga al menos 50 caracteres
    var textarea = fieldsetActual.querySelector('textarea');
    if (textarea && textarea.value.length < 50) {
        completos = false;
    }

    // Si todos los campos requeridos están completos, mostrar el siguiente fieldset, sino mostrar un mensaje de error
    if ((!completos) || (textarea && textarea.value.length < 50)) {
        Swal.fire({
            icon: 'warning',
            text: '¡Debe completar correctamente todos los campos!',
            timer: 5000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });      
    } else {
        fieldsetActual.style.display = 'none';
        fieldsetSiguiente.style.display = 'block';
    }
}

// Función para validar el formato de tiempo (HH:mm)
function isValidTime(time) {
    var regex = /^(?:[01]\d|2[0-3]):[0-5]\d$/;
    return regex.test(time);
}

// Función para validar el texto según tus requisitos específicos
function isValidText(text) {
    // Implementa tu lógica de validación para el input de tipo text aquí
    // Devuelve true si el texto es válido, o false si no cumple con los requisitos
    var regex = /^[a-zA-ZáéíóúÁÉÍÓÚÑñ0-9\s]*$/;
    return regex.test(text);
    // return text.length > 0; // Ejemplo de validación: el texto debe tener al menos 1 carácter
}


// -----PAGINACIÓN fin-------------------------------------------------------------------------|

//----------AUTO-GROW TEXTAREA inicio----------------------------------------------------------|
function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px";
}
//----------AUTO-GROW TEXTAREA fin----------------------------------------------------------|

//-----VALIDACIONES INPUTS inicio-----------------------------------------------------------|
var errorAlert = false; // Variable de control para verificar si la alerta de error ya se ha mostrado
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

function validateTel(idTel) {
    //Se crea un objeto 
    object = document.getElementById(idTel);
    valueForm = object.value;

    // Patron para el tel..
    var patron = /^([0-9])*$/;
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

    // Mostrar la alerta si no está abierta
    if (!errorAlert) {
        errorAlert = Swal.fire({
            icon: 'error',
            // title: '¡Advertencia!',
            text: '¡Número de Teléfono debe contener 8 números!',
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

function validateTextUbi(idText) {
    //Se crea un objeto 
    object = document.getElementById(idText);
    valueForm = object.value;

    // Patron para los textos
    var patron = /^[a-zA-ZáéíóúÁÉÍÓÚÑñ0-9\s]*$/;
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

    if (!errorAlert) {
        errorAlert = Swal.fire({
            icon: 'error',
            // title: '¡Advertencia!',
            text: '¡Solo letras, acentos, números y espacios son permitidos!',
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

var selectObjectCategoria = document.getElementById('categoria');
selectObjectCategoria.addEventListener('change', function() {
    validateSelectCategoria(selectObjectCategoria);
});

function validateSelectCategoria(select) {
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

var fileInput = document.getElementById('imagen');
fileInput.addEventListener('change', function() {
    validateFile(fileInput);
});

function validateFile(input) {
    var file = input.files[0];

    if (file) {
        // Archivo seleccionado válido
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    } else {
        // No se seleccionó ningún archivo
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }
}

var timeInputHoraA = document.getElementById('horaA');
timeInputHoraA.addEventListener('change', function() {
    validateTime(timeInputHoraA);
});

function validateTime(input) {
    var timeValue = input.value;

    if (timeValue) {
        // Valor del input de tipo time válido
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
    } else {
        // No se ingresó ningún valor en el input
        input.classList.remove('is-valid');
        input.classList.add('is-invalid');
    }
}

var timeInputHoraC = document.getElementById('horaC');
timeInputHoraC.addEventListener('change', function() {
    validateTime(timeInputHoraC);
});

var selectObjectDiaA = document.getElementById('diaA');
selectObjectDiaA.addEventListener('change', function() {
    validateSelectDiaA(selectObjectDiaA);
});

function validateSelectDiaA(select) {
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

var selectObjectDiaC = document.getElementById('diaC');
selectObjectDiaC.addEventListener('change', function() {
    validateSelectDiaC(selectObjectDiaC);
});

function validateSelectDiaC(select) {
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
//-----VALIDACIONES INPUTS fin-----------------------------------------------------------|