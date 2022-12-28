
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Post</title>
    <link href="CSSfiles/ForTable.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">


</head>

<?php include './header.php';?>


  <table class="sidebar" cellpadding="8" width="100%" border="0" cellspacing="0">

<?php
include './doPost.php';

if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
        if(empty($_GET)){
          echo "404";
        }

        else{

          if(!$result)
          {

              echo 'The post could not be displayed, please try again later.';
          }
          else
          {
              /* if there are no replies to the post*/
              if(mysqli_num_rows($result) == 0)
              {
                while($rowtop = mysqli_fetch_assoc($resulttop) )
                  {
                $_SESSION['threadname'] = $rowtop['thread_name'];
                echo '<tbody>';
                echo '<tr>';
                echo '<th scope="col" style="border-radius: 10px 0px 0px 0px"> ' . date('d-m-Y', strtotime($rowtop['thread_timestamp'])). '</th>';
                echo '<th style="text-align:left; border-radius: 00px 10px 0px 0px">Posts</th>';

                echo '</tr>';


                echo '<tr>';
                echo '<td class="by smallfont" style="width:100px">';
                echo '<li>'. $rowtop['username'] . '</li>';
                rolename($rowtop['thread_by_user']);
                echo '</td>';

                echo '<td style="width: 80%" class="categories">';
                echo '<div class="smallfont" style="font-weight:bold; line-height: 40%"><a>&nbsp;' . $rowtop['thread_name'] . '</div>';
                echo '<div  class="smallfont" style="font-weight:bold; line-height: 40%; text-align: right;">'. date('d-m-Y h:i:sa', strtotime($rowtop['thread_timestamp'])). '</div>';
                echo '<hr size="1" style="color:#D1D1E1; background-color:#D1D1E1">';
                echo '<div class="messagefont"><a style="text-decoration:none">&nbsp;' . $rowtop['thread_message']  . '&nbsp;&nbsp;</a></div>';
                echo '</td>' ;
                  echo 'There are no replies for this thread yet.';

                }
              }
              else
              {

                    /*there are replies to be printed*/
                  /*the thread header and message is posted first*/
                    while($rowtop = mysqli_fetch_assoc($resulttop) )
                      {
                        $_SESSION['threadname'] = $rowtop['thread_name'];
                        echo '<tbody>';
                        echo '<tr>';
                        echo '<th scope="col" style="border-radius: 10px 0px 0px 0px"> ' . date('d-m-Y', strtotime($rowtop['thread_timestamp'])). '</th>';
                        echo '<th style="text-align:left; border-radius: 00px 10px 0px 0px">Posts</th>';

                        echo '</tr>';


                        echo '<tr>';
                        echo '<td class="by smallfont" style="width:100px">';
                        echo '<li>'. $rowtop['username'] . '</li>';
                        rolename($rowtop['thread_by_user']);
                        echo '</td>';

                        echo '<td style="width: 80%" class="categories">';
                        echo '<div class="smallfont" style="font-weight:bold; line-height: 40%"><a>&nbsp;' . $rowtop['thread_name'] . '</div>';
                        echo '<div  class="smallfont" style="font-weight:bold; line-height: 40%; text-align: right;">'. date('d-m-Y h:i:sa', strtotime($rowtop['thread_timestamp'])). '</div>';
                        echo '<hr size="1" style="color:#D1D1E1; background-color:#D1D1E1">';
                        echo '<div class="messagefont"><a style="text-decoration:none">&nbsp;' . $rowtop['thread_message']  . '&nbsp;&nbsp;</a></div>';
                        echo '</td>' ;

                        if(mysqli_num_rows($result) == 0){

                            echo "<br><br>";
                            echo "<form method='post' action='reply.php?id=" . $_GET['thread_id'] . "'>";
                            echo "<textarea style= 'width: 500px; height: 200px;' name='reply-content'></textarea><br>";
                            echo ' <input type="submit" value="Submit reply" /> ';
                            echo '</form>';
                        }

                  echo ' <div style="white-space:nowrap"> ';
                  echo '   </tr>';
                }
                
                /*print the replies message*/
                while($row = mysqli_fetch_assoc($result) )
                  {

                    echo '<tr>';
                    echo '<td class="by smallfont" style="width:100px">';
                    echo '<li>'. $row['username'] . '</li>';
                    rolename($row['post_by_user']);
                    echo '</td>';

                    echo '<td style="width: 80%" class="categories">';
                    echo '<div class="by smallfont" style="font-weight:bold; line-height: 50%">&nbsp;Re: ' . $_SESSION['threadname'] . '</div>';
                    echo '<div class="smallfont" style="font-weight:bold; line-height: 30%; text-align: right;">'. date('d-m-Y h:i:sa', strtotime($row['post_timestamp'])). '</div>';
                    echo '<hr size="1" style="color:#D1D1E1; background-color:#D1D1E1">';
                    echo '<div class="messagefont"><a style="text-decoration:none; text-align: left;" class="messagefont">&nbsp;' . $row['message']  . '&nbsp;&nbsp;</a></div>';
                    echo '<div class="smallfont" style="line-height: 30%; text-align: right;">';
                    
                    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['user_id'] ){
                    echo '<a href="deletePost.php?id='. $row['post_id'] . '&thread_id=' . $row['post_thread_id'] . '" style="text-align: right">Delete</a>';
                    }

                    echo '</div>' ;
                    echo '</td>' ;

                    echo ' <div style="white-space:nowrap"> ';
              echo '</tr>';


              }
          }
      }
}

if (mysqli_num_rows($resulttop) <=  $_GET['thread_id'] ){

  echo ' </table>';
  if(isset($_SESSION['post_error'])){
    echo ($_SESSION['post_error']);
    unset($_SESSION['post_error']);
  }


    echo "<br><br>";
    echo "<form method='post' action='reply.php?id=" . $_GET['thread_id'] . "'>";
    echo "<textarea style= 'width: 500px; height: 200px;' name='reply-content'></textarea><br>";
    echo ' <input type="submit" value="Submit reply" /> ';
    echo '</form>';
}


      ?>
</table>
</body>
</html>
