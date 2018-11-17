function createCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function eraseCookie(name) {
    createCookie(name, "", -1);
    createCookie('logged_out_status', '', -1);
    window.location.href = app_url + "/login";
}

setTimeout(function() {
    $(".alert_message").hide('blind', {}, 500)
}, 3000);