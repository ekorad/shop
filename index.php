<?php
require './includes/session.php';

if (isset($_SESSION['loggedIn'])) {
    if (isset($_SESSION['activated'])) {
        if ($_SESSION['activated'] === false) {
            echo "Contul nu este activat!";
        }
    }
}
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Shop</title>
    </head>
    <body>

    </body>
</html>