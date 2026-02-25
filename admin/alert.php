<?php
session_start();
include_once '../modals/Database.php';

if(!isset($_SESSION['username']))
{
   header("location: index.php"); 
}

$conn = Database::getConnection();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_alert'])) {
    $userIds = $_POST['users'] ?? [];
    $message = $_POST['message'] ?? '';
    
    if (!empty($userIds) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO notifications (userId, message) VALUES (?, ?)");
        
        $successCount = 0;
        foreach ($userIds as $uId) {
            if ($stmt->execute([$uId, $message])) {
                $successCount++;
            }
        }
        
        $_SESSION['done'] = "Alert sent successfully to $successCount user(s).";
    } else {
        $_SESSION['err'] = "Please select at least one user and enter a message.";
    }
}

// Fetch all users
$stmt = $conn->prepare("SELECT userId, fullname, Email FROM user ORDER BY fullname ASC");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>mySWC-Alert</title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
    <style>
        .user-list-container {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            background: #fff;
        }
        .user-item {
            display: flex;
            align-items: center;
            padding: 5px;
            border-bottom: 1px solid #f0f0f0;
        }
        .user-item:last-child {
            border-bottom: none;
        }
        .user-item input {
            width: auto;
            margin-right: 10px;
        }
        .preset-buttons {
            margin-bottom: 10px;
        }
        .preset-btn {
            background: #f0f0f0;
            border: 1px solid #ccc;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 5px;
            font-size: 12px;
        }
        .preset-btn:hover {
            background: #e0e0e0;
        }
    </style>
</head>
<body>
   
    <?php include_once '../commons/menu.php';?>

    <?php include_once '../commons/header.php';?>

    <div class="body-container">
        <div class="ml-24">
            <div class="panel">
                <p>CREATE COLLECTION ALERT</p>         
            </div>
            
            <div class="form-container" style="max-width: 800px; margin: 20px auto;">
                <form method="post">
                    <div class="err-submit">
                        <?php if(isset($_SESSION['err'])):?>
                            <?=$_SESSION['err'];?>
                            <?php unset($_SESSION['err']); endif;?>
                    </div>
                    <div class="success-submit">
                        <?php if(isset($_SESSION['done'])):?>
                            <?=$_SESSION['done'];?>
                            <?php unset($_SESSION['done']); endif;?>
                    </div>

                    <div class="field-container">
                        <label><b>Select Users</b></label>
                        <div class="user-list-container">
                            <?php foreach ($users as $user): ?>
                                <div class="user-item">
                                    <input type="checkbox" name="users[]" value="<?= $user['userId']; ?>" id="user_<?= $user['userId']; ?>">
                                    <label for="user_<?= $user['userId']; ?>">
                                        <?= htmlspecialchars($user['fullname']); ?> (<?= htmlspecialchars($user['Email']); ?>)
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <label><b>Message</b></label>
                        <div class="preset-buttons">
                            <button type="button" class="preset-btn" onclick="setMessage('The collectors are on their way to your location.')">Collectors en route</button>
                            <button type="button" class="preset-btn" onclick="setMessage('Trash collection for your area has been scheduled for tomorrow.')">Schedule Update</button>
                            <button type="button" class="preset-btn" onclick="setMessage('Please ensure your bins are accessible for collection.')">Access Reminder</button>
                        </div>
                        <textarea name="message" id="alert_message" rows="4" placeholder="Type your alert message here..." required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>

                        <button type="submit" name="send_alert" style="margin-top: 20px;">Send Alert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function setMessage(msg) {
            document.getElementById('alert_message').value = msg;
        }
    </script>
</body>
</html>
