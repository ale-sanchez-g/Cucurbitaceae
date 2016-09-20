<?php
    require 'sql_connect.php';
    
    $res = mysql_query('SELECT `TAGS`,COUNT(*) as count from food GROUP BY `TAGS` order by count DESC', $link);
    

    // Open the table
    echo '<table border="1">';
    echo "<tr><th>";
    echo mysql_field_name($res, 0);
    echo "</th><th>";
    echo mysql_field_name($res, 1);
    echo "</th></tr>";
    
    while ($row = mysql_fetch_assoc($res)) {
        echo "<tr><td>"; 
        echo $row[mysql_field_name($res, 0)];
        echo "</td><td>";
        echo $row[mysql_field_name($res, 1)];
        echo "</td></tr>";
    }
    
    // Close the table
    echo "</table>";
    ?>