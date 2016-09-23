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
            require './utils/sql_connect.php';
            require './utils/table_updates.php';

            //init search variable from url
            $search = $_GET["tag"];
            if ($search == 'undefined') {
                $q = "select * from food where TAGS='".$search."' order by food.date desc";
            } else {
                $q = "select * from food where TAGS like '%".$search."%' order by food.date desc";
            }
            $res = mysql_query($q, $link);

            //get the headers
            $row_id=mysql_field_name($res, 0);
            $row_tcname =mysql_field_name($res, 1);
            $row_date=mysql_field_name($res, 2);
            $row_tcstatus =mysql_field_name($res, 3);
            $row_tags =mysql_field_name($res, 4);

            //html start
            echo "<h1 id=titleID>Report Refined by ".$search."</h1>";

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

                $urlname = str_replace(' ','_',$row_tcname);
                echo "<td><a href=refinename.php?name=$urlname>$row_tcname</a></td>";

                echo "<td>$row_date</td>";
                echo "<td>$row_tcstatus</td>";

                //print the strong tags
                tag_update($row_tags,"strong");

                echo "</tr>";
            }
            // Close the table
            echo "</table>";
        ?>
</html>