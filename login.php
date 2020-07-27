<?php
require('./includes/connect.php');

session_name("SessionID");
session_start();
setcookie(session_name(), session_id(), time() + 365 * 24 * 60 * 60, "/");
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Conectare</title>
        <link rel="stylesheet" type="text/css" href="css/generic.css" />
        <link rel="stylesheet" type="text/css" href="css/login.css" />
        <script type="text/javascript" src="scripts/login.js"></script>
    </head>
    <body>
        <form id = "loginForm" method = "post"
              onsubmit = "return onLoginSubmit()"
              action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h1>Shop</h1>
            <span id="status">
                <?php
                // handle errors
                ?></span>
            <div class = "inputWrapper" style="margin-top: 15px">
                <input type = "text" name = "email" id = "emailField"
                       placeholder = "Email" onclick = "onInputClick(this)" />
                <span class = "tooltip">Email-ul introdus este invalid!</span>
            </div>
            <div class = "inputWrapper">
                <input type = "password" id = "passwordField" name="password"
                       placeholder = "Parolă" onclick = "onInputClick(this)" />
            </div>
            <button type = "submit" name = "loginSub">Conectare</button>
            <a href = "register.php" style = "float: left">Înregistrare cont nou</a>
            <a href = "forgotten.php" style = "float: right">Mi-am uitat parola</a>
        </form>
    </body>
</html>