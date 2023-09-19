<?php
session_start();

require_once 'server/database.php';
require_once 'server/util.php';

$username = $_SESSION['username'];

$db = new Database();

$db->query("SELECT * FROM users WHERE username = :username");
$db->bind(':username', $username);
$db->execute();
$result = $db->single();

if ($result['premium'] != 1 && $result['admin']!= 1) {
    header('Location: index.php');
    exit();
}

if ($result['banned'] == 1) {
    header('Location: banned.php');
    exit();

}
$filename = randomCode(15);

header('Content-type: application/x-dosexec');
header('Content-Disposition: attachment; filename="'.$filename.'".exe"');
readfile('yourcheatname.bin');

?>
