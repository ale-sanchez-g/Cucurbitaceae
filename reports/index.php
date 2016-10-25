<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Dashboard Report</title>
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
        <br>
        <h1>Historical Execution Report</h1>
        <br>
        <h2>Show Max<br>
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

            //populates the headers of the table
            table_headers($res);

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
<br>
<a href="https://github.com/ale-sanchez-g/historical_report/blob/master/README.md">GitHub reference</a>
<br>
<a href="https://hub.docker.com/r/morsisdivine/cucumber-historical-reports/">Docker reference</a>
</div>
</body>
</html>