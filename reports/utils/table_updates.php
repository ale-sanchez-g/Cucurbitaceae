<?php
    function tag_update($row_tags,$type) {
        $urltag = str_replace('@','',$row_tags);
        $tag_arr = split(',',$urltag);
        $arr_size = count($tag_arr);
        echo "<td>";
        for ($x = 1; $x <= $arr_size; $x++) {
            $t = $tag_arr[$x-1];
            if ($type == "strong") {
                echo "<$type>$t</$type><br>";
            } else {
                echo "<$type href=refinetag.php?tag=$t>$t</$type><br>";
            }
        }
        echo "</td";
    }

          function table_headers($res) {

                //get the headers
                $row_id=mysqli_fetch_field_direct($res, 0);
                $row_tcname =mysqli_fetch_field_direct($res, 1);
                $row_date=mysqli_fetch_field_direct($res, 2);
                $row_tcstatus =mysqli_fetch_field_direct($res, 3);
                $row_tags =mysqli_fetch_field_direct($res, 4);
                $row_agent =mysqli_fetch_field_direct($res, 5);
                $row_domain =mysqli_fetch_field_direct($res, 6);
                // Output a row
                echo "<tr>";
                echo "<th>$row_id->name</th>";
                echo "<th>$row_tcname->name</th>";
                echo "<th>$row_date->name</th>";
                echo "<th>$row_tcstatus->name</th>";
                echo "<th>$row_tags->name</th>";
                echo "<th>$row_agent->name</th>";
                echo "<th>$row_domain->name</th>";
                echo "</tr>";
          }
?>

