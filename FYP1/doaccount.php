<?php
session_start();
$changeError = array();
$db = mysqli_connect('localhost', 'root', '', 'mydb');


 
if(isset($_POST['currentPassword'])){
    $currentPass = mysqli_real_escape_string($db, $_POST['currentPassword']);
    $newPassword1 = mysqli_real_escape_string($db, $_POST['NewPassword1']);
    $newPassword2 = mysqli_real_escape_string($db, $_POST['NewPassword2']);
    $username = $_SESSION['username'];
    if ($password_1 != $password_2) {array_push($changeError, "The two passwords do not match");}
    $currentPass = md5($currentPass);
    $newPassword1 = md5($newPassword1);
    $newPassword2 = md5($newPassword2);
    $user_check_query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($db, $user_check_query);
    $row = mysqli_fetch_array($result);
    
    if ($row['user_password'] != $currentPass) {
	array_push($changeError, "The current password in invalid");
    }
    if (count($changeError) == 0) {
        $query = "UPDATE user set user_password='$newPassword1' WHERE username='$username'";
  	mysqli_query($db, $query);
        $_SESSION['changepass'] = "<a> Password has been changed</a><br>";
        header('location: account.php');

    }else{
      $_SESSION['changeError'] = $changeError;

        header('location: account.php');

    }
    
}









?>