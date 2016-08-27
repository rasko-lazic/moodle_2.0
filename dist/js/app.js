
$('#login-button').click(function (e) {
    e.preventDefault();

    if($('#inputEmail').val().length == 0 || $('#inputPassword').val().length == 0) {
        showLoginAlert("Email and password fields must be filled.");
    } else {
        attemptLogin();
    }
});

function attemptLogin() {
    var email = $('#inputEmail').val();
    var password = $('#inputPassword').val();
    $.ajax({
        url: 'http://localhost/RT5614_Rasko_Lazic/moodle_v2.0/user/attempt',
        data: {
            email: email,
            password: password
        },
        method: 'POST',
        success: function (response) {
            window.location.replace("http://localhost/RT5614_Rasko_Lazic/moodle_v2.0/home");
        },
        error: function (response) {
            showLoginAlert(response.responseText);
        }
    });
}

function showLoginAlert(message) {
    $('#login-error-message').text(message);
    $('#login-error').addClass("in");
}