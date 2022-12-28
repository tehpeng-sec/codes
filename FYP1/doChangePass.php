<?php
session_start();
$changeError = array();
$db = mysqli_connect('localhost', 'root', '', 'mydb');


 
if(isset($_SESSION['email'])){
    $email = mysqli_real_escape_string($db, $_SESSION['email']);
    
    $newPassword1 = mysqli_real_escape_string($db, $_POST['NewPassword1']);
    $newPassword2 = mysqli_real_escape_string($db, $_POST['NewPassword2']);
    if ($password_1 != $password_2) {array_push($changeError, "The two passwords do not match");}
    
    $newPassword1 = md5($newPassword1);
    $newPassword2 = md5($newPassword2);
    $user_check_query = "SELECT * FROM user WHERE user_email='$email'";
    $result = mysqli_query($db, $user_check_query);
    $row = mysqli_fetch_array($result);
    
    
    if (count($changeError) == 0) {
        $query = "UPDATE user set user_password='$newPassword1' WHERE user_email='$email'";
  	mysqli_query($db, $query);
        $_SESSION['errorPopUp'] = "<script>alert('Password has been changed. Please log in.')</script>";
        header('location: index.php');

    }else{
      $_SESSION['changeError'] = $changeError;
        header('location: changePass.php?'. $email);

    }
}
?>