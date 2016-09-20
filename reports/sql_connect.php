<?php
    /* The food table consists of four fields:
     *   ID
     *   TEST_NAME
     *   DATE
     *   STATUS
     */
    $link = mysql_connect('localhost', 'root');
    if (!$link) {
        die('Could not connect to MySQL server: ' . mysql_error());
    }
    $dbname = 'testreport';
    $db_selected = mysql_select_db($dbname, $link);
    if (!$db_selected) {
        die("Could not set $dbname: " . mysql_error());
    }
?>
