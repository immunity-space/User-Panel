<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
    if (isset($_GET['page']) && $_GET['page'] === 'login') {
        include('pages/login.html');
    } elseif (isset($_GET['page']) && $_GET['page'] === 'register') {
        include('pages/register.html');
    } elseif (isset($_GET['page']) && $_GET['page'] === 'dashboard') {
        include('dash/index.php');
    }elseif (isset($_GET['page']) && $_GET['page'] === 'admin') {
        include('admin/index.php');
    }elseif (isset($_GET['page']) && $_GET['page'] === 'rules') {
        include('pages/rules.html');
    }elseif (isset($_GET['page']) && $_GET['page'] === 'install') {
        include('dash/install.php');
    }
    else {
        include('pages/welcome.html');
    }
    ?>
</body>
</html>
