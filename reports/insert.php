<html>
<style>
body {
    color: white;
    text-align: center;
    font-family: "Times New Roman", Times, serif;
    font-size: 40px;
    text-shadow: 2px 2px #808080;
    }
</style>
<body background="./images/background-lime-green.jpg">

<?php
    require './utils/sql_connect.php';
    date_default_timezone_set('Australia/Sydney');

/*example URL `http://localhost/historical_report/reports/insert.php?id=FOODqwerty1&name=alejandrogrid&status=1&tags=` */
  
    $value_id=$_GET["id"];
    $value_name=$_GET["name"];
    $value_status=$_GET["status"];
    
    switch($_GET["tags"]) {
        case "":
            $tags="none";
            break;
        default:
            $tags=$_GET["tags"];
            break;
    }
    $value_date=date(DATE_ATOM);
    
    $result=mysql_query('insert into food(`ID`,`TEST_NAME`,`DATE`,`STATUS`,`TAGS`) values ("'.
                        $value_id . '","'.
                        $value_name . '","'.
                        $value_date . '","'.
                        $value_status . '","'.
                        $tags . '")', $link);
    
    if (!$result) {
        echo "<div id=db_error>DB Error, could not query the database</div>\n";
        echo "<div id=sql_err>";
        echo 'MySQL Error: ' . mysql_error();
        echo "</div>";
        exit;
    } else {
        echo "<h1>Successful load of transaction ID</h1>".$value_id;
    }
    ?>
</body>
</html>