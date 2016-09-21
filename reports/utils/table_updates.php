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
?>

