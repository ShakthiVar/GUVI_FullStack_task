function submitProfile() {
    var dateOfBirth = $('#date').val();
    var contact = $('#contact').val();

    if (!dateOfBirth || !contact) {
        $('#error-message').text('Please fill in all fields.').show();
        return;
    }

    $.ajax({
        url: 'php/profile.php',
        type: 'POST',
        data: {
            'dateOfBirth': dateOfBirth,
            'contact': contact
        },
        dataType: 'json',
        success: function(response) {
            alert(response.message);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            alert('Error: ' + status + ' - ' + error);
        }
    });
}
