<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Refined Report</title>
</head>
<style>
h1 {
    color: black;
    text-align: center;
    font-family: "Times New Roman", Times, serif;
    font-size: 40px;
    text-shadow: 2px 2px #808080;
},
body {
    color: black;
    text-align: center;
    font-family: "Times New Roman", Times, serif;
    font-size: 40px;
    }
</style>
<br>
<a href='./'>Home</a>
<br>
    <?php
    $search = $_GET["tag"];
    echo "<h1 id=titleID>Report Refined by ".$search."</h1>";
    require 'sql_connect.php';
    if ($search == 'undefined') {
        $q = "select * from food where TAGS='".$search."' order by food.date desc";
    } else {
        $q = "select * from food where TAGS like '%".$search."%' order by food.date desc";
    }
    $res = mysql_query($q, $link);

    // Open the table
    echo '<table border="1" id="report_table" align="center">';
    
    //get the headers
    $row_id=mysql_field_name($res, 0);
    $row_tcname =mysql_field_name($res, 1);
    $row_date=mysql_field_name($res, 2);
    $row_tcstatus =mysql_field_name($res, 3);
    $row_tags =mysql_field_name($res, 4);
    
    // Output a row
    echo "<tr>";
    echo "<th>$row_id</th>";
    echo "<th>$row_tcname</th>";
    echo "<th>$row_date</th>";
    echo "<th>$row_tcstatus</th>";
    echo "<th>$row_tags</th>";
    echo "</tr>";
    
    
    // loops thorugh the DB results and prints them
    while ($row = mysql_fetch_assoc($res)) {
        $row_id=$row[mysql_field_name($res, 0)];
        $row_tcname=$row[mysql_field_name($res, 1)];
        $row_date=$row[mysql_field_name($res, 2)];
        $row_tcstatus=$row[mysql_field_name($res, 3)];
        $row_tags=$row[mysql_field_name($res, 4)];
        // Output a row
        echo "<tr>";
        echo "<td>$row_id</td>";

        $urlname = str_replace(' ','_',$row_tcname);
        echo "<td><a href=refinename.php?name=$urlname>$row_tcname</a></td>";

        echo "<td>$row_date</td>";
        echo "<td>$row_tcstatus</td>";
        $urltag = str_replace('@','',$row_tags);
        $tag_arr = split(',',$urltag);
        $arr_size = count($tag_arr);
        if ($arr_size > 1 ) {
            echo "<td>";
            for ($x = 1; $x <= $arr_size; $x++) {
            $t = $tag_arr[$x-1];
            echo "<strong>$t</strong><br>";
            }
            echo "</td";
        } else {
            echo "<td><strong>$urltag</strong></td>";
        }
        echo "</tr>";
    }
    // Close the table
    echo "</table>";
    ?>
</html>