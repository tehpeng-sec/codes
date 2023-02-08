<?php
include 'dbFunctions.php';

// connect to the database
        //do a query for the topics

        $sql = "SELECT
                    *
                FROM
                    topic";


        $result = mysqli_query($link, $sql);








?>
