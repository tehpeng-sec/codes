<?php
session_start();
include 'dbFunctions.php';

if(!empty($_GET['id'])){
    $deletePost_id = mysqli_real_escape_string($db, $_GET['id']);
    $delQuery = "DELETE FROM post WHERE post_id = $deletePost_id";
    $delresult = mysqli_query($link, $delQuery);    
    $thread_id = mysqli_real_escape_string($db, $_GET['thread_id']);;
    if($delresult){
        $_SESSION['delete'] = "<script>alert('Your reply post has been deleted.')</script>";
        header("location: post.php?thread_id=$thread_id");

    }else{
        $_SESSION['delete'] = "<script>alert('Sorry, There is an error please try again.')</script>";
        header("location: post.php?thread_id=$thread_id");

    }
    
}


?>
