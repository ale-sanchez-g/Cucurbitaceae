<html>

   <head>
      <title>Paging Using PHP</title>
   </head>
   <body>
      <?php
      require './utils/table_updates.php';

        $rec_limit = 10;
	$link = mysqli_connect("172.17.0.2", "report", "yumyum", "testreport", "3306");
        $q = 'select * from food order by food.date desc';
        $res = mysqli_query($link, $q);

	$q = 'select count(id) from food';
        $counter = mysqli_query($link, $q);
	$row = mysqli_fetch_array($counter, MYSQLI_NUM);
	$rec_count = $row[0];
         if( isset($_GET{'page'} ) ) {
            $page = $_GET{'page'} + 1;
            $offset = $rec_limit * $page ;
         }else {
            $page = 0;
            $offset = 0;
         }
         $left_rec = $rec_count - ($page * $rec_limit);

        $q = 'select * from food order by food.date desc limit '.$offset.', '.$rec_limit;
        $res = mysqli_query($link, $q);
         echo '<table border="1" id="report_table" align="center" width=100%>';

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
    echo "</table>";
    echo "<p>";
        if( $left_rec < $rec_limit ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page=$last\">Previous 10 Records</a>";
         }else if( $page > 0 ) {
            $last = $page - 2;
            echo "<a href = \"$_PHP_SELF?page=$last\">Previous 10 Records</a> |";
            echo "<a href = \"$_PHP_SELF?page=$page\">Next 10 Records</a>";
         }else if( $page == 0 ) {
            echo "<a href = \"$_PHP_SELF?page=$page\">Next 10 Records</a>";
         }
     echo "</p>";

	?>
   </body>
</html>
