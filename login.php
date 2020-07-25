<?php require('session.php'); ?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Login</title>
        <script src="sha256.js"></script>
        <script src="login.js"></script>
    </head>
    <?php
    if (logged_in()) {
        ?>
        <script type="text/javascript">
            window.location = "index.php";
        </script>
        <?php
    }
    ?>
    <body>
        <form onsubmit="onLoginSubmit()" action="proc_login.php" method="post">
            <span>Email:</span>
            <input type="email" name="email" />
            <br />
            <span>Password:</span>
            <input id="pass-field" type="password" />
            <br />
            <label>
                <input type="checkbox" name="remember" />Remember me
            </label>
            <button type="submit" name="btnlogin">Login</button>
        </form>
    </body>
</html>