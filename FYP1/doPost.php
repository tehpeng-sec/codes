<?php
include 'dbFunctions.php';

// connect to the database
        //do a query for the topics

          $sql = "SELECT post.post_id, post.message, post.post_thread_id, post.post_timestamp, post.post_by_user, user.user_id, user.username
          FROM post INNER JOIN user ON post.post_by_user = user.user_id

          WHERE post.post_thread_id = " . mysqli_real_escape_string($link, $_GET['thread_id']) . "
          GROUP BY post_id ASC";


          $result = mysqli_query($link, $sql);


          function roleName($id) {
          include 'dbFunctions.php';
          $rolesql = "SELECT user_id, role.role_name
                      FROM user
                      INNER JOIN role ON role.role_id = user.role_id
                      WHERE user.user_id = $id";
          $exec =  mysqli_query($link, $rolesql);
          if(!$exec)
          {
              echo '<li>Not a Member</li>';
          }
          else
          {
              if(mysqli_num_rows($exec) == 0)
              {
                  echo 'New Member';
              }
              else
              {
          while($r = mysqli_fetch_assoc($exec)){
              echo '<li>'. $r['role_name'] . '</li>';
          }
        }
      }
    }

           $sqltop = "SELECT
                  thread.thread_id,
                  thread.thread_name,
                  thread.thread_message,
                  thread.thread_by_user,
                  thread.thread_timestamp,
                  user.username
                  FROM
                  thread
                  INNER JOIN user ON thread_by_user = user.user_id
                  WHERE
                  thread_id = " . mysqli_real_escape_string($link, $_GET['thread_id']);



            $resulttop = mysqli_query($link, $sqltop);

?>
