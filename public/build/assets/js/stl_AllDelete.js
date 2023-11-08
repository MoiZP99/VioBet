//---iniciación global inicio ---------------------------------------------------------|
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-outline-success',
      cancelButton: 'btn btn-outline-danger mr-3'
    },
    buttonsStyling: false
  });
//---iniciación global fin ---------------------------------------------------------|
//---SweetAlert Delete LUGAR inicio ---------------------------------------------------------|  
//inicio
function eliminarFichaMedica(elimino) {
  swalWithBootstrapButtons.fire({
    title: '¿Está seguro de realizar esta acción?',
    text: '¡No volverá a ver este registro!',
    icon: 'warning',
    showCancelButton: true,
    allowOutsideClick: false,
    confirmButtonText: '<i class="fa fa-check"></i> ¡Sí, bórralo!',
    cancelButtonText: '<i class="fas fa-times"></i> ¡No, cancelar!',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      swalWithBootstrapButtons.fire({
        title: 'Borrando...',
        html: 'Espere un momento mientras se borran los datos',
        allowOutsideClick: false,
        didOpen: () => {
          swalWithBootstrapButtons.showLoading();
          setTimeout(() => {
            llamadoFicha(elimino);
            swalWithBootstrapButtons.close();
          }, 1000); // Tiempo en milisegundos (2 segundos)
        }
      });
    } else if (result.dismiss === Swal.DismissReason.cancel) {
      swalWithBootstrapButtons.fire({
        title: 'Cancelado',
        text: 'Su registro está seguro',
        icon: 'error',
        showConfirmButton: true,
        confirmButtonClass: 'btn btn-outline-primary',
        confirmButtonText: '<i class="fa fa-check"></i> OK', // Texto del botón
        buttonsStyling: false
      });
    }      
  });
}
function llamadoFicha(elimino) {
  const parametros = {
    IdFichaMedica: elimino
  };
  $.ajax({
    data: parametros,
    url: '/fichamedica/delete/delete_partial',
    type: 'POST',
    beforeSend: function() {},
    success: function() {
      Swal.fire({
        title: '¡Eliminado!',
        html: 'Su registro ha sido eliminado.<br>Desaparecerá de la vista cuando cierre este diálogo.',
        icon: 'success',
        showConfirmButton: true,
        confirmButtonClass: 'btn btn-outline-success',
        confirmButtonText: '<i class="fa fa-check"></i> OK',
        buttonsStyling: false
      }).then((result) => {
        window.location.href = '/fichamedica/index';
      });
    },
  });
}
//fin
  function eliminarAnimal(elimino) {
    swalWithBootstrapButtons.fire({
      title: '¿Está seguro de realizar esta acción?',
      text: '¡No volverá a ver este registro!',
      icon: 'warning',
      showCancelButton: true,
      allowOutsideClick: false,
      confirmButtonText: '<i class="fa fa-check"></i> ¡Sí, bórralo!',
      cancelButtonText: '<i class="fas fa-times"></i> ¡No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire({
          title: 'Borrando...',
          html: 'Espere un momento mientras se borran los datos',
          allowOutsideClick: false,
          didOpen: () => {
            swalWithBootstrapButtons.showLoading();
            setTimeout(() => {
              llamadoAnimal(elimino);
              swalWithBootstrapButtons.close();
            }, 1000); // Tiempo en milisegundos (2 segundos)
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: 'Cancelado',
          text: 'Su registro está seguro',
          icon: 'error',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-primary',
          confirmButtonText: '<i class="fa fa-check"></i> OK', // Texto del botón
          buttonsStyling: false
        });
      }      
    });
  }

  function llamadoAnimal(elimino) {
    const parametros = {
      IdAnimal: elimino
    };
    $.ajax({
      data: parametros,
      url: '/animal/delete/delete_partial',
      type: 'POST',
      beforeSend: function() {},
      success: function() {
        Swal.fire({
          title: '¡Eliminado!',
          html: 'Su registro ha sido eliminado.<br>Desaparecerá de la vista cuando cierre este diálogo.',
          icon: 'success',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-success',
          confirmButtonText: '<i class="fa fa-check"></i> OK',
          buttonsStyling: false
        }).then((result) => {
          window.location.href = '/animal/index';
        });
      },
    });
  }
