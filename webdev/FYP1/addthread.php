<?php

session_start();
include 'dbFunctions.php';
$username = "";
$email    = "";

unset ($_SESSION['thread_error']);


// connect to the database
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
  header("Location: threads.php?topic_id=" . htmlentities($_GET['id']));
  $errors = 'This file cannot be called directly.';
}
else
{
    //check for sign in status
    if(!($_SESSION['username']))
    {
      header("Location: threads.php?topic_id=" . htmlentities($_GET['id']));
        $errors = 'You must be signed in to post a reply.';
    }
else
{
    //check for sign in status
        //a real user posted a real reply
        $sql = "INSERT INTO
                    thread(thread_name,
                          thread_message,
                          topic_id,
                          thread_by_user)
                VALUES ('" . $_POST['thread-name'] . "',
                  '" . $_POST['thread-message'] . "',
                        " . mysqli_real_escape_string($link, $_GET['id']) . ",
                        " . $_SESSION['user_id'] . ")";

        $result = mysqli_query($link, $sql);

        if(!$result)
        {
           header("Location: threads.php?topic_id=" . htmlentities($_GET['id']));
            $errors = 'Your thread has not been saved, please try again later.';
        }
        else
        {

          header("Location: threads.php?topic_id=" . htmlentities($_GET['id']));
        }
    }
}

$_SESSION['thread_error'] = $errors;
?>
