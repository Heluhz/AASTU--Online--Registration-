document.addEventListener('DOMContentLoaded', function() {
    // Get both tables
    const semesterCoursesTable = document.getElementById('semester-courses');
    const availableCoursesTable = document.getElementById('available-courses');
    
    // Add event delegation to both tables
    semesterCoursesTable.addEventListener('click', handleTableClick);
    availableCoursesTable.addEventListener('click', handleTableClick);
    
    function handleTableClick(event) {
        const target = event.target;
        
        // Check if a drop button was clicked in semester courses table
        if (target.classList.contains('drop-button')) {
            moveRow(target, semesterCoursesTable, availableCoursesTable, 'add-button', 'Add');
        } 
        // Check if an add button was clicked in available courses table
        else if (target.classList.contains('add-button')) {
            moveRow(target, availableCoursesTable, semesterCoursesTable, 'drop-button', 'Drop');
        }
    }
    
    function moveRow(button, sourceTable, destinationTable, newButtonClass, newButtonText) {
        // Get the parent row
        const row = button.closest('tr');
        
        // Clone the row (to avoid reference issues)
        const newRow = row.cloneNode(true);
        
        // Update the action cell with new button
        const actionCell = newRow.querySelector('td:last-child');
        actionCell.innerHTML = '';
        
        // Create new button
        const newButton = document.createElement('button');
        newButton.className = `action-btn ${newButtonClass}`;
        newButton.textContent = newButtonText;
        actionCell.appendChild(newButton);
        
        // Remove from source table
        row.remove();
        
        // Add to destination table
        destinationTable.querySelector('tbody').appendChild(newRow);
        
        // Optional: Animation for visual feedback
        newRow.style.opacity = '0';
        setTimeout(() => {
            newRow.style.transition = 'opacity 0.3s ease';
            newRow.style.opacity = '1';
        }, 10);
    }
});