$(document).ready(function () {
    // Assume you have stored the user's email in local storage during login
    var userEmail = localStorage.getItem('userEmail');

    if (userEmail) {
        // Fetch user details based on email
        $.ajax({
            type: 'GET',
            url: '/Shashank-s_Guvi_Assignment/php/profile.php',
            data: { email: userEmail },
            success: function (response) {
                if (response.status === 'success') {
                    var user = response.user;

                    // Update the HTML with user details
                    $('#id').text(user.id);
                    $('#firstName').text(user.firstName);
                    $('#lastName').text(user.lastName);
                    $('#gender').text(user.gender);
                    $('#DOB').text(user.DOB);
                    $('#address').text(user.address);
                    $('#postCode').text(user.postCode);
                    $('#country').text(user.country);
                    $('#email').text(user.email);
                    $('#phoneNumber').text(user.phoneNumber);
                    $('#password').text(user.password); // Note: This should be handled securely in a real application
                    $('#confirmPassword').text(user.confirmPassword);
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, '-', error);
            }
        });
    } else {
        console.error('User email not found in local storage.');
    }
});
