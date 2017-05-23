window.onload = function()
{
    document.getElementById("toSignUp").addEventListener('click', toSignUp);
    document.getElementById("toLogin").addEventListener('click', toLogin);
    document.getElementById("submit").addEventListener('click', validateSend);
    document.getElementById("toChange").addEventListener('click', toChange);
    document.getElementById("toReset").addEventListener('click', toReset);

    checkLogin();

    window.statu = 1;
};

var request;

function sendRequest() {

    var data = getFormData();
    var callback = signUpUser;
    sendAjax(data, callback);
}


function sendAjax(dataSend, callback)
{
    request = new XMLHttpRequest();
    var data = dataSend;

    request.open('POST', '/Camagru/login/');
    request.onreadystatechange = signUpUser;
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
}


function signUpUser()
{
    if(request.readyState == 4 && request.status == 200)
    {
        console.log(request.responseText);
        var resp = JSON.parse(request.responseText);
        switch(resp.response)
        {
            case 'signed':
                successSignUp("Confirmation link was sent to your email, please confirm your password");
                break ;
            case 'exist':
                failSignUp("main_status", "user allready exist");
                break;
            case 'dbProblem':
                failSignUp("main_status", "we have problems on server try again later");
                break;
            case 'login':
                window.location.replace('http://10.111.7.2:8080/Camagru/');
                break;
            case 'false':
                failSignUp("main_status", "no such user registered");
                break;
            case 'false_password':
                failSignUp("main_status", "wrong password");
                break;
            case 'change':
                successSignUp("your password was changed");
                break;
            case 'wrong password':
                failSignUp("main_status", "wrong password");
                break;
            case 'noUser':
                failSignUp("main_status", "no such user check your email");
                break;
            case 'send':
                successSignUp("your new password was send to your email");
                break;
        }
    }
}

function getFormData()
{
    var result = {
       name  : document.getElementById('submit').value,
       login : document.getElementById('login').value,
       password : document.getElementById('password').value,
        password_new : document.getElementById('password_new').value,
       email : document.getElementById('email').value
    };
    return result;
}


function toSignUp()
{
    document.getElementById("submit").value =  "signUp";
    var hiden = document.getElementsByClassName("signUp");
    var change = document.getElementsByClassName("change");

    for (var i = 0; i < change.length; i++)
    {
        var elem = change[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < hiden.length; i++)
    {
        var elem = hiden[i];
        elem.style.display = "block";
    }
}

function toLogin()
{
    document.getElementById("submit").value =  "Login";
    var hiden = document.getElementsByClassName("signUp");
    var res = document.getElementsByClassName("change");
    var log = document.getElementsByClassName("login");

    for (var i = 0; i < hiden.length; i++)
    {
        var elem = hiden[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < res.length; i++)
    {
        var elem = res[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < log.length; i++)
    {
        var elem = log[i];
        elem.style.display = "block";
    }
}

function toChange()
{
    document.getElementById("submit").value =  "Change password";
    var hiden = document.getElementsByClassName("signUp");
    var log = document.getElementsByClassName("login");
    var res = document.getElementsByClassName("change");

    for (var i = 0; i < hiden.length; i++)
    {
        var elem = hiden[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < log.length; i++)
    {
        var elem = log[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < res.length; i++)
    {
        var elem = res[i];
        elem.style.display = "block";
    }
}

function toReset()
{
    document.getElementById("submit").value =  "Reset password";
    var hiden = document.getElementsByClassName("signUp");
    var log = document.getElementsByClassName("login");
    var res = document.getElementsByClassName("change");
    var ch = document.getElementsByClassName("reset");

    for (var i = 0; i < hiden.length; i++)
    {
        var elem = hiden[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < log.length; i++)
    {
        var elem = log[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < res.length; i++)
    {
        var elem = res[i];
        elem.style.display = "none";
    }

    for (var i = 0; i < res.length; i++)
    {
        var elem = ch[i];
        elem.style.display = "flex";
    }
}




