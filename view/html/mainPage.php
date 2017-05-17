<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Camagru</title>
    <link rel="stylesheet" type="text/css" href="view/css/mainPage.css">
</head>

<body>

<div id="main-wrapper">
    <?php include(root . "/view/html/header.php") ?>

<div id="content">
    <div id="error"></div>
    <div id="gallery">
        <div id="more_button" onclick="placePosts()">show more</div>
    </div>

</div>

    <?php include(root . "/view/html/footer.php") ?>

</div>

</body>

<script src="view/js/mainPage.js"></script>
<script src="view/js/header.js"></script>

</html>