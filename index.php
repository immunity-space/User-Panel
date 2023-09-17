<?php



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Dark Mode</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-gray-800 rounded-lg shadow-md p-8 space-y-4">
        <h2 class="text-3xl font-semibold text-center text-gray-200">Login</h2>
        <form class="space-y-4" method="POST" action="/server/process.php?type=login">
            <div>
                <label for="username" class="block text-sm font-medium">Username</label>
                <input type="text" class="border border-indigo-500 rounded-md py-2 px-3 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-700 text-white" id="username" name="username" required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium">Password</label>
                <input type="password" class="border border-indigo-500 rounded-md py-2 px-3 w-full focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-700 text-white" id="password" name="password" required>
            </div>
            <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded w-full transition duration-300 ease-in-out transform hover:scale-105">Login</button>
        </form>
    </div>
</body>
</html>


