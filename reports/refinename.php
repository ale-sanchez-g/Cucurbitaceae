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
        $res = mysqli_query($link, $q);


         //get the headers
         $row_id=mysqli_fetch_field_direct($res, 0);
         $row_tcname =mysqli_fetch_field_direct($res, 1);
         $row_date=mysqli_fetch_field_direct($res, 2);
         $row_tcstatus =mysqli_fetch_field_direct($res, 3);
         $row_tags =mysqli_fetch_field_direct($res, 4);

        // Open the table
        echo '<table border="1" id="report_table" align="center" width=100%>';

        // Output a row
        echo "<tr>";
        echo "<th>$row_id->name</th>";
        echo "<th>$row_tcname->name</th>";
        echo "<th>$row_date->name</th>";
        echo "<th>$row_tcstatus->name</th>";
        echo "<th>$row_tags->name</th>";
        echo "</tr>";


        // loops thorugh the DB results and prints them
        while ($row = $res->fetch_assoc()) {
            $row_id = $row["ID"];
            $row_tcname = $row["TEST_NAME"];
            $row_date = $row["DATE"];
            $row_tcstatus = $row["STATUS"];
            $row_tags = $row["TAGS"];

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