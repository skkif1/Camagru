window.onload = function () {

    placePosts();
};

function sendMessage()
{
    var post = document.getElementById(this.parentNode.parentNode.id);
    var input = post.getElementsByClassName('comments')[0];

    if (input.value == '')
        alert("em");

    data = {
        action:'message',
        text: input.value,
        id: post.id
    };

    sendAjaxMain(data, function(){
            if (this.readyState == 4 && this.status == 200)
            {
                var server = JSON.parse(this.responseText);
                if (server.response != 'logout')
                    addComment(post, server.response.message, server.response.user);
                else
                    displayError("you need to be log in to comment this photo");

                var comment = post.getElementsByClassName('comment_wrapper')[0];
                var addButton = comment.parentNode.getElementsByClassName('add_comment')[0];
                addButton.style.display = 'block';
                comment.parentNode.removeChild(comment);
            }
    });
}

function displayComments(event)
{
    var post = event.target.parentNode;

    data = {
        action: 'showComments',
        id: post.id
    };

    sendAjaxMain(data, function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var server = JSON.parse(this.responseText);
            if (server.response)
            {
                for (var i = 0; i < server.response.length; i++)
                {
                    addComment(post, server.response[i].text, server.response[i].author);
                }
            }
        }
    });
    var button = post.getElementsByClassName('show_comments')[0];
    button.value = "hide comments";
    button.removeEventListener('click', displayComments);
    button.addEventListener('click', hideComments);
}


function hideComments(event) {
    var post = event.target.parentNode;

    var comment_section = post.getElementsByClassName('comment_section')[0];
    while (comment_section.firstChild)
    {
        comment_section.removeChild(comment_section.firstChild);
    }

    event.target.value = "show comments";
    event.target.removeEventListener('click', hideComments);
    event.target.addEventListener('click', displayComments);

}

function addComment(post, message, login)
{
    var user = document.createElement('div');
    var comment = document.createElement('div');
    var comment_wrapper = document.createElement('div');

    user.innerHTML = login;
    comment.innerHTML = message;
    comment_wrapper.appendChild(user);
    comment_wrapper.appendChild(comment);
    var comments_section = post.getElementsByClassName('comment_section')[0];
    comments_section.insertBefore(comment_wrapper, comments_section.firstChild);
}

function postComment(event)
{
    var wrapper = document.createElement('div');
    var post = document.getElementById(event.target.parentNode.id);
    var input = document.createElement('input');
    var send = document.createElement('input');

    send.type = 'button';
    send.value = 'send..';
    send.addEventListener('click', sendMessage);
    input.type = 'textarea';
    wrapper.setAttribute('class', 'comment_wrapper');
    input.setAttribute('class', 'comments');
    wrapper.appendChild(input);
    wrapper.appendChild(send);
    post.insertBefore(wrapper, post.children[2]);
    event.target.style.display = 'none';
}

function addImage(src, id)
{
    var gallery = document.getElementById('gallery');
    var post = document.createElement('div');
    var image = document.createElement('img');
    var commentButoon = document.createElement('input');
    var comment_section = document.createElement('div');
    var addComment = document.createElement('input');


    image.src = src;
    post.className = 'posts';
    post.id = id;
    addComment.type = 'button';
    addComment.value = 'add comment';
    addComment.setAttribute('class', 'add_comment');
    addComment.addEventListener('click',postComment);
    commentButoon.value = 'show comments';
    commentButoon.setAttribute('class', 'show_comments');
    commentButoon.addEventListener('click', displayComments);
    commentButoon.type = 'button';
    comment_section.setAttribute('class', 'comment_section');
    post.appendChild(image);
    post.appendChild(document.createElement('hr'));
    post.appendChild(addComment);
    post.appendChild(commentButoon);
    post.appendChild(comment_section);
    gallery.appendChild(post);
}

function placePosts() {

    var gallery = document.getElementById('gallery');

    data = {
        action:'all',
        offset: gallery.childElementCount
    };

    sendAjaxMain(data, function () {
       if (this.readyState == 4 && this.status == 200)
       {
           var server = JSON.parse(this.responseText);
           if (server.response)
           for (var i = 0; i < server.response.length; i++)
           {
               addImage(server.response[i].src, server.response[i].id);
           }
       }
    });
}


function sendAjaxMain(dataSend, callback)
{
    request = new XMLHttpRequest();
    var data = dataSend;
    request.open('POST', '/Camagru/main');
    request.onreadystatechange = callback;
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
}

function displayError(msg)
{
    var error = document.getElementById('error');
    error.innerHTML = msg;
    error.style.display = 'block';
    setTimeout(function () {
        error.style.display = 'none';
    }, 2000);
}