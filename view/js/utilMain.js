function hideCommentWrapper(event)
{
    event.target.parentNode.style.display = 'none';
    comment_display = 0;
}


function ratePost(event)
{
    data = {
        action: 'rate',
        id: event.target.parentNode.parentNode.id
    };

    sendAjaxMain(data, function () {
        if (this.readyState == 4 && this.status == 200) {
            var server = JSON.parse(this.responseText);

            if (server.response == 'logout') {
                displayError("you need to be log in to rate photo");
                return ;
            }
            event.target.value = "like " + server.response.rate;
        }
    })
}

function toHeader()
{
    window.location.href = '#header';
}
