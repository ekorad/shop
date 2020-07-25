<?php

require('./connect.php');

$email = "vladzahiu28@gmail.com";

$sql = "SELECT `salt` FROM `users` WHERE `email` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();

$salt = NULL;
$stmt->bind_result($salt);

$stmt->fetch();

echo $salt;


?>