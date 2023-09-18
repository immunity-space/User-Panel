<?php

require_once '../server/database.php';



$db = new Database();

$db->query(" SELECT * FROM `users` WHERE `username` = :user");
$db->bind(':user', $_POST['username']);
$db->execute();
$result = $db->resultset();

if ($result == true) {

    echo json_encode(["status" => "error", "message" => "Username already exists"]);
    exit;
}

$encpass = hash('sha256', $_POST['password']);


$db->query(" INSERT INTO `users` (`username`, `password`) VALUES (:user, :pass)");
$db->bind(':user', $_POST['username']);
$db->bind(':pass', $encpass);
$db->execute();
$_SESSION['username'] = $_POST['username'];


echo json_encode(["status" => "success", "message" => "User created"]);
header( 'Location: ../index.php?page=dashboard' )



?>
