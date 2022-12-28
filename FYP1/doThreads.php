<?php
include 'dbFunctions.php';



// connect to the database
        //do a query for the topics

          $sql = "SELECT
                      thread.thread_id,
                      thread.thread_name,
                      thread.thread_message,
                      thread.thread_timestamp,
                      thread.topic_id,
                      user.username, 
                      user.user_id
                  FROM  thread
                  INNER JOIN user on user.user_id = thread.thread_by_user
                  WHERE
                  thread.topic_id = " . mysqli_real_escape_string($link, $_GET['topic_id']);



        $result = mysqli_query($link, $sql);


?>
