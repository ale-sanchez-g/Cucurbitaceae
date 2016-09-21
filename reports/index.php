<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dashboard Report</title>
    </head>
    <style>
        h1 {
            color: black;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 40px;
            text-shadow: 2px 2px #808080;
        },
        table {
            align="center";
        },
        body {
            color: black;
            text-align: center;
            font-family: "Times New Roman", Times, serif;
            font-size: 40px;
        }
    </style>
    <h1>Dashboard</h1>
    <iframe src="graphs/pie3d.html" width=100% height=60% frameborder=0 scrolling=no id=report_image></iframe>
    <br>
    <?php
        require 'sql_connect.php';
        require './utils/table_updates.php';

        $res = mysql_query('select * from food order by food.date desc', $link);

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

            //print the url for tags
            tag_update($row_tags,"a");

            echo "</tr>";
        }
        // Close the table
        echo "</table>";
    ?>
</html>