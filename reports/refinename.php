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
        require './utils/table_updates.php';
        require './utils/sql_connect.php';

        $search = $_GET["name"];
        $term = str_replace('_',' ',$search);

        echo "<h1 id=titleID align=center>Report Refined by ".$term."</h1>";
        $q = "select * from food where TEST_NAME='".$term."' order by food.date desc";
        $res = mysql_query($q, $link);


        //get the headers
        $row_id=mysql_field_name($res, 0);
        $row_tcname =mysql_field_name($res, 1);
        $row_date=mysql_field_name($res, 2);
        $row_tcstatus =mysql_field_name($res, 3);
        $row_tags =mysql_field_name($res, 4);

        // Open the table
        echo '<table border="1" id="report_table" align="center">';

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
            echo "<td><strong>$row_tcname</strong></td>";
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