//---SweetAlert Delete LUGAR fin ---------------------------------------------------------|
//---SweetAlert Delete GASTRONOMÍA inicio ---------------------------------------------------------|
  function eliminarFinca(elimino) {
    swalWithBootstrapButtons.fire({
      title: '¿Está seguro de realizar esta acción?',
      text: '¡No volverá a ver este registro!',
      icon: 'warning',
      showCancelButton: true,
      allowOutsideClick: false,
      confirmButtonText: '<i class="fa fa-check"></i> ¡Sí, bórralo!',
      cancelButtonText: '<i class="fas fa-times"></i> ¡No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire({
          title: 'Borrando...',
          html: 'Espere un momento mientras se borran los datos',
          allowOutsideClick: false,
          didOpen: () => {
            swalWithBootstrapButtons.showLoading();
            setTimeout(() => {
              llamadoFinca(elimino);
              swalWithBootstrapButtons.close();
            }, 1000); // Tiempo en milisegundos (2 segundos)
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: 'Cancelado',
          text: 'Su registro está seguro',
          icon: 'error',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-primary',
          confirmButtonText: '<i class="fa fa-check"></i> OK', // Texto del botón
          buttonsStyling: false
        });
      }
    });
  }
  
  function llamadoFinca(elimino) {
    const parametros = {
      IdFinca: elimino
    };
    $.ajax({
      data: parametros,
      url: '/finca/delete/delete_partial',
      type: 'POST',
      beforeSend: function() {},
      success: function() {
        Swal.fire({
          title: '¡Eliminado!',
          html: 'Su registro ha sido eliminado.<br>Desaparecerá de la vista cuando cierre este diálogo.',
          icon: 'success',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-success',
          confirmButtonText: '<i class="fa fa-check"></i> OK',
          buttonsStyling: false
        }).then((result) => {
          window.location.href = '/finca/index';
        });
      },
    });
  }
//---SweetAlert Delete GASTRONOMÍA fin ---------------------------------------------------------|
//---SweetAlert Delete EMPRENDEDOR fin ---------------------------------------------------------|
  function eliminarEmprende(elimino) {
    swalWithBootstrapButtons.fire({
      title: '¿Está seguro de realizar esta acción?',
      text: '¡No volverá a ver este registro!',
      icon: 'warning',
      showCancelButton: true,
      allowOutsideClick: false,
      confirmButtonText: '<i class="fa fa-check"></i> ¡Sí, bórralo!',
      cancelButtonText: '<i class="fas fa-times"></i> ¡No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire({
          title: 'Borrando...',
          html: 'Espere un momento mientras se borran los datos',
          allowOutsideClick: false,
          didOpen: () => {
            swalWithBootstrapButtons.showLoading();
            setTimeout(() => {
              llamadoEmprende(elimino);
              swalWithBootstrapButtons.close();
            }, 2000); // Tiempo en milisegundos (2 segundos)
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: 'Cancelado',
          text: 'Su registro está seguro',
          icon: 'error',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-primary',
          confirmButtonText: '<i class="fa fa-check"></i> OK', // Texto del botón
          buttonsStyling: false
        });
      }
    });
  }
  
  function llamadoEmprende(elimino) {
    const parametros = {
      Id: elimino
    };
    $.ajax({
      data: parametros,
      url: '/entrepreneurs/delete/delete_partial',
      type: 'POST',
      beforeSend: function() {},
      success: function() {
        Swal.fire({
          title: '¡Eliminado!',
          html: 'Su registro ha sido eliminado.<br>Desaparecerá de la vista cuando cierre este diálogo.',
          icon: 'success',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-success',
          confirmButtonText: '<i class="fa fa-check"></i> OK',
          buttonsStyling: false
        }).then((result) => {
          window.location.href = '/entrepreneurs/index';
        });
      },
    });
  }
//---SweetAlert Delete EMPRENDEDOR fin ---------------------------------------------------------|
//---SweetAlert Delete ACTIVIDAD fin ---------------------------------------------------------|
  function eliminarActividad(elimino) {
    swalWithBootstrapButtons.fire({
      title: '¿Está seguro de realizar esta acción?',
      text: '¡No volverá a ver este registro!',
      icon: 'warning',
      showCancelButton: true,
      allowOutsideClick: false,
      confirmButtonText: '<i class="fa fa-check"></i> ¡Sí, bórralo!',
      cancelButtonText: '<i class="fas fa-times"></i> ¡No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        swalWithBootstrapButtons.fire({
          title: 'Borrando...',
          html: 'Espere un momento mientras se borran los datos',
          allowOutsideClick: false,
          didOpen: () => {
            swalWithBootstrapButtons.showLoading();
            setTimeout(() => {
              llamadoActividad(elimino);
              swalWithBootstrapButtons.close();
            }, 2000); // Tiempo en milisegundos (2 segundos)
          }
        });
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire({
          title: 'Cancelado',
          text: 'Su registro está seguro',
          icon: 'error',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-primary',
          confirmButtonText: '<i class="fa fa-check"></i> OK', // Texto del botón
          buttonsStyling: false
        });
      }
    });
  }
  
  function llamadoActividad(elimino) {
    const parametros = {
      Id: elimino
    };
    $.ajax({
      data: parametros,
      url: '/activities/delete/delete_partial',
      type: 'POST',
      beforeSend: function() {},
      success: function() {
        Swal.fire({
          title: '¡Eliminado!',
          html: 'Su registro ha sido eliminado.<br>Desaparecerá de la vista cuando cierre este diálogo.',
          icon: 'success',
          showConfirmButton: true,
          confirmButtonClass: 'btn btn-outline-success',
          confirmButtonText: '<i class="fa fa-check"></i> OK',
          buttonsStyling: false
        }).then((result) => {
          window.location.href = '/activities/index';
        });
      },
    });
  }
//---SweetAlert Delete ACTIVIDAD fin ---------------------------------------------------------|