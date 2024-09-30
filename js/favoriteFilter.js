const checkbox = document.getElementById('show-favorites-only');
const historySections = document.querySelectorAll('.history');

const searchBar = document.getElementById('search-bar');
const searchResults = document.getElementById('search-results');

checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        historySections.forEach((section) => {
            if (!section.classList.contains('color-box-history-favourite')) {
                section.style.display = 'none';
            }
        });
    } else {
        historySections.forEach((section) => {
            section.style.display = 'block';
        });
    }
});

searchBar.addEventListener('input', (e) => {
    const searchTerm = e.target.value.toLowerCase();
    const results = searchResults.children;

    for (let i = 0; i < results.length; i++) {
        const productName = results[i].querySelector('h3').textContent.toLowerCase();
        if (productName.includes(searchTerm)) {
            results[i].style.display = 'block';
        } else {
            results[i].style.display = 'none';
        }
    }
});