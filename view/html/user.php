<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Make your photo</title>

    <link rel='stylesheet' type='text/css' href="view/css/login.css">
    <link rel='stylesheet' type='text/css' href="view/css/header.css">
    <link rel='stylesheet' type='text/css' href="view/css/footer.css">
    <link rel='stylesheet' type='text/css' href="view/css/user.css">

    <script src="view/js/user.js"></script>
    <script src="view/js/category.js"></script>

</head>
<body>

<?php include root . "/view/html/header.php" ?>

<div id="main_wrapper">


    <div id="video_content">

        <div id="video_frame">

            <div id="video_screen">

                <img id="template">

                <video poster="img/no-photo.png" id="video" width="640" height="480" autoplay></video>

            </div>

            <div id="video_buttons">

                <div onclick="makePhoto()">snap photo</div>

                <div onclick="backToVideo()" >back to camera</div>

                <div onclick="getUploadButton()">upload foto</div>

                <input id="upload_button" type="file" value="upload foto" onchange="placeImage(this)">

            </div>

        </div>


        <div id="preview_frame">

            <canvas id="canvas" width="640" height="480"></canvas>

            <input type="button" onclick="savePhoto()" placeholder="save photo">

        </div>
    </div>

    <div id="template_gallery">
        <div class="template_menu" id="animals">animals</div>
        <div class="category_content" id="category_animals">
            <img src="img/animals/1.png" width="100" height="100">
            <img src="img/animals/2.png" width="100" height="100">
        </div>
        <div class="template_menu" id="drinks">drinks</div>
        <div class="category_content" id="category_drinks">
            <img src="img/drinks/1.png" width="100" height="100">
            <img src="img/drinks/2.png" width="100" height="100">
            <img src="img/drinks/3.png" width="100" height="100">
            <img src="img/drinks/4.png" width="100" height="100">
            <img src="img/drinks/5.png" width="100" height="100">
        </div>
        <div class="template_menu" id="food">food</div>
        <div class="category_content" id="category_food">
            <img src="img/food/1.png" width="100" height="100">
            <img src="img/food/2.png" width="100" height="100">
        </div>
        <div class="template_menu" id="other">other</div>
        <div class="category_content" id="category_other">
            <img src="img/other/1.png" width="100" height="100">
        </div>

    </div>

    <div id="photo_gallery">

    </div>
</div>

<?php include root . "/view/html/footer.php" ?>


</body>
</html>

