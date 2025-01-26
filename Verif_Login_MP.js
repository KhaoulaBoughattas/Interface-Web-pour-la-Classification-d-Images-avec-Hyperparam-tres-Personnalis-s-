document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.querySelector("#loginModal form");

    // Validate the form on submission
    loginForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from being submitted until validation is complete

        let valid = true;
        const email = document.getElementById("loginEmail").value.trim();
        const password = document.getElementById("loginPassword").value.trim();

        // Validate email
        if (!validateEmail(email)) {
            alert("Please enter a valid email address");
            valid = false;
        }

        // Validate password
        if (password === "") {
            alert("Password is required");
            valid = false;
        }

        if (valid) {
            loginForm.submit(); // Submit the form if all validations pass
        }
    });

    // Function to validate email format
    function validateEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
});
