<?php
include './dbFunctions.php';


$query = "SELECT *
            FROM thread INNER JOIN user ON thread_by_user = user_id
          ORDER
             BY thread_id DESC
          LIMIT 5";
$result = mysqli_query($link, $query) or die(mysqli_error($link));
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo     "<td class='smallfont'><a class='pointer' title='Link' href='post.php?thread_id=".$row['thread_id']."' style='color:#00FA9A;''>" . $row['thread_name'] . "</a> </td> ";
    echo  "</tr>";
}

?>
