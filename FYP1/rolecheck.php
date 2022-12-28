<?php

include "dbFunctions.php";
if (isset($_SESSION['user_id'])){
  $id = $_SESSION['user_id'];
}else{
  $id = 0;
}
$rolesql = "SELECT user.user_id, role.role_name
            FROM user
            INNER JOIN role ON role.role_id = user.role_id
            WHERE user.user_id = ". $id;
$exec =  mysqli_query($link, $rolesql);
if(!$exec or $id == 0)
{
    $_SESSION['userrole'] = 'Not a Member';
}
else
{
    if(mysqli_num_rows($exec) == 0)
    {
        $_SESSION['userrole'] = 'New Member';
    }
    else
    {
while($r = mysqli_fetch_assoc($exec)){
    $_SESSION['userrole'] = $r['role_name'];
}
}
}
?>
