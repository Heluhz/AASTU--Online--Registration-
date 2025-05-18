  // Select all checkboxes with the class 'checkbox-button'
    const checkboxes = document.querySelectorAll('.checkbox-button');

    // Loop through each checkbox and add an event listener
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('click', function() {
            // Check if the checkbox is checked
            if (checkbox.checked) {
                // Remove the parent row
                const row = checkbox.closest('tr');
                if (row) {
                    row.remove();
                }
            }
        });
    });