<?php
session_start();

if (!isset($_SESSION['username'])){
    header("Location: ../index.php");
}

require_once 'server/database.php';

$db = new Database();

$db->query("SELECT * FROM users WHERE username = :username");
$db->bind(':username', $_SESSION['username']);
$db->execute();
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
            <h2 class="text-2xl text-indigo-500 font-semibold mb-6">Welcome, <?php echo $_SESSION['username'] ?></h2>
            <?php
                if ($result['admin'] == 1) {
                    echo '<button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href=\'?page=admin\'">Admin Panel</button> <br> <br>';
                }

            ?>
            <?php
                if ($result['premium'] == 1) {
                    echo '<button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href=\'?page=install\'">Download</button> <br> <br>';
                }

            ?>
        </div>
    </div>
</body>
</html>
