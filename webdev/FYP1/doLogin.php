<?php
session_start();
include "dbFunctions.php";
if(isset($_POST['username'])){
    $enteredUsername = mysqli_real_escape_string($link, $_POST['username']);
    $enteredPassword = mysqli_real_escape_string($link, $_POST['password']);

    $msg = "";
    $errormsg="";

    $querycheck = "SELECT *FROM user WHERE username = '$enteredUsername' "
            . "AND user_password = md5('$enteredPassword')";
    $resultCheck = mysqli_query($link, $querycheck) or die(mysqli_error($link));

    if(mysqli_num_rows($resultCheck) == 1){
        $row = mysqli_fetch_array($resultCheck);
        $_SESSION['username'] = $enteredUsername;
        $_SESSION['password'] = md5('$enteredPassword');
        $_SESSION['email'] = $row['user_email'];
        $_SESSION['total_post'] = $row['total_post'];
        $_SESSION['date_created'] = $row['date_created'];
        $_SESSION['user_id'] = $row['user_id'];
        header("location: index.php");


    } else{
        $_SESSION['errormsg'] = "<p style='text-align:center; color:red'>Sorry, you must enter a valid username and password to log in</p>";
        $_SESSION['errorPopUp'] = "<script>alert('Sorry, you must enter a valid username and password to log in')</script>";


            header("location: index.php");

    }

}
