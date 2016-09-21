<?php
    require 'sql_connect.php';
    $res = mysql_query('select status, count(status) from food group by status',$link);
    
    
    $ret=array();

    while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
        array_push($ret, $row);
    }

    echo json_encode($ret);
    return json_encode($ret);
    mysql_free_result($res);
?>
</html>