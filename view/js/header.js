
function toAcount()
{
    var data = {
        action : "Check"
    };
    sendAjaxUser(data, function () {

        if (this.readyState == 4 && this.status == 200)
        {
            var resp = JSON.parse(this.responseText);
            if (resp.response != false)
                window.location.href = '/Camagru/user';
            else
            {
                console.log('logout');
            }

        }
    });
}

function logout() {

    data = {
      name:'Logout'
    };

    request = new XMLHttpRequest();
    request.open('POST', '/Camagru/login');
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.responseText);
        }
    };
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
    window.location.href = "/Camagru/";
    checkLogin();
}

function checkLogin()
{
    data = {
        name:'Check'
    };

    request = new XMLHttpRequest();
    request.open('POST', '/Camagru/login');
    request.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var server = JSON.parse(this.responseText);
            var logout = document.getElementById('logout');
            var acount = document.getElementById('acount');

            if (server.response != 'false')
            {
                acount.innerHTML = server.response;
                acount.style.display = 'flex';
            }else
            {
                logout.innerHTML = 'Log in';
                logout.style.background = 'white';
                logout.style.color = 'black';
                logout.addEventListener('click', function () {
                  window.location.href = '/Camagru/login'
                });
                acount.style.display = 'none';
            }
        }
    };
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
}

function sendAjaxUser(dataSend, callback)
{
    request = new XMLHttpRequest();
    var data = dataSend;
    request.open('POST', '/Camagru/user');
    request.onreadystatechange = callback;
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
}

function toMain()
{
    window.location.href = '/Camagru/';
}