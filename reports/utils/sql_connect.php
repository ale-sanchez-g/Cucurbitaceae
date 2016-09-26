<?php
    /* The food table consists of four fields:
     *   ID
     *   TEST_NAME
     *   DATE
     *   STATUS
     */
    $dbname = 'testreport';

    $link = mysqli_connect("127.0.0.1", "report", "yumyum", $dbname, '3306');
    if (!$link) {
        die('Could not connect to MySQL server: ' . mysqli_connect_error());
    }

    $db_selected = mysqli_select_db($link, $dbname);
    if (!$db_selected) {
        die("Could not set $dbname: " . mysqli_connect_error());
    }
?>
