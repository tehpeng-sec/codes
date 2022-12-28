<?php
include 'rolecheck.php';
session_start();
include 'dbFunctions.php';
$username = "";
$email    = "";
$errors = "";
unset ($_SESSION['topic_error']);

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'mydb');

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
  header("Location: adminaccess.php");
  $errors = 'This file cannot be called directly.';
}

else
{
    //check for sign in status
        //a real user posted a real reply
        $sql = "INSERT INTO
                    topic(topic_name,
                          topic_message,
                          category_id,
                          topic_by_user)
                VALUES ('" . $_POST['topic-name'] . "',
                  '" . $_POST['topic-message'] . "',
                  '" . $_POST['topic-cat'] . "',
                  " . $_SESSION['user_id'] . ")";

        $result = mysqli_query($db, $sql);

        if(!$result)
        {
           header("Location: adminaccess.php");
            $errors = 'Your topic has not been saved, please try again later.';
        }
        else
        {

          header("Location: adminaccess.php");
        }
    }


$_SESSION['topic_error'] = $errors;
?>
