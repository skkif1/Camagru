
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Welcome to Camagru</title>

    <link rel='stylesheet' type='text/css' href="view/css/login.css">
    <script src="view/js/login.js?newversion"></script>
    <script src="view/js/valid.js?newversion"></script>

</head>

<body>

<div id="form">
    <div id="navigator">
        <input id="submit" type="submit" value="Login">
        <input id="toLogin" type="button" value="toLogin">
        <input id="toSignUp" type="button" value="toSignUp">
        <input id="toChange" type="button" value="Change password">
        <input id="toReset" type="button" value="Reset password">
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

</div>

    <div id="main_status">

    </div>

<div id="success_login">

</div>
</body>
</html>