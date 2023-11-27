function submitRegistration() {
    var username = $('#username').val();
    var email = $('#email').val();
    var password = $('#password').val();

    // Use a regular expression to validate email format
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!username || !email || !password) {
        $('#error-message').text('Please fill in all fields.').show();
        return;
    } else if (!emailRegex.test(email)) {
        $('#error-message').text('Please enter a valid email address.').show();
        return;
    }

    $.ajax({
        url: 'php/register.php',
        type: 'POST',
        data: {
            'username': username,
            'email': email,
            'password': password
        },
        success: function(response) {
            if (response.error) {
                $('#error-message').text(response.error).show();
            } else {
                alert(response.message);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}
