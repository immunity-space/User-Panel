<?php

require_once '../server/database.php';

$db = new Database();

$db->query("SELECT * FROM users WHERE username = :user");
$db->bind(':user', $_POST['username']);
$result = $db->single();

echo json_encode($result['username']);

if ($result['username'] == false) {

    echo json_encode(["status" => "error", "message" => "Invalid username"]);

    exit;
}


$encpass = hash('sha256', $_POST['password']);

if ($encpass != $result['password']) {

    echo json_encode(["status" => "error", "message" => "Invalid password"]);
    exit;
}

session_start();
$_SESSION['username'] = $result['username'];
$_SESSION['id'] = $result['id'];
echo json_encode(["status" => "success", "message" => "Login successful"]);


?>