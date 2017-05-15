<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
<style>
    #video_screen
    {
        height: 480px;
        width: 640px;
        border-style: groove;
        position: relative;
    }

    #template
    {
        position: absolute;
        z-index: 1;
        height: 50px;
        width: 50px;
    }

    #video
    {
        height: 480px;
        width: 640px;
    }

    #video_screen
    {
        height: 480px;
        width: 640px;
        position: relative;
    }

    #canvas
    {
        height: 480px;
        width: 640px;
    }

    #temp
    {
     display: none;
    }

    .dell_button
    {
        position: absolute;
    }


</style>
    <script src="../js/user.js"></script>
</head>
<body>

<div id="video_frame">
    <div id="video_screen">
        <img id="template">
        <video poster="../../img/no-photo.png" id="video" width="640" height="480" autoplay></video>
    </div>
    <input type="button" onclick="makePhoto()" value="snap photo">
    <input type="button" onclick="backToVideo()" value="back to camera">

    <div id="upload">
        <input id="uploud_button" type="file" value="upload foto" onchange="placeImage(this)">
    </div>

</div>



<div id="preview_frame">
    <canvas id="canvas" width="640" height="480"></canvas>
    <input type="button" onclick="savePhoto()" placeholder="save photo">
</div>


<div id="template_gallery">
    <img src="../../img/42.png" onclick="addTemplate(this)">
</div>

<div id="photo_gallery">
</div>


</body>
</html>

