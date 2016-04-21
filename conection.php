<?php
    
    define('DB_SERVER','localhost');
    define('DB_NAME','apuestas');
    define('DB_USER','root');
    define('DB_PASS','Jorge1990');

    $con = mysql_connect(DB_SERVER,DB_USER,DB_PASS);
    mysql_select_db(DB_NAME,$con);
?>