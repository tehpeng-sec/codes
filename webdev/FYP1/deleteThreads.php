<?php
session_start();
include 'dbFunctions.php';

if(!empty($_GET['id'])){
    $delete_id = $_GET['id'];
    $query = "SELECT thread_name FROM thread WHERE thread_id = $delete_id ";
    $select = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($select);
    
    $delPostQuery = "DELETE FROM post WHERE post_thread_id = $delete_id";
    $delpostresult = mysqli_query($link, $delPostQuery);    
    

    $delQuery = "DELETE FROM thread WHERE thread_id = $delete_id";
    $delresult = mysqli_query($link, $delQuery);    
    $topic_id = $_GET['topic_id'];
    if($delresult){
        $_SESSION['delete'] = "<script>alert('The thread:  ". $row['thread_name'] ." has been deleted.')</script>";
        header("location: threads.php?topic_id=$topic_id");

    }else{
        $_SESSION['delete'] = "<script>alert('Sorry, There is an error please try again.')</script>";
        header("location: threads.php?topic_id=$topic_id");

    }
    
}


?>