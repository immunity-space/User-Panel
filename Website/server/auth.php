<?php

require_once 'database.php';
require_once 'util.php';



$db = new Database();

if (isset($_GET['type']) && $_GET['type'] === 'login') {

    $username = $_GET['username'];
    $password = $_GET['password'];
    $hwid = $_GET['hwid'];

    $db->query("SELECT * FROM users WHERE username = :username and hwid = :hwid"); 
    $db->bind(':username', $username);
    $db->bind(':hwid', $hwid);

    $db->execute();
    $result = $db->single();

    if ($result) {
            $encpass = hash('sha256', $password);
        if ($encpass == $result['password']) {
            echo json_encode(['result' => 'success']);
        } else {
            echo json_encode(['result' => 'failed']);

        }
    } else {
        echo json_encode(['result' => 'failed']);

    }

} elseif (isset($_GET['type']) && $_GET['type'] === 'getuid') {

    $username = $_GET['username'];
    
    $db->query("SELECT * FROM users WHERE username = :username");
    $db->bind(':username', $username);
    $db->execute();
    $result = $db->single();

    if ($result) {
        echo json_encode(['result' => $result['id']]);
    } else {
        echo json_encode(['result' => 'failed']);
    }

}
else {
}

    
?>

