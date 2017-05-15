
var status = 1;

function validateSend()
{
    var login = '^[a-z0-9_-]{5,15}$';
    var pwd = '^(?=.*[a-z])(?=.*[0-9])(?=.{8,})';
    var email = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (document.getElementById("submit").value != "Change password" && document.getElementById("submit").value != "Reset password")
    if (!document.getElementById('login').value.match(login))
        failSignUp("login_status", "login must be 3-15 chars and can contain only a-z, 0-9, '-', '_'");
    if (document.getElementById("submit").value != "Reset password")
    if (!document.getElementById('password').value.match(pwd))
        failSignUp("password_status", "password must contain at least 1 lowercase alphabetical 1 numeric character and have length greater than 7");
    if (document.getElementById('submit').value == 'signUp')
    {
        if (document.getElementById('password_dup').value != document.getElementById('password').value)
            failSignUp("pussword_dup_status", "check password");
        if (!email.test(document.getElementById('email').value))
            failSignUp("email_status", "please enter valid email address");
    }
    if (document.getElementById('submit').value == 'Change password')
    {
        if (!document.getElementById('password_new').value.match(pwd))
            failSignUp("password_new_status", "password must contain at least 1 lowercase alphabetical 1 numeric character and have length greater than 7");
        if (document.getElementById('password_dup').value != document.getElementById('password_new').value)
        {
            failSignUp("pussword_dup_status", "check password");
        }
    }
    if (status == 1)
        sendRequest();
    status = 1;
}



function failSignUp(statusId, src)
{
    var elem = document.getElementById(statusId);
    elem.style.display = "block";
    elem.innerHTML = src;
    function hide()
    {
        elem.style.display = "none";
    }
    setTimeout(hide, 4000);
    status = 0;
}

function successSignUp(src)
{
    document.getElementById("form").style.display = "none";
    var elem = document.getElementById("success_login");
    elem.style.display = "block";
    elem.innerHTML = src;
}



