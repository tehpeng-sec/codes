<?php 
session_start();
$msg = '';
if(isset($_POST['forgotEmail'])){
    include "dbFunctions.php";
    $forgotPass = $_POST['forgotEmail'];
    $querycheck = "SELECT *FROM user WHERE user_email = '$forgotPass'";
    $resultCheck = mysqli_query($link, $querycheck) or die(mysqli_error($link));

    if(mysqli_num_rows($resultCheck) == 1){
        $row = mysqli_fetch_array($resultCheck);

        $to = $forgotPass;
        $subject = "You Forgot your password";
        // Message
        $message = '
        <html>
        <head>
          <title>press link to change password</title>
        </head>
        <body>
          <p>Change your password</p>
          <h2>please press this <a href="http://localhost:1234/FYP1/changePass.php?email=' . $forgotPass. '">link</a>
          <h2>
        </body>
        </html>
        ';

        // To send HTML mail, the Content-type header must be set
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        if(mail($to,$subject,$message,$headers)){
            $_SESSION['msg'] = "<a style='color:red'>please check you email</a>";
            
        }else{
            $_SESSION['msg'] = "<a style='color:red'> the link has not been send. pls try again</a>";
            
        }
        header("location: forgetpassword.php");
    }else{
        $_SESSION['msg'] = "<a style='color:red'>this email does not belong to an account</a>";
        echo "email nono";
        header("location: forgetpassword.php");

    }
}
?>