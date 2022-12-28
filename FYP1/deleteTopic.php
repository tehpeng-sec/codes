<?php
session_start();
include 'dbFunctions.php';

if(!empty($_GET['id'])){
    $delete_id = $_GET['id'];
    $query = "SELECT topic_name FROM topic WHERE topic_id = $delete_id ";
    $select = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($select);
    
    $threadQuery = "SELECT thread_id FROM thread WHERE topic_id = $delete_id ";
    $threadSelect = mysqli_query($link, $threadQuery);
    
    while($rows = mysqli_fetch_assoc($threadSelect)){
        $delThread_id = $rows['thread_id'];
        $delPostQuery = "DELETE FROM post WHERE post_thread_id = $delThread_id";
        $delpostresult = mysqli_query($link, $delPostQuery);    
    }

    $delQuery = "DELETE FROM thread WHERE topic_id = $delete_id";
    $delresult = mysqli_query($link, $delQuery);    
    
    
    $delQuery = "DELETE FROM topic WHERE topic_id = $delete_id";
    $delresult = mysqli_query($link, $delQuery);
    $topic_id = $_GET['topic_id'];
    if($delresult){
        $_SESSION['delete'] = "<script>alert('The topic:  ". $row['topic_name'] ." has been deleted.')</script>";
        header("location: adminaccess.php");

    }else{
        $_SESSION['delete'] = "<script>alert('Sorry, There is an error please try again.')</script>";
        header("location: threads.php?topic_id=$topic_id");

    }

}


?>
