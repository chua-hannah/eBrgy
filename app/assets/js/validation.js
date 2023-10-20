// Mobile number input
function validateNumericInput(input) {
  // Remove any non-numeric characters using a regular expression
  input.value = input.value.replace(/[^0-9]/g, '');
}

document.addEventListener("DOMContentLoaded", function() {
    const birthdate = document.getElementById("datepicker");
    var errorText = document.getElementById("error_birth");
    birthdate.addEventListener('input', function () {
        birthdate.classList.remove("is-invalid");
        errorText.style.display = "none";    
    });
    if (document.getElementById("error_birth")){
        const flatpickrInstance = flatpickr("#datepicker", {
            // Flatpickr options
            maxDate: "today", 
            onChange: function (selectedDates, dateStr, instance) {
                const inputElement = instance.input;
                const dateFormat = "m/d/Y"; // Your desired date format
                
                // Format the selected date according to your desired format
                const formattedDate = instance.formatDate(selectedDates[0], dateFormat);
                
                // Update the input element's value with the formatted date
                inputElement.value = formattedDate;
                
                // You can also remove the "is-invalid" class if needed
                inputElement.classList.remove("is-invalid");
            }
        });
    }
});
  
document.addEventListener("DOMContentLoaded", function() {
const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const errorUsername = document.getElementById("error_username");
const errorPassword = document.getElementById("error_password");

// Event listener for username input
    usernameInput.addEventListener("input", function() {
    const usernameValue = usernameInput.value;

    if (usernameValue.length >= 6) {
        usernameInput.classList.remove("is-invalid");
        usernameInput.classList.add("is-valid");
        errorUsername.textContent = "";
    } else {
        usernameInput.classList.remove("is-valid");
        usernameInput.classList.add("is-invalid");
        errorUsername.textContent = "Username must be at least 6 characters long.";
    }
    });

// Event listener for password input
    passwordInput.addEventListener("input", function() {
    const passwordValue = passwordInput.value;

    if (passwordValue.length >= 8) {
        passwordInput.classList.remove("is-invalid");
        passwordInput.classList.add("is-valid");
        errorPassword.textContent = "";
    } else {
        passwordInput.classList.remove("is-valid");
        passwordInput.classList.add("is-invalid");
        errorPassword.textContent = "Password must be at least 8 characters long.";
    }
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Get references to the input field and validation message element
    const emailInput = document.getElementById('email');
    const emailValidationMessage = document.getElementById('error_email2');
    const emailValidationMessage2 = document.getElementById("error_email");
    const mobileInput = document.getElementById('mobile');
    const mobileValidationMessage = document.getElementById('error_mobile2');
    const mobileValidationMessage2 = document.getElementById("error_mobile");
    
    emailInput.addEventListener('input', function () {
        // Add an input event listener to validate the email format as the user types
        var inputValue = emailInput.value;
        if (!isValidEmailFormat(inputValue)) {
            emailValidationMessage.style.display = "block";
            emailInput.classList.add("is-invalid");
        } else {
            emailValidationMessage.style.display = "none";
            emailInput.classList.remove("is-invalid");
        }
        if (inputValue === "") {
            emailInput.classList.remove("is-invalid");
            emailValidationMessage2.style.display = "none";
        }
        else if (inputValue.length>0){
            emailValidationMessage2.style.display = "none";
        }
    });

    function isValidEmailFormat(input) {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return emailRegex.test(input);
    }
    // Validate mobile number format
    mobileInput.addEventListener('input', function () {
        var inputValue = mobileInput.value;
        if (!isValidMobileFormat(inputValue)) {
            mobileValidationMessage.style.display = "block";
            mobileInput.classList.add("is-invalid");
        } else {
            mobileValidationMessage.style.display = "none";
            mobileInput.classList.remove("is-invalid");
        }
        if (inputValue === "") {
            mobileInput.classList.remove("is-invalid");
            mobileValidationMessage2.style.display = "none";
        }
        else if (inputValue.length>0){
            mobileValidationMessage2.style.display = "none";
        }
    });

    // Function to validate mobile number format
    function isValidMobileFormat(input) {
    var mobileRegex = /^9\d*$/
    return mobileRegex.test(input);
    }
});
// Remove is-invalid for Login page
document.addEventListener("DOMContentLoaded", function() {
    const username = document.getElementById("username-login");
    const password = document.getElementById("password-login");

    // Add an input event listener to monitor changes in the input field
    username.addEventListener("input", function() {
        const inputUsername = username.value.trim();
        if (inputUsername === "") {
            username.classList.remove("is-invalid");
            
        }
        else if (inputUsername.length>0){
            username.classList.remove("is-invalid");
        }
    });
    password.addEventListener("input", function() {
        const inputPassword = password.value.trim();
        if (inputPassword === "") {
            password.classList.remove("is-invalid");
            
        }
        else if (inputPassword.length>0){
            password.classList.remove("is-invalid");
        }
    });
});


// Remove is-invalid for Register page
document.addEventListener("DOMContentLoaded", function() {
    const firstname = document.getElementById("firstname");
    const lastname = document.getElementById("lastname");
    const mobile = document.getElementById("mobile");
    const sex = document.getElementById("sex");
    const email = document.getElementById("email");
    const address = document.getElementById("address");
    const idSelfie = document.getElementById("id_selfie");
    const validId = document.getElementById("valid_id");
    const dpa = document.getElementById("dpa");
    const chkbox = document.getElementById("data_privacy_agreement");
    const errorFirst = document.getElementById("error_first");
    const errorLast = document.getElementById("error_last");
    const errorSex = document.getElementById("error_sex");
    const errorMobile = document.getElementById("error_mobile");
    const errorEmail = document.getElementById("error_email");
    const errorAddress = document.getElementById("error_address");
    const errorTerms = document.getElementById("error_terms");

    
  
    // Add an input event listener to monitor changes in the input field
    firstname.addEventListener("input", function() {
        const inputFirstname = firstname.value.trim();
        errorFirst.style.display = "none";
        if (inputFirstname === "") {
            firstname.classList.remove("is-invalid");
          
        }
        else if (inputFirstname.length>0){
            firstname.classList.remove("is-invalid");
        }
    });
    lastname.addEventListener("input", function() {
        const inputLastname = lastname.value.trim();
        errorLast.style.display = "none";
        if (inputLastname === "") {
            lastname.classList.remove("is-invalid");
          
        }
        else if (inputLastname.length>0){
            lastname.classList.remove("is-invalid");
        }
    });
    mobile.addEventListener("input", function() {
        const inputMobile= mobile.value.trim();
        errorMobile.style.display = "none";
        if (inputMobile === "") {
            mobile.classList.remove("is-invalid");
          
        }
        else if (inputMobile.length>0){
            mobile.classList.remove("is-invalid");
        }
    });
    email.addEventListener("input", function() {
        const inputEmail= email.value.trim();
        errorEmail.style.display = "none";
        if (inputEmail === "") {
            email.classList.remove("is-invalid");
          
        }
        else if (inputEmail.length>0){
            email.classList.remove("is-invalid");
        }
    });
    sex.addEventListener("change", function() {
        sex.classList.remove("is-invalid");
        errorSex.style.display = "none";
    });
    address.addEventListener("input", function() {
        const inputAddress= address.value.trim();
        errorAddress.style.display = "none";
        if (inputAddress === "") {
            address.classList.remove("is-invalid");
          
        }
        else if (inputAddress.length>0){
            address.classList.remove("is-invalid");
        }
    });
    idSelfie.addEventListener("change", function () {
        // Remove the is-invalid class when the file button is clicked
        idSelfie.classList.remove("is-invalid");
    });

    validId.addEventListener("change", function () {
        // Remove the is-invalid class when the file button is clicked
        validId.classList.remove("is-invalid");
    });

    chkbox.addEventListener("click", function () {
        if (chkbox.checked) {
            dpa.style.color = "";
            console.log("Checkbox is checked");
            errorTerms.style.display = "none";
        }
    });
});