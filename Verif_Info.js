document.addEventListener("DOMContentLoaded", function() {
    const signupForm = document.querySelector("#signupModal form");

    // Validate the form on submission
    signupForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from being submitted until validation is complete

        let valid = true;
        const name = document.getElementById("signupName").value.trim();
        const email = document.getElementById("signupEmail").value.trim();
        const password = document.getElementById("signupPassword").value.trim();

        // Validate full name (cannot be empty)
        if (name === "") {
            alert("Full Name is required");
            valid = false;
        }

        // Validate email format
        if (!validateEmail(email)) {
            alert("Please enter a valid email address");
            valid = false;
        }

        // Validate password strength
        if (!validatePassword(password)) {
            alert("Password must be at least 8 characters long, contain at least one uppercase letter, one lowercase letter, and one number");
            valid = false;
        }

        if (valid) {
            signupForm.submit(); // Submit the form if all validations pass
        }
    });

    // Function to validate email format
    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    // Function to validate password strength
    function validatePassword(password) {
        const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
        return passwordPattern.test(password);
    }

    // Event listener for password field to check strength as the user types
    const passwordInput = document.getElementById("signupPassword");

    // When the password field loses focus, check if it's empty
    passwordInput.addEventListener("blur", function() {
        if (passwordInput.value.trim() === "") {
            alert("Password cannot be empty");
        }
    });

    // Change the color and display strength when the user types the password
    passwordInput.addEventListener("input", function() {
        const password = passwordInput.value;
        const strengthIndicator = document.getElementById("password-strength-indicator");

        // Check password strength and apply styles accordingly
        if (password.length === 0) {
            strengthIndicator.textContent = "";
            passwordInput.style.borderColor = "";
            passwordInput.style.backgroundColor = "";
        } else if (password.length < 8) {
            strengthIndicator.textContent = "Weak password";
            strengthIndicator.style.color = "red";
            passwordInput.style.borderColor = "red";
            passwordInput.style.backgroundColor = "#f8d7da"; // Light red
        } else if (validatePassword(password)) {
            strengthIndicator.textContent = "Strong password";
            strengthIndicator.style.color = "green";
            passwordInput.style.borderColor = "green";
            passwordInput.style.backgroundColor = "#d4edda"; // Light green
        } else {
            strengthIndicator.textContent = "Medium strength password";
            strengthIndicator.style.color = "orange";
            passwordInput.style.borderColor = "orange";
            passwordInput.style.backgroundColor = "#fff3cd"; // Light yellow
        }
    });
});
