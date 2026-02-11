<?php

session_start();

if(!isset($_SESSION['username']))
{
   //header("location: index.php"); 
}

// FIXED: Check database instead of relying on session
include_once '../modals/Database.php';
include_once 'Faddress.php';

$userId = $_SESSION['userId'] ?? null;
$existingAddress = null;
$isUpdate = false;

// Check if user already has an address
if($userId) {
    $existingAddress = Faddress::getAddressInfoById($userId);
    
    // If address exists, redirect to start page
    if($existingAddress && !empty($existingAddress['County'])) {
        $isUpdate = true;
        // Optional: Set session for future checks
        $_SESSION['area'] = true;
    }
}

// Uncomment this to prevent re-entry completely (old behavior)
// if($isUpdate) {
//     header("location: start.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $isUpdate ? 'Update Address Details' : 'Enter Address Details'; ?></title>

    <link rel="stylesheet" href="../assets/style/menu.css">
    <link rel="stylesheet" href="../assets/style/main.css">
    <link rel="stylesheet" href="../assets/style/form.css">
   
</head>
<body>
    
    <?php include_once 'userMenu.php';?>

    <?php include_once 'userHeader.php';?>
       

    <div class="body-container">
        <div class="ml-24">
            <div class="form-container">
             
                <form action="newAddress.php" method="post">
                    <div class="form-title">
                        <h2><?php echo $isUpdate ? 'Update Address Details' : 'Enter Address Details'; ?></h2>
                        <?php if($isUpdate): ?>
                            <p style="color: #2563eb; font-size: 14px; margin-top: 5px;">You can update your address information below</p>
                        <?php endif; ?>
                    </div>
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
                        <label><b>County</b></label>
                        <input type="text" placeholder="Enter County" name="county" 
                               value="<?php echo htmlspecialchars($existingAddress['County'] ?? ''); ?>" required>

                        <label><b>Constituency</b></label>
                        <input type="text" placeholder="Enter Constituency" name="constituency"
                               value="<?php echo htmlspecialchars($existingAddress['Constituency'] ?? ''); ?>" required>

                        <label><b>Ward</b></label>
                        <input type="text" placeholder="Enter ward" name="ward"
                               value="<?php echo htmlspecialchars($existingAddress['Ward'] ?? ''); ?>" required>

                        <label><b>Description</b></label>
                        <input type="text" placeholder="Enter Description" name="details"
                               value="<?php echo htmlspecialchars($existingAddress['Details'] ?? ''); ?>" required>

                         <select class="custom-select" name="holder" required>
                            <option value="">Select Role</option>
                            <option value="home" <?php echo ($existingAddress['Holder'] ?? '') === 'home' ? 'selected' : ''; ?>>Home</option>
                            <option value="business" <?php echo ($existingAddress['Holder'] ?? '') === 'business' ? 'selected' : ''; ?>>Business</option>
                            <option value="Institution" <?php echo ($existingAddress['Holder'] ?? '') === 'Institution' ? 'selected' : ''; ?>>Institution</option>
                        </select>

                        <input type="hidden" value="<?=$_SESSION['userId'];?>" name="userId">
                        <input type="hidden" value="<?php echo $isUpdate ? '1' : '0'; ?>" name="isUpdate">
                        
                        <button type="submit"><?php echo $isUpdate ? 'Update Address' : 'Submit'; ?></button>

                    </div>

                </form>
            </div>
                           
        </div>
            
    </div>
</body>

</html>