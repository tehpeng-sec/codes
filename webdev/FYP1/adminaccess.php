

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
    <link href="CSSfiles/headerCss.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/loginform.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/sidebar.css" rel="stylesheet" type="text/css">
    <link href="CSSfiles/ForTable.css" rel="stylesheet" type="text/css">

</head>

<?php include './header.php'; include './rolecheck.php';
if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(($_SESSION['userrole'] != 'Admin') AND ($_SESSION['userrole'] != 'Superuser'))
{
    header("Location: index.php");
    echo 'No access';
}else{

echo "<form method='post' action='addTopic.php'>";
echo "<br>Topic Header: <br><textarea style= 'width: 500px; height: 20px;' name='topic-name'></textarea>";
echo "<br>Topic Message:<br> <textarea style= 'width: 500px; height: 40px;' name='topic-message'></textarea>";
echo "<br>Topic Related Category id (1-4): <br><textarea style= 'width: 500px; height: 20px;' name='topic-cat'></textarea>";
echo ' <br><br><input type="submit" value="Add Topic" /> ';
echo '</form>';


echo "<br><br>";
echo '<div>';
echo '<b>categories</b><br>';
echo '1: IT Support <br>';
echo '2: Confession <br>';
echo '3: Studies <br>';
echo '4: Introduction <br>';
echo '</div>';

if(isset($_SESSION['topic_error'])){
  print_r($_SESSION['topic_error']);
  unset($_SESSION['topic_error']);
}

echo '<br><br>';





?>
<table cellpadding="8" width="100%" border="1" cellspacing="0">

    <?php


        include './alltopics.php';
    if(!$result)
    {
        echo 'The topics could not be displayed, please try again later.';
    }
    else
    {
        if(mysqli_num_rows($result) == 0)
        {
            echo 'There are no topics in this category yet.';
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

              echo '<tr>';
              echo '<td style="width: 60%" class="categories">';
              echo '<div class="categories"><a style="text-decoration:none" href="threads.php?topic_id=' . $row['topic_id'] . '">&nbsp;' . $row['topic_name']  . '&nbsp;&nbsp;</a></div>';
              echo  '<div class="smallfont">'.  $row['topic_message'] . '</div>';
              echo '</td>' ;

              echo '<td style="width:200px"  class="number smallfont">';
              echo '<div class="categories"><a style="text-decoration:none" href="deleteTopic.php?id=' . $row['topic_id'] . '">&nbsp;' . "delete"  . '&nbsp;&nbsp;</a></div>';
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
