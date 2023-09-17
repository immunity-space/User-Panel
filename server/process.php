<?php

require_once 'database.php';
session_start();

if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'login':
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                login($username, $password);
            } else {
                echo 'error';
            }
            break;
        case 'register':
            if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
                register($username, $password, $password2);
            } else {
                echo 'error';
            }
            break;
        default:
            echo 'error';
            break;
    }
} else {
    echo 'error';
}


function login($user, $password) {
    $db = new Database();

    $db->query("SELECT * FROM users WHERE username = :username");
    $db->bind(':username', $user);
    $db->execute();
    $results = $db->resultset();

    if ($results ) {
        $row = $results->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
            header('Location: index.php');
            exit; // Add exit to stop further execution
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}

function register($user, $password, $password2) {
    $db = new Database();

    $db->query("SELECT * FROM users WHERE username = :username");
    $db->bind(':username', $user);
    $db->execute();
    $results = $db->resultset();
    echo $results;
    if ($results['username'] == $user) {
        echo 'Username already exists.';
    } elseif ($password == $password2) {
        $hashedPassword = md5($password);

        $db->query("INSERT INTO users (username, password) VALUES (:username, :password)");
        $db->bind(':username', $user);
        $db->bind(':password', $hashedPassword);
        $db->execute();
        $_SESSION['username'] = $user;
        header('Location: index.php');
        exit;
    } else {
        echo 'Passwords do not match.';
    }
}
?>
