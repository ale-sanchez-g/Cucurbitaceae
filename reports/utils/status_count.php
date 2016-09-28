<?php
    require 'sql_connect.php';
    $res = mysqli_query($link,'select status, count(status) from food group by status');
    
    
    $ret=array();

    while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
        array_push($ret, $row);
    }

    echo json_encode($ret);
    return json_encode($ret);
    mysql_free_result($res);
?>