<?php
session_start();
$changeError = array();
include 'dbFunctions.php';

 
if(isset($_SESSION['email'])){
    $email = mysqli_real_escape_string($link, $_SESSION['email']);
    
    $newPassword1 = mysqli_real_escape_string($link, $_POST['NewPassword1']);
    $newPassword2 = mysqli_real_escape_string($link, $_POST['NewPassword2']);
    if ($password_1 != $password_2) {array_push($changeError, "The two passwords do not match");}
    
    $newPassword1 = md5($newPassword1);
    $newPassword2 = md5($newPassword2);
    $user_check_query = "SELECT * FROM user WHERE user_email='$email'";
    $result = mysqli_query($link, $user_check_query);
    $row = mysqli_fetch_array($result);
    
    
    if (count($changeError) == 0) {
        $query = "UPDATE user set user_password='$newPassword1' WHERE user_email='$email'";
  	mysqli_query($link, $query);
        $_SESSION['errorPopUp'] = "<script>alert('Password has been changed. Please log in.')</script>";
        header('location: index.php');

    }else{
      $_SESSION['changeError'] = $changeError;
        header('location: changePass.php?'. $email);

    }
}
?>