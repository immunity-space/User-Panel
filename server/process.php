<?php

require_once 'database.php';
session_start();


switch ($_POST['type']){
    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];
        login($username, $password);
        break;
    case 'register':
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        register($username, $password, $password2);
        break;        
    default:
        echo 'error';
        break;

}


function login($user, $password){
    $db = new Database();

    $db->query("SELECT * FROM users WHERE username = :username");

    $db->bind(':username', $user);
    $db->execute();
    $results = $db->resultset();

    if($results->rowCount() > 0){
        $row = $results->fetch(PDO::FETCH_OBJ);
        if(password_verify($password, $row['password'])){
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header('Location: index.php');
        }
        else{
            echo 'error';
        }
    }
}
function register($user, $password, $password2){




}


?>
