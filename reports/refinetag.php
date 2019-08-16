<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Refined Report</title>
        <link rel="stylesheet" type="text/css" href=".\utils\style.css"/>
    </head>
<body>
    <?php 
        include("navigation.php");
    ?>

<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label for="nav-trigger"></label>

<div class="site-wrap">
    <!-- insert the rest of your page markup here -->
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
            $res = mysqli_query($link, $q);


            //html start
            echo "<h1 id=titleID>Report Refined by ".$search."</h1>";

            // Open the table
            echo '<table border="1" id="report_table" align="center" width=100%>';

            //populates the headers of the table
            table_headers($res);

            // loops thorugh the DB results and prints them
            while ($row = $res->fetch_assoc()) {
                $row_id = $row["ID"];
                $row_tcname = $row["TEST_NAME"];
                $row_date = $row["DATE"];
                $row_tcstatus = $row["STATUS"];
                $row_tags = $row["TAGS"];
                $row_agent = $row["AGENT"];
                $row_domain = $row["DOMAIN"];

                // Output a row
                echo "<tr>";
                echo "<td>$row_id</td>";

                $urlname = str_replace(' ','_',$row_tcname);
                echo "<td><a href=refinename.php?name=$urlname>$row_tcname</a></td>";

                echo "<td>$row_date</td>";
                echo "<td>$row_tcstatus</td>";
                echo "<td>$row_agent</td>";
                echo "<td>$row_domain</td>";

                //print the strong tags
                tag_update($row_tags,"strong");
                echo "</tr>";
            }
            // Close the table
            echo "</table>";
        ?>
</div>
</body>
</html>