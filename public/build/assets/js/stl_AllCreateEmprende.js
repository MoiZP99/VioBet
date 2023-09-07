var selectObjectCategoria = document.getElementById('categoria');
selectObjectCategoria.addEventListener('change', function() {
    validateSelectCategoria(selectObjectCategoria);
});

function validateSelectCategoria(select) {
    var selectedOption = select.options[select.selectedIndex];
    var selectedValue = selectedOption.value;
  
    if (selectedValue !== "") {
      // Opción seleccionada válida
      select.classList.remove('is-invalid');
      select.classList.add('is-valid');
    } else {
      // Opción seleccionada inválida
      select.classList.remove('is-valid');
      select.classList.add('is-invalid');
    }
  }

  var selectObjectFeriaEmprende = document.getElementById('feriaEmprende');
  selectObjectFeriaEmprende.addEventListener('change', function() {
      validateSelect(this);
  });
  
  function validateSelect(select) {
      var selectedOption = select.options[select.selectedIndex];
      var selectedValue = selectedOption.value;
  
      if (selectedValue !== "") {
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

function validateCedula(idCedula) {
    //Se crea un objeto 
    object = document.getElementById(idCedula);
    valueForm = object.value;

    // Patron para el tel..
    var patron = /^[a-zA-Z0-9]*$/;
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
            text: '¡Cédula debe contener 9 números!',
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

function validateTextProducto(nom_producto) {
    //Se crea un objeto 
    object = document.getElementById(nom_producto);
    valueForm = object.value;

    // Patron para los textos
    var patron = /^([A-Za-záéíóúÁÉÍÓÚÑñ,\s]*)$/;
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
            text: '¡Solo letras, acentos, comas y espacios son permitidos!',
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
//-----VALIDACIONES INPUTS fin-----------------------------------------------------------|

//---CONTADOR DE CARACTERES inicio---------------------------------------------------------|
const mensaje = document.getElementById("nom_producto");
const contador = document.getElementById("contador");

mensaje.addEventListener("input", function(e) {
    const target = e.target;
    const longitudAct = target.value.length;
    contador.innerHTML = `${longitudAct}`;
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
        if (inputs[i].value === '') {
            completos = false;
            break;
        }
        // Validar que todos los select requeridos estén seleccionados
        if (inputs[i].tagName === 'SELECT' && inputs[i].value === '') {
            completos = false;
            break;
        }
        // Validar que todos los campos input de tipo time requeridos tengan un valor
        if (inputs[i].getAttribute('type') === 'time' && inputs[i].value === '') {
            completos = false;
            break;
        }
    }

    // Si todos los campos requeridos están completos, mostrar el siguiente fieldset, sino mostrar un mensaje de error
    if (completos) {
        fieldsetActual.style.display = 'none';
        fieldsetSiguiente.style.display = 'block';
    } else {
        Swal.fire({
            icon: 'warning',
            text: '¡Todos los campos son requeridos!',
            timer: 3000,
            timerProgressBar: true,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });      
    }
}
// -----PAGINACIÓN fin-------------------------------------------------------------------------|

