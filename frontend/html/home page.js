document.querySelector('.dropdown').addEventListener('click', function(event) {
    event.stopPropagation();
    const dropdownMenu = this.querySelector('.dropdown-menu');
    dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

document.addEventListener('click', function() {
    const openDropdown = document.querySelector('.dropdown-menu');
    if (openDropdown) openDropdown.style.display = 'none';
});

// Allow pressing Enter to trigger search
searchInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        searchButton.click();
    }
});


// Search function to filter and display results on the same page
function performSearch() {
    const searchInput = document.getElementById('search-input').value.trim().toLowerCase();
    const resultsContainer = document.getElementById('results-container');

    if (!searchInput) {
        alert("Please enter a search term.");
        return;
    }

    // Example items to search from (can be dynamically generated)
    const data = [
        { title: "Our Vision", link: "vision.html" },
        { title: "Our Mission", link: "mision.html" },
        { title: "Contact Us", link: "contact.html" },
        { title: "Help", link: "help.html" },
        { title: "Undergraduate Programs", link: "undergraduate.html" },
        { title: "Postgraduate Programs", link: "postgraduate.html" }
    ];

    // Filter results based on search input
    const filteredResults = data.filter(item => item.title.toLowerCase().includes(searchInput));

    // Display filtered results
    if (filteredResults.length > 0) {
        filteredResults.forEach(result => {
            const userConfirmed = confirm(`Result found: "${result.title}". Click OK to go to this page.`);
            if (userConfirmed) {
                window.location.href = result.link;
            }
        });
    } else {
        alert(`No results found for ${searchInput}`);

    }
}