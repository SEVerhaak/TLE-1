document.getElementById('file-upload').addEventListener('change', function() {
    const formData = new FormData(document.getElementById('upload-form'));

    fetch('account.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Er is een fout opgetreden bij het uploaden van de afbeelding.');
        });
});
