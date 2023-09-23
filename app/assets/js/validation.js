// Mobile number input
function validateNumericInput(input) {
  // Remove any non-numeric characters using a regular expression
  input.value = input.value.replace(/[^0-9]/g, '');
}
// Mask birthdate input
// const birthdateInput = document.getElementById("birthdate");
// Inputmask("99/99/9999").mask(birthdateInput);

document.addEventListener("DOMContentLoaded", function() {
  const birthdateInput = document.getElementById("birthdate");
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
  birthdateInput.addEventListener("input", function() {
      const birthdateValue = birthdateInput.value;
      const birthdateFeedback = birthdateInput.nextElementSibling;
      
      // Regular expression for mm/dd/yyyy format
      const dateFormatRegex = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])\/\d{4}$/;
      
      if (dateFormatRegex.test(birthdateValue)) {
          birthdateInput.classList.remove("is-invalid");
          birthdateFeedback.textContent = "";
      } else {
          birthdateInput.classList.add("is-invalid");
          birthdateFeedback.textContent = "Please enter a valid birthdate in mm/dd/yyyy format.";
      }
  });
});

document.addEventListener("DOMContentLoaded", function() {
const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");

// Event listener for username input
usernameInput.addEventListener("input", function() {
    const usernameValue = usernameInput.value;

    if (usernameValue.length >= 6) {
        usernameInput.classList.remove("is-invalid");
        usernameInput.classList.add("is-valid");
        usernameFeedback.textContent = "";
    } else {
        usernameInput.classList.remove("is-valid");
        usernameInput.classList.add("is-invalid");
    }
});

  // Event listener for password input
passwordInput.addEventListener("input", function() {
    const passwordValue = passwordInput.value;

    if (passwordValue.length >= 8) {
        passwordInput.classList.remove("is-invalid");
        passwordInput.classList.add("is-valid");
        passwordFeedback.textContent = "";
    } else {
        passwordInput.classList.remove("is-valid");
        passwordInput.classList.add("is-invalid");
    }
});

document.getElementById("register").addEventListener("submit", function(event) {
// Check if the form is valid using HTML5 validation
    if (this.checkValidity() === false) {
        event.preventDefault(); // Prevent form submission if it's not valid
        event.stopPropagation();
    }
});
});