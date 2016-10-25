<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Refined Report</title>
        <link rel="stylesheet" type="text/css" href=".\utils\style.css"/>
    </head>
<body>
<ul class="navigation">
    <li class="nav-item"><a href="/historical_report/reports/">Home</a></li>
</ul>

<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label for="nav-trigger"></label>

<div class="site-wrap">
    <!-- insert the rest of your page markup here -->

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
</div>
</body>
</html>