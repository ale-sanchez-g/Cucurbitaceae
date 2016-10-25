<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dashboard Report</title>
        <link rel="stylesheet" type="text/css" href=".\utils\style.css"/>
    </head>
    <style>
    </style>
        <br>
        <h1>Dashboard</h1>
        <br>
        <h2>LAST<br>
        <a href="?limit=10">10</a> | <a href="?limit=50">50</a> | <a href="?limit=100">100</a>
        </h2>
        <br>
        <?php
            $limit = $_GET["limit"];
            require './utils/sql_connect.php';
            require './utils/table_updates.php';
            if ($limit == null) {
                $q = 'select * from food order by food.date desc';
                }
            else {
                $q = 'select * from food order by food.date desc limit '.$limit;
                }
            $res = mysqli_query($link, $q);

            // Open the table
            echo '<table border="1" id="report_table" align="center" width=100%>';

            //get the headers
            $row_id=mysqli_fetch_field_direct($res, 0);
            $row_tcname =mysqli_fetch_field_direct($res, 1);
            $row_date=mysqli_fetch_field_direct($res, 2);
            $row_tcstatus =mysqli_fetch_field_direct($res, 3);
            $row_tags =mysqli_fetch_field_direct($res, 4);

            // Output a row
            echo "<tr>";
            echo "<th>$row_id->name</th>";
            echo "<th>$row_tcname->name</th>";
            echo "<th>$row_date->name</th>";
            echo "<th>$row_tcstatus->name</th>";
            echo "<th>$row_tags->name</th>";
            echo "</tr>";


            while ($row = $res->fetch_assoc()) {
                $row_id = $row["ID"];
                $row_tcname = $row["TEST_NAME"];
                $row_date = $row["DATE"];
                $row_tcstatus = $row["STATUS"];
                $row_tags = $row["TAGS"];

                // Output a row
                echo "<tr>";
                echo "<td>$row_id</td>";

                $urlname = str_replace(' ','_',$row_tcname);
                echo "<td><a color=white href=refinename.php?name=$urlname>$row_tcname</a></td>";

                echo "<td>$row_date</td>";
                echo "<td>$row_tcstatus</td>";

                //print the url for tags
                tag_update($row_tags,"a");

                echo "</tr>";
            }

            // Close the table
            echo "</table>";
        ?>
    </body>
</html>