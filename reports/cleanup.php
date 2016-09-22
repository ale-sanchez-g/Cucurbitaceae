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
    date_default_timezone_set('UTC');

/*example URL http://localhost/reports/cleanup.php/*/

    $result=mysql_query('truncate table food');
    
    if (!$result) {
        echo "<div id=db_error>DB Error, could not query the database</div>\n";
        echo "<div id=sql_err>";
        echo 'MySQL Error: ' . mysql_error();
        echo "</div>";
        exit;
    } else {
        echo "<h1 color=yellow>CleanUp Successful</h1>";
    }
    ?>

</body>
</html>