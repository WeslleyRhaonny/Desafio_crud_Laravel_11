/**
 * Sweet Alerts
 */

'use strict';

(function () {
  const iconSuccess = document.querySelector('#type-success'),
    iconInfo = document.querySelector('#type-info'),
    iconError = document.querySelector('#type-error');
 
  // Basic Alerts
  // --------------------------------------------------------------------

  // Success Alert
  if (iconSuccess) {
    iconSuccess.onclick = function () {
      Swal.fire({
        title: 'Good job!',
        text: 'You clicked the button!',
        icon: 'success',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    };
  }

  // Info Alert
  if (iconInfo) {
    iconInfo.onclick = function () {
      Swal.fire({
        title: 'Info!',
        text: 'You clicked the button!',
        icon: 'info',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    };
  }

  // Error Alert
  if (iconError) {
    iconError.onclick = function () {
      Swal.fire({
        title: 'Error!',
        text: ' You clicked the button!',
        icon: 'error',
        customClass: {
          confirmButton: 'btn btn-primary'
        },
        buttonsStyling: false
      });
    };
  }
 
})();
