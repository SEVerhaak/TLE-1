document.addEventListener('DOMContentLoaded', function() {
    const historySections = document.querySelectorAll('.history');

    historySections.forEach(function(section) {
        section.addEventListener('click', myfunction);
    });
});

function myfunction() {
    // Vind het <a>-element binnen het geklikte section element
    const link = this.querySelector('a');

    // Check of de <a> bestaat en haal de href op
    if (link) {
        const href = link.getAttribute('href');

        // Navigeer naar de opgehaalde link
        window.location.href = href;
    } else {
        alert('Geen link gevonden');
    }
}

