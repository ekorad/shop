<?php
require('./connect.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Înregistrare</title>
        <script type="text/javascript" src="sha256.js"></script>
        <script type="text/javascript" src="register.js"></script>
        <link rel="stylesheet" type="text/css" href="register.css" />
    </head>
    <body>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['regSub'])) {
            if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['gender']) || empty($_POST['password'])) {
                ?>
                <script>alert("A apărut o eroare! Vă rugăm să încercați din nou.");</script>
                <?php
                exit;
            }
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                ?>
                <script>alert("A apărut o eroare! Vă rugăm să încercați din nou.");</script>
                <?php
            }

            $sql = "SELECT `id` FROM `users` WHERE `email` = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows !== 0) {
                ?>
                <script>alert("Un utilizator cu acest email există deja!");</script>
                <?php
                exit;
            }

            $stmt->close();
            $salt = substr(hash("sha256", $email), 0, 20);

            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $password = $_POST['password'];

            
        }
        ?>
        <form id = "registerForm" method = "post"
              onsubmit = "return onRegisterSubmit()"
              action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class = "inputWrapper">
                <input type = "text" name = "name" id = "nameField"
                       placeholder = "Nume" onclick = "onInputFocus(this)" />
                <span class = "tooltip">Numele nu poate conține decât litere!</span>
            </div>
            <div class = "inputWrapper">
                <div id = "gendersContainer">
                    <div class = "genderContainer">
                        <input type = "radio" name = "gender" id = "radioMale"
                               onchange = "onRadioChecked()" />
                        <label for = "radioMale">Dl.</label>
                    </div>
                    <div class = "genderContainer">
                        <input type = "radio" name = "gender" id = "radioFemale"
                               onchange = "onRadioChecked()" />
                        <label for = "radioFemale">Dna. / Dra.</label>
                    </div>
                </div>
                <span class = "tooltip">Vă rugam să selectați o opțiune.</span>
            </div>
            <div class = "inputWrapper">
                <input type = "text" name = "email" id = "emailField"
                       placeholder = "Email" onclick = "onInputFocus(this)" />
                <span class = "tooltip">Email-ul introdus este invalid!</span>
            </div>
            <div class = "inputWrapper">
                <input type = "password" id = "passwordField"
                       placeholder = "Parolă" onclick = "onInputFocus(this)" />
                <span class = "tooltip"></span>
            </div>
            <button type = "submit" name = "regSub">Înregistrare</button>
            <a href = "#" style = "float: left">Conectare</a>
            <a href = "#" style = "float: right">Mi-am uitat parola</a>
        </form>
    </body>
</html>