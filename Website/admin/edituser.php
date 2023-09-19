<?php
session_start();

require_once '../server/database.php';

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


$editId = $_GET['id'];

$db->query("SELECT * FROM users WHERE id = :id");
$db->bind(':id', $editId);
$result = $db->resultset();

if (isset($_GET['action'])){
    switch ($_GET['action']) {

        case "admin":
            GiveAdmin($editId, $_POST['num']);
            break;
        case "ban":
            BanUser($editId, $_POST['num'], $_POST['banreason']);
            break;
        case "unban":
            $db->query("UPDATE users SET banned = 0 WHERE id = :id");
            $db->bind(':id', $editId);
            $db->execute();
            break;
        case "premium":
            SetPremium($editId, $_POST['num']);
        
        break;
        
    
    }
}


function GiveAdmin($id, $num) {
    $db = new Database();
    $db->query("UPDATE users SET admin = :num WHERE id = :id");
    $db->bind(':id', $id);
    $db->bind(':num', $num);
    $db->execute();

}

function BanUser($id, $num, $reason) {
    $db = new Database();
    $db->query("UPDATE users SET banned = :num, ban_reason = :reason WHERE id = :id");
    $db->bind(':id', $id);
    $db->bind(':reason', $reason);
    $db->bind(':num', $num);
    $db->execute();
}

function SetPremium($id, $num) {
    $db = new Database();
    $db->query("UPDATE users SET premium = :num WHERE id = :id");
    $db->bind(':id', $id);
    $db->bind(':num', $num);
    $db->execute();
}
$db->query("SELECT * FROM users WHERE id = :id");
$db->bind(':id', $editId);
$result = $db->resultset();

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
            
            <div class="bg-gray-900 rounded-lg p-4">
            <h1 class="text-2xl text-indigo-500 font-bold">Edit <?php echo $result[0]['username']; ?></h1>
            <br class="my-4">
                <form method="POST" action="edituser.php?id=<?php echo $editId; ?>&action=ban">
                    <div class="mb-4">
                        <label for="banreason" class="block text-indigo-500 text-sm font-bold mb-2">Ban Reason</label>
                        <input type="text" name="banreason" id="banreason" class="shadow bg-gray-900 border-indigo-500 appearance-none border rounded w-full py-2 px-3 text-indigo-500 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="num" class="block text-indigo-500 text-sm font-bold mb-2">IsBanned [1 = true | 0 = false]</label>
                        <input type="number" name="num" id="num" class="shadow bg-gray-900 border-indigo-500 appearance-none border rounded w-full py-2 px-3 text-indigo-500 leading-tight focus:outline-none focus:shadow-outline">
                        
                    </div>
                    <div class="mb-4">
                        <input type="submit" name="submit" id="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" value="Set Ban">
  
                    </div>
                </form>
                <form method="POST" action="edituser.php?id=<?php echo $editId;?>&action=admin">
                    <div class="mb-4">
                        <label for="num" class="block text-indigo-500 text-sm font-bold mb-2">IsAdmin [1 = true | 0 = false]</label>
                        <input type="number" name="num" id="num" class="shadow bg-gray-900 border-indigo-500 appearance-none border rounded w-full py-2 px-3 text-indigo-500 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <input type="submit" name="submit" id="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" value="Set Admin">
                    </div>
                </form> 
                <form method="POST" action="edituser.php?id=<?php echo $editId;?>&action=premium">
                    <div class="mb-4">
                        <label for="num" class="block text-indigo-500 text-sm font-bold mb-2">IsPremium [1 = true | 0 = false]</label>
                        <input type="number" name="num" id="num" class="shadow bg-gray-900 border-indigo-500 appearance-none border rounded w-full py-2 px-3 text-indigo-500 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <input type="submit" name="submit" id="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" value="Set Premium">
                    </div>
                </form>
                <br class="my-4" />
                <a href="../index.php?page=admin" class="text-indigo-500 hover:text-indigo"> Back... </a>


            </div>
        </div>
    </div>
</body>
</html>

