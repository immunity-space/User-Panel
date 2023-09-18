<?php
session_start();

if (!isset($_SESSION['username'])){
    header("Location: ../index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md bg-white p-8 rounded-lg shadow-md w-full">
            <h2 class="text-2xl text-indigo-500 font-semibold mb-6">Welcome, <?php echo $_SESSION['username'] ?></h2>
            
        </div>
    </div>
</body>
</html>

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

        </div>
    </div>
</body>
</html>
