window.onload = function () {

    checkLogin();
    placePosts();
};

var comment_display = 0;

function sendMessage()
{
    var post = this.parentNode.parentNode;
    var input = post.getElementsByClassName('comments')[0];

    if (input.value == '')
        return ;

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
                {
                    if(post.getElementsByClassName('show_comments')[0].value != 'show comments')
                        post.getElementsByClassName('show_comments')[0].click();
                    post.getElementsByClassName('show_comments')[0].click();
                }else
                    displayError("you need to be log in to comment this photo");

                var comment = post.getElementsByClassName('comment_wrapper')[0];
                var addButton = comment.parentNode.getElementsByClassName('add_comment')[0];
                addButton.style.display = 'block';
                comment.parentNode.removeChild(comment);
                comment_display = 0;
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

function addComment(post, message, login)
{
    var user = document.createElement('div');
    var comment = document.createElement('div');
    var comment_wrapper = document.createElement('div');

    user.innerHTML = login;
    user.className = 'login';
    comment.innerHTML = message.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    comment.className = 'message';
    comment_wrapper.appendChild(user);
    comment_wrapper.appendChild(comment);
    var comments_section = post.getElementsByClassName('comment_section')[0];
    comments_section.insertBefore(comment_wrapper, comments_section.firstChild);
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


function postComment(event)
{
    var wrapper = document.createElement('div');
    var post = document.getElementById(event.target.parentNode.parentNode.id);
    var input = document.createElement('textarea');
    var send = document.createElement('input');
    var hide = document.createElement('input');

    if (comment_display == 1)
        return ;
    comment_display = 1;
    send.type = 'button';
    send.value = 'send..';
    hide.type = 'button';
    hide.value = 'hide';

    send.addEventListener('click', sendMessage);
    hide.addEventListener('click', hideCommentWrapper);

    input.rows = '2';
    input.cols = '40';
    input.maxLength = '128';
    wrapper.setAttribute('class', 'comment_wrapper');
    input.setAttribute('class', 'comments');
    hide.setAttribute('class', 'hide_comments');
    wrapper.appendChild(input);
    wrapper.appendChild(hide);
    wrapper.appendChild(send);
    post.insertBefore(wrapper, post.children[3]);
}

function addImage(src, id, rate)
{
    var gallery = document.getElementById('gallery');
    var post = document.createElement('div');
    var image = document.createElement('img');
    var likeSection = document.createElement('div');
    var commentButoon = document.createElement('input');
    var likeButton = document.createElement('input');
    var comment_section = document.createElement('div');
    var addComment = document.createElement('input');
    var like_src = 'like ' + rate;

    image.src = src;
    post.className = 'posts';
    post.id = id;
    addComment.type = 'button';
    addComment.value = 'add comment';
    addComment.setAttribute('class', 'add_comment');
    addComment.addEventListener('click', postComment);
    likeButton.type = 'button';
    likeButton.value = like_src;
    likeButton.addEventListener('click', ratePost);
    likeButton.className = 'like';
    likeSection.className = 'like_section';
    likeSection.appendChild(addComment);
    likeSection.appendChild(likeButton);
    commentButoon.value = 'show comments';
    commentButoon.setAttribute('class', 'show_comments');
    commentButoon.addEventListener('click', displayComments);
    commentButoon.type = 'button';
    comment_section.setAttribute('class', 'comment_section');
    post.appendChild(image);
    post.appendChild(document.createElement('hr'));
    post.appendChild(likeSection);
    post.appendChild(document.createElement('hr'));
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
                        addImage(server.response[i].src, server.response[i].id, server.response[i].rate);
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
    }, 4000);
}
