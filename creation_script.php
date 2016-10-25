 <?php
// Connect to MySQL
    $dbname = 'testreport';

    $link = mysqli_connect("172.17.0.2", "report", "yumyum");
    if (!$link) {
        die('Could not connect to MySQL server: ' . mysqli_connect_error());
    }

    $db_selected = mysqli_select_db($link, $dbname);
    if (!$db_selected) {
        $q = 'CREATE DATABASE '.$dbname;

        if (mysqli_query($link, $q)) {
              echo "Database my_db created successfully\n";
          } else {
              echo 'Error creating database: ' . mysqli_error() . "\n";
          }
    } else {
        echo "Database already created\n";

    }
mysqli_close($link);

// Connect to MYSQL and DB
    $link = mysqli_connect("172.17.0.2", "report", "yumyum", $dbname, '3306');

    $q = "SELECT ID FROM food";
    $result = mysqli_query($link, $q);

    if(empty($result)) {
                    $query = "CREATE TABLE food (
                              ID char(50),
                              TEST_NAME text,
                              DATE text,
                              STATUS text,
                              AGENT text,
                              DOMAIN text,
                              TAGS text,
                              PRIMARY KEY  (ID)
                              )";
                    $result = mysqli_query($link, $query);
    } else {
    echo "Somthing has gone wrong" . mysqli_error() . "\n";
    }

mysqli_close($link);
?>
