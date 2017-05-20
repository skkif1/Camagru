<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Make your photo</title>

    <link rel='stylesheet' type='text/css' href="view/css/login.css">
    <link rel='stylesheet' type='text/css' href="view/css/header.css">
    <link rel='stylesheet' type='text/css' href="view/css/footer.css">
    <link rel='stylesheet' type='text/css' href="view/css/user.css">

    <script src="view/js/header.js"></script>
    <script src="view/js/user.js"></script>
    <script src="view/js/category.js"></script>
    <script src="view/js/template_nav.js"></script>

</head>
<body>

<?php include root . "/view/html/header.php" ?>

<div id="wrapper">

    <div id="video_content">

        <div id="video_frame">

            <div id="video_screen">

                <img id="template">

                <video poster="img/no-photo.png" id="video" autoplay></video>

            </div>

            <div id="template_nav">
                <div class="template_nav_butt" id="height_up" onclick="changeHeight(1)">&uarr;</div>
                <div class="template_nav_butt" id="height_down" onclick="changeHeight(2)">&darr;</div>
                <div class="template_nav_butt" id="width_up" onclick="changeWidth(1)">&rarr;</div>
                <div class="template_nav_butt" id="width_down" onclick="changeWidth(2)">&larr;</div>
                <div class="template_nav_butt" id="hide" onclick="hideTemplate()">X</div>
            </div>
            <div id="video_buttons">

                <div class="video_nav" id="snap" onclick="error()" >snap photo</div>
                <div id="template_error">You need choose template image first</div>

                <div class="video_nav" id="back" >back to camera</div>

                <div class="video_nav" onclick="getUploadButton()">upload foto</div>

                <input id="upload_button" type="file" value="upload foto" onchange="placeImage(this)">

            </div>

        </div>


        <div id="preview_frame">

            <canvas id="canvas" width="640" height="480"></canvas>

            <div class="preview_nav" id="send_photo">save photo</div>

        </div>
    </div>

    <div id="template_gallery">
        <div class="template_menu" id="animals">animals</div>
        <div class="category_content" id="category_animals">
            <img class="template_img" src="img/animals/1.png" width="100" height="100">
            <img class="template_img" src="img/animals/2.png" width="100" height="100">
        </div>
        <div class="template_menu" id="drinks">drinks</div>
        <div class="category_content" id="category_drinks">
            <img class="template_img" src="img/drinks/1.png" width="100" height="100">
            <img class="template_img" src="img/drinks/2.png" width="100" height="100">
            <img class="template_img" src="img/drinks/3.png" width="100" height="100">
            <img class="template_img" src="img/drinks/4.png" width="100" height="100">
            <img class="template_img" src="img/drinks/5.png" width="100" height="100">
        </div>
        <div class="template_menu" id="food">food</div>
        <div class="category_content" id="category_food">
            <img class="template_img" src="img/food/1.png" width="100" height="100">
            <img class="template_img" src="img/food/2.png" width="100" height="100">
        </div>
        <div class="template_menu" id="other">other</div>
        <div class="category_content" id="category_other">
            <img class="template_img" src="img/other/1.png" width="100" height="100">
        </div>

    </div>

    <div id="photo_gallery">

    </div>
</div>
<?php include root . "/view/html/footer.php" ?>


</body>
</html>

