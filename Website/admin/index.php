<?php
session_start();

require_once 'server/database.php';

if (!isset($_SESSION['username'])){
    header("Location: ../index.php");
}

$db = new Database();

$username = $_SESSION['username'];
$db->query("SELECT * FROM users WHERE username = :user");
$db->bind(':user', $username);
$result = $db->single();

if ($result['admin'] != 1) {

    echo json_encode(["status" => "error", "message" => "Invalid Permission"]);
    exit;
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
<body class="bg-gray-800 text-gray-200">
    <div class="min-h-screen flex items-center justify-center bg-gray-800">
        <div class="max-w-md p-8 rounded-lg shadow-md w-full">
            <h2 class="text-2xl text-indigo-500 font-semibold mb-6">Welcome, <?php echo $_SESSION['username'] ?></h2>
            <table class="w-full rounded-lg">
                <thead>
                    <tr class="bg-indigo-600 text-gray-300 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-300 text-sm font-light">
                    <?php
                    $db = new Database();
                    $db->query("SELECT * FROM users order by id ");
                    $results = $db->resultset();
                    foreach ($results as $result) {
                    ?>
                    <tr class="border-b border-indigo-500 hover:bg-gray-600">
                        <td class="py-4 px-6 text-left"><?php echo $result['id']?></td>
                        <td class="py-4 px-6 text-left"><?php echo $result['username']?></td>
                        <td class="py-4 px-6 text-left">
                            <a href="admin/edituser.php?id=<?php echo $result['id']?>" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out shadow-md hover:shadow-lg">Edit</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
