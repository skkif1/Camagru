
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Welcome to Camagru</title>

    <link rel='stylesheet' type='text/css' href="view/css/login.css">
    <link rel='stylesheet' type='text/css' href="view/css/header.css">
    <link rel='stylesheet' type='text/css' href="view/css/footer.css">

</head>

<body>

<?php include "view/html/header.php"?>

<div id="form-wrapper">

    <div id="form">
        <div id="navigator">
            <div class="navigator_button" id="toLogin" >toLogin</div>
            <div class="navigator_button" id="toSignUp">toSignUp</div>
            <div class="navigator_button" id="toChange">Change password</div>
            <div class="navigator_button" id="toReset">Reset password</div>
        </div>

        <div class="signUp login">
            <input id="login" type="text" placeholder="enter login"></div>
        <div class="status" id="login_status"></div>

        <div class="signUp change reset">
            <input id="email" type="email" placeholder="enter email"></div>
        <div class="status" id="email_status"></div>

        <div class="signUp login change">
            <input id="password" type="password" placeholder="enter your password"></div>
        <div class="status" id="password_status"></div>


        <div class="change">
            <input id="password_new" type="password" placeholder="enter your new password"></div>
        <div class="status" id="password_new_status"></div>


        <div class="signUp change">
            <input id="password_dup" type="password" placeholder="repeat password"></div>
        <div class="status" id="pussword_dup_status"></div>

        <input id="submit" type="submit" value="signUp">

    </div>

    <div id="main_status">
    </div>

    <div id="success_login">

    </div>
</div>

<?php include "view/html/footer.php"?>
</body>

<script src="view/js/login.js"></script>
<script src="view/js/valid.js"></script>
<script src="view/js/header.js"></script>

</html>