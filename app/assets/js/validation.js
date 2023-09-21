// function validateUsername(input) {
//   const username = input.value.trim(); // Remove leading/trailing spaces

//   if (username.length === 6) {
//     document.getElementById('validationMessage').textContent = ''; // Clear error message
//   } else {
//     document.getElementById('validationMessage').textContent = 'Username must be exactly 6 characters long.';
//   }
// }

// // Example starter JavaScript for disabling form submissions if there are invalid fields
// (() => {
//   'use strict';

//   // Fetch all the forms we want to apply custom Bootstrap validation styles to
//   const forms = document.querySelectorAll('.needs-validation');

//   // Loop over them and prevent submission
//   Array.prototype.slice.call(forms).forEach((form) => {
//     form.addEventListener('submit', (event) => {
//       if (!form.checkValidity()) {
//         event.preventDefault();
//         event.stopPropagation();
//       }
//       form.classList.add('was-validated');
//     }, false);
//   });
// })();


// Mask input for birthdate
const birthdateInput = document.getElementById('birthdate');

        birthdateInput.addEventListener('input', function () {
            let value = this.value.replace(/\D/g, ''); // Remove non-numeric characters
            if (value.length > 2) {
                value = `${value.slice(0, 2)}/${value.slice(2)}`;
            }
            if (value.length > 5) {
                value = `${value.slice(0, 5)}/${value.slice(5, 9)}`;
            }
            this.value = value;
        });


// Mobile number input
function validateNumericInput(input) {
  // Remove any non-numeric characters using a regular expression
  input.value = input.value.replace(/[^0-9]/g, '');
}


function validateForm() {
  const usernameInput = document.getElementById('username');
  const usernameValue = usernameInput.value.trim();

  if (usernameValue.length !== 6) {
    // Show Bootstrap's validation style for invalid input
    usernameInput.classList.add('is-invalid');
    return false; // Prevent the form submission
  } else {
    // Remove Bootstrap's validation style for valid input
    usernameInput.classList.remove('is-invalid');
    return true; // Allow the form submission
  }
}