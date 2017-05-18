window.onload = function () {
    var template = document.getElementById('template');

    template.addEventListener('mousedown', moveTemplate);

    fillGallery();
    clearPreview();

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.src = window.URL.createObjectURL(stream);
            video.play();
        });
    }

    var templates = document.getElementsByClassName('template_img');
    for (var i = 0; i < templates.length; i++)
        templates[i].addEventListener('click', addTemplate);

    var templateContents = document.getElementsByClassName('template_menu');

    for (var i = 0; i < templateContents.length; i++)
        templateContents[i].addEventListener('click', display);
};


function backToVideo() {
    var video = document.getElementById('temp');
    var image = document.getElementById('video');
    var backToCamera = document.getElementById('back');

    video.setAttribute('id', 'video');
    image.setAttribute('id', 'temp');
    backToCamera.style.opacity = '0.4';
    backToCamera.removeEventListener('click', backToVideo);
}

//upload photo from local

function placeImage(input) {
    var backToCamera = document.getElementById('back');
    var upload_image = document.createElement('img');
    var video_screen = document.getElementById('video_screen');
    var real_video = document.getElementById('video');
    var reader = new FileReader();

    backToCamera.style.opacity = '1';
    backToCamera.addEventListener('click', backToVideo);

    reader.onload = function (load) {
        real_video.setAttribute('id', 'temp');
        var dataUrl = load.target.result;
        upload_image.src = dataUrl;

        upload_image.setAttribute('id', 'video');
        video_screen.appendChild(upload_image);
    };
    reader.readAsDataURL(input.files[0]);
}

function clearPreview() {
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var image = document.createElement('img');
    image.src = 'img/no-photo.png';
    context.drawImage(image, 0, 0, parseInt(canvas.width), parseInt(canvas.height));
}

function removeImage() {
    var parent_id = this.parentElement.id;
    data = {
        action: 'remove',
        id: parent_id
    };
    sendAjaxUser(data, function () {

        if (this.readyState == 4 && this.status) {
            var resp = JSON.parse(this.responseText);
            if (resp.response == 'error')
                console.log("db Error");
            var photo = document.getElementById(parent_id);
            photo.style.display = 'none';
        }
    })
}

function fillGallery() {
    data = {
        action: 'getFotos'
    };

    sendAjaxUser(data, function () {
        if (this.readyState == 4 && this.status == 200) {
            var resp = JSON.parse(this.responseText);
            if (resp.response) {
                for (var i = 0; i < resp.response.length; i++) {
                    var photo = resp.response[i];
                    addGalleryPhoto(photo.id, photo.src)
                }
            }
        }
    })
}

// add foto to main gallery dynamicly created

function addGalleryPhoto(id, src) {
    var photo_gallery = document.getElementById('photo_gallery');
    var image_wrapper = document.createElement('div');
    var photo = document.createElement('img');
    var dell_button = document.createElement('div');

    image_wrapper.setAttribute('class', 'gallery_image');
    image_wrapper.setAttribute('id', id);
    photo.setAttribute('src', src);
    dell_button.setAttribute('class', 'dell_button');
    dell_button.innerHTML = 'X';
    dell_button.addEventListener('click', removeImage);
    photo_gallery.insertBefore(image_wrapper, photo_gallery.firstChild);
    image_wrapper.appendChild(dell_button);
    image_wrapper.appendChild(photo);

}

function savePhoto() {
    var canvas = document.getElementById('canvas');
    var photo = canvas.toDataURL('img/jpeg', 1);
    var sendPhoto = document.getElementById('send_photo');

    data = {
        action: 'save',
        img: photo
    };

    sendAjaxUser(data, function () {
        if (this.readyState == 4 && this.status == 200) {
            var resp = JSON.parse(this.responseText);
            if (resp.response == 'error')
                console.log("db Problem");
            addGalleryPhoto(resp.response, photo)
        }
    });
    clearPreview();
    sendPhoto.removeEventListener('click', savePhoto);
    sendPhoto.style.opacity = '0.4';
}


function sendAjaxUser(data, callback) {
    request = new XMLHttpRequest();
    request.onreadystatechange = callback;
    request.open('POST', '/Camagru/user');
    request.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');
    request.send(JSON.stringify(data));
}

function makePhoto() {
    var sendPhoto = document.getElementById('send_photo');
    var template = document.getElementById('template');
    var video = document.getElementById('video');
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');

    context.drawImage(video, 0, 0, 640, 480);
    context.drawImage(template, parseInt(template.style.left), parseInt(template.style.top),
        parseInt(template.width), parseInt(template.height));
    sendPhoto.addEventListener('click', savePhoto);
    sendPhoto.style.opacity = '1';
}

function moveTemplate(event) {

    var template = document.getElementById('template');
    var video_frame = document.getElementById('video_screen');

    var left = event.pageX - template.offsetWidth / 2 - video_frame.getBoundingClientRect().left + 'px';
    var top = event.pageY - template.offsetHeight / 2 - video_frame.getBoundingClientRect().top + 'px';

    var intTop = parseInt(top);
    var intLeft = parseInt(left);

    if (intTop < video_frame.offsetHeight - template.offsetHeight &&
        intTop > 0 &&
        intLeft < video_frame.offsetWidth - template.offsetWidth &&
        intLeft > 0) {
        template.style.left = left;
        template.style.top = top;
    }

    document.onmousemove = function (event) {
        moveTemplate(event);
    };

    template.ondragstart = function () {
        return false;
    };

    template.onmouseup = function () {
        document.onmousemove = null;
        template.onmouseup = null;
    };
}

function addTemplate(event) {
    var img = event.target;
    var template = document.getElementById('template');
    var snap = document.getElementById('snap');
    template.setAttribute('src', img.src);
    template.style.display = 'block';
    snap.addEventListener('click', makePhoto);
    snap.style.opacity = '1';
}