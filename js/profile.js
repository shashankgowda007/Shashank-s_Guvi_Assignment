$(document).ready(function () {
    // Assume you have stored the user's email in local storage during login
    // Assume you have stored the user's email in local storage during login
    var userEmail = localStorage.getItem('userEmail');

    if (userEmail) {
        // Fetch user details based on email
        $.ajax({
            type: 'GET',
            url: '/Shashank-s_Guvi_Assignment/php/profile.php',
            data: { email: userEmail },
            success: function (response) {
                var user = JSON.parse(response);

                // Update the HTML with user details
                $('#firstName').text(user.firstName);
                $('#lastName').text(user.lastName);
                $('#address').text(user.address);
                $('#postCode').text(user.postCode);
                $('#country').text(user.country);
                $('#email').text(user.email);
                $('#phoneNumber').text(user.phoneNumber);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, '-', error);
            }
        });
    } else {
        console.error('User email not found in local storage.');
    }

});
