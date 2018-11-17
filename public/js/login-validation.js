var app_root = $('#app_url').val();
$(document).ready(function () {
    $('#login').validate({
        onkeyup: false,
        errorClass: 'error',
        validClass: 'valid',
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            email: {
                required: 'Please Enter Email'
            },
            password: {
                required: 'Please type Password'
            }
        },
        highlight: function (element) {
            $(element).closest('div').addClass("f_error");
        },
        unhighlight: function (element) {
            $(element).closest('div').removeClass("f_error");
        },
        errorPlacement: function (error, element) {
            $(element).closest('div').append(error);
        },
        submitHandler: function () {
            $.ajax({
                url: app_url + "/api/login",
                type: "POST",
                data: JSON.stringify({
                    //"user": {
                    "email": $('#email').val(),
                    "password": $('#password').val(),
                    "_token": $("input[name='_token']").val(),
                    //}
                }),
                dataType: "JSON",
                success: function (response, textStatus, request) {
                    if (response.status == 1) {
                        var token = request.getResponseHeader('jwt_token');
                        createCookie('passTokenUser', token, 365);
                        createCookie("logged_out_status_user", "", -1);
                        window.location.href = app_url + "/home";
                    }
                    else {
                        $('.error').html(response.message);
                    }
                }
            });
        }
    })
});


function createCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}