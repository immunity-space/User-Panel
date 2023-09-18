<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register Page</title>
</head>
<body>
    <?php
    // Check if the 'login' query parameter is set
    if (isset($_GET['page']) && $_GET['page'] === 'login') {
        include('pages/login.html');
    } elseif (isset($_GET['page']) && $_GET['page'] === 'register') {
        include('pages/register.html');
    } elseif (isset($_GET['page']) && $_GET['page'] === 'dashboard') {
        include('dash/index.php');
    } else {
        // If neither 'login' nor 'register' is specified, show a default message or page.
        include('pages/welcome.html');
    }
    ?>
</body>
</html>
