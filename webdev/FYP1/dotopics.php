<?php
include 'dbFunctions.php';

// connect to the database
        //do a query for the topics

        $sql = "SELECT
                    topic.topic_id,
                    topic.topic_name,
                    topic.topic_message,
                    topic.topic_created,
                    topic.category_id
                FROM
                    topic
                WHERE
                    category_id = " . mysqli_real_escape_string($link, $_GET['category_id']);


        $result = mysqli_query($link, $sql);








?>
