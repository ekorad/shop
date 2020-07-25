<?php

require('connect.php');
require('session.php');

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['btnlogin'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT `id`, `password`, `salt` FROM `users` WHERE `email` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $dbid = NULL;
    $dbpass = NULL;
    $dbsalt = NULL;
    
    $stmt->bind_result($dbid, $dbpass, $dbsalt);   
    $stmt->store_result();
    
    if ($stmt->num_rows === 0) {
        die("Could not find a user with the specified email.");
    }
    
    $stmt->fetch();
    $stmt->close();    
    
    $hash = hash("sha256", $dbsalt . "." . $password);
    if ($hash !== $dbpass) {
        die("Password is incorrect.");
    }
}
?>