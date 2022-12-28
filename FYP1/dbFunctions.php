<?php
$db_host = "aa13eprjmd79acj.cdpkcir7et7n.us-east-1.rds.amazonaws.com";
$db_username = "admin";
$db_password = "vampire-1";
$db_name = "onerp";
$link = mysqli_connect($db_host,$db_username,$db_password,$db_name) or 
        die(mysqli_connect_error());
?>
