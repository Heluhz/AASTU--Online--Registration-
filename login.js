function validateForm() {
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorMessage1 = document.getElementById('error-message1');
    const errorMessage2 = document.getElementById('error-message2');

    // Clear previous error messages
    errorMessage1.innerText = '';
    errorMessage2.innerText = '';

    // Email validation for institutional email
    const emailPattern = /^[a-zA-Z0-9._%+-]+@aastustudent\.edu\.et$/; // Adjust domain as needed
    if (!emailPattern.test(email)) {
        errorMessage1.innerText = 'Please enter a valid institutional email.';
        return;
    }

    // Password validation
    const strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!strongPasswordPattern.test(password)) {
        errorMessage2.innerText = 'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.';
        return;
    }

    // Successful validation action
    alert('Login successful!');
    window.location.href = 'index.html'; // Redirect to the index page
}
