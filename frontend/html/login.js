async function validateForm() {
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value.trim();
    const errorMessage1 = document.getElementById('error-message1');
    const errorMessage2 = document.getElementById('error-message2');

    // Clear previous errors
    errorMessage1.innerText = '';
    errorMessage2.innerText = '';

    // Basic validation
    if (!email || !password) {
        errorMessage2.innerText = 'Please fill in all fields';
        return;
    }

    try {
        const response = await fetch('http://localhost/registration/backend/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password
            }),
            credentials: 'include'
        });

        // Check for HTTP errors
        if (!response.ok) {
            const errorData = await response.json().catch(() => ({}));
            throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        console.log('Login response:', data);

        if (data.status === "success") {
            // Redirect to dashboard or home page
            window.location.href = "costsharing.html";
        } else {
            errorMessage2.innerText = data.message || 'Login failed';
        }
    } catch (error) {
        console.error('Login error:', error);
        errorMessage2.innerText = error.message || 'Login failed. Please try again.';
    }
}