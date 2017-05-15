function toAcount()
{
    var data = {
        action : "check"
    };
    sendAjaxUser(data, function () {

        if (this.readyState == 4 && this.status == 200)
        {
            var resp = JSON.parse(this.responseText);
            if (resp.response == 'true')
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
}

function sendAjaxUser(dataSend, callback,)
{
    request = new XMLHttpRequest();
    var data = dataSend;
    request.open('POST', '/Camagru/user');
    request.onreadystatechange = callback;
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
}
