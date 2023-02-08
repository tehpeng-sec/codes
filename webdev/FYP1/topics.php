

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Topics</title>
    <link href="CSSfiles/categories.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/ForTable.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">


</head>

<?php include './header.php'; ?>

    <table class="sidebar" cellpadding="8" width="100%" border="0" cellspacing="0">

        <?php

        if(empty($_GET)){
          echo "404";
        }else{
            include './dotopics.php';
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo '<p style="text-align:center">There are no topics in this category yet.';
                echo '<br>Go back to <a  href = "index.php" title="Home">Home Page</a></p>';
            }
            else
            { ?>
              <tbody>
                  <?php
              echo '<tr>';
                  echo '<th scope="col" style="border-radius: 10px 0px 0px 0px">topics&nbsp;</th>';
                  echo '<th scope="col">number of post/topics&nbsp;&nbsp;</th>';
                  echo '<th style="border-radius: 0px 10px 0px 0px">Edited date:</th>';
                  echo '</tr>';

                while($row = mysqli_fetch_assoc($result) )
                {
                  $countsqlt = "SELECT count(thread.thread_id)
                                FROM thread
                                WHERE topic_id = " . $row['topic_id'];
                  $countresultt = mysqli_query($link, $countsqlt);
                  $countrowt = mysqli_fetch_array($countresultt);
                  $countsql = "SELECT count(post.post_id)
                                FROM thread INNER JOIN post on post.post_thread_id = thread.thread_id WHERE topic_id = " . $row['topic_id'] ;
                  $countresult = mysqli_query($link, $countsql);
                  $countrow = mysqli_fetch_array($countresult);

                  echo '<tr>';
                  echo '<td style="width: 60%" class="categories">';
                  echo '<div class="categories"><a style="text-decoration:none" href="threads.php?topic_id=' . $row['topic_id'] . '">&nbsp;' . $row['topic_name']  . '&nbsp;&nbsp;</a></div>';
                  echo  '<div class="smallfont">'.  $row['topic_message'] . '</div>';
                  echo '</td>' ;

                  echo '<td style="width:200px"  class="number smallfont">';
                  echo '<li>'. $countrowt['count(thread.thread_id)'] . ' Threads</li>';
                  echo '    <li>'. $countrow['count(post.post_id)'] . ' Posts</li> ';
                  echo '</td>';
                  echo '<td  class="date" style="width:20%">';
                  echo ' <div style="white-space:nowrap"> ';
                  echo '<span class="time"> ' . date('d-m-Y h:i:sa', strtotime($row['topic_created'])). '</span></div>';
                  echo '  </td> ' ;

            echo '   </tr>';
            }
          }
        }
      }
        ?>
              </tbody>
    </table>







</body>
</html>
