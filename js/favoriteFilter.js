const checkbox = document.getElementById('show-favorites-only');
const historySections = document.querySelectorAll('.history');

checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        historySections.forEach((section) => {
            if (!section.classList.contains('color-box-history-favourite')) {
                section.style.display = 'none';
            }
        });
    } else {
        historySections.forEach((section) => {
            section.style.display = 'flex';
        });
    }
});