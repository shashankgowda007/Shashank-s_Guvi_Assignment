document.addEventListener('DOMContentLoaded', function () {
    // Assuming you have a form with the id 'mongoForm'
    document.getElementById('mongoForm').addEventListener('submit', function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        // Send data to the server using fetch
        fetch('/path-to/mongo.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            })
            .catch(error => {
                console.error('Fetch error:', error.message);
            });
    });
});
