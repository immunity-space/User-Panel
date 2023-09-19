<?php
session_start();

require_once 'server/database.php';

if (!isset($_SESSION['username'])){
    header("Location: index.php");
}

$db = new Database();

$username = $_SESSION['username'];
$db->query("SELECT * FROM users WHERE username = :user");
$db->bind(':user', $username);
$result = $db->single();

if ($result['banned'] != 1) {

    echo json_encode(["status" => "error", "message" => "You are not banned!"]);
    exit;
}

$db->query("SELECT * FROM users WHERE username = :user");
$db->bind(':user', $username);
$result = $db->single();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-800 text-gray-200">
    <div class="min-h-screen flex items-center justify-center bg-gray-800">
        <div class="max-w-md p-8 rounded-lg shadow-md w-full">
            <h2 class="text-2xl text-red-500 font-semibold mb-6">Sorry, <?php echo $_SESSION['username'] ?>...</h2>
            <h2 class="text-2xl text-red-500 font-semibold mb-6">You have been banned for: <br /> <?php echo $result['ban_reason'] ?></h2>
            <h2 class="text-red-500 font-semibold mb-6">Please contact a staff member.</h2>

        </div>
    </div>
</body>
</html>
