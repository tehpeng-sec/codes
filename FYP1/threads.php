
<?php
include 'dbFunctions.php';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Threads</title>
    <link href="CSSfiles/ForTable.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">

</head>

<?php include './header.php'; ?>

  <table class="sidebar" cellpadding="8" width="100%" border="0" cellspacing="0">

        <?php
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
        if(empty($_GET)){
          echo "404";
        }else{
          include './doThreads.php';
          
            if(!$result)
            {
                echo 'The thread could not be displayed, please try again later.';
            }
            else
            {
                if(mysqli_num_rows($result) == 0)
                {
                    echo '<p style="text-align:center">There are no threads in this category yet.';
                    echo '<br>Go back to <a  href = "index.php" title="Home">Home Page</a></p>';

                }
                else
                { ?>
                  <tbody>
                      <?php
                    echo '<tr>';
                      echo '<th scope="col" style="border-radius: 10px 0px 0px 0px">Created by:</th>';
                      echo '<th>Threads&nbsp;</th>';

                      echo '<th scope="col">Number of Posts&nbsp;&nbsp;</th>';
                      echo '<th>Edited date:</th>';
                      
                      echo '<th style="border-radius: 0px 10px 0px 0px">Delete</th>';
                      echo '</tr>';

                  while($row = mysqli_fetch_assoc($result) )
                    {
                      $countsql = "SELECT post_id
                                    FROM post 
                                    INNER JOIN thread ON thread.thread_id = post.post_thread_id 
                                    WHERE post.post_thread_id = " . $row['thread_id'];
                      $countresult = mysqli_query($link, $countsql);
                      $countrow = mysqli_num_rows($countresult);
                      echo '<tr>';
                      echo '<td class="by smallfont" style="width:100px">' .$row['username']. '</td>';
                      echo '<td style="width: 60%" class="categories">';
                      echo '<div class="categories"><a style="text-decoration:none" href="post.php?thread_id=' . $row['thread_id'] . '">&nbsp;' . $row['thread_name']  . '&nbsp;&nbsp;</a></div>';
                      echo '</td>' ;

                      echo '<td style="width:200px"  class="number smallfont">';
                      echo '    <li>'. $countrow . ' Posts</li> ';
                      echo '</td>';

                      echo '<td  class="date" style="width:20%">';
                      echo ' <div style="white-space:nowrap"> ';
                      echo '<span class="time"> ' . date('d-m-Y h:i:sa', strtotime($row['thread_timestamp'])). '</span></div>';
                      echo '  </td> ' ;
                      
                      if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id'] ){
                        echo '<td class="by smallfont" style="width:100px"><a href="deleteThreads.php?id=' . $row['thread_id'] . '&topic_id='. $_GET['topic_id'] . '">Delete</a></td>';
                      }else{
                        echo '<td class="by smallfont" style="width:100px"></td>';

                      }

                echo '</tr>';
            }
          }
        }
      }
        ?>
        </tbody>
    </table>
<?php
echo "<br><br>";
if(isset($_SESSION['thread_error'])){
  print_r($_SESSION['thread_error']);
  unset($_SESSION['thread_error']);
}



echo "<form method='post' action='addthread.php?id=" . $_GET['topic_id'] . "'>";
echo "<br>Thread Header: <br><textarea style= 'width: 500px; height: 20px;' name='thread-name'></textarea>";
echo "<br>Thread Message:<br> <textarea style= 'width: 500px; height: 200px;' name='thread-message'></textarea>";
echo ' <br><br><input type="submit" value="Submit Thread" /> ';
echo '</form>';

 ?>

</body>
</html>
