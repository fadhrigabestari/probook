<?php
try {
    $db_conn = new PDO($db_dsn, $db_username, $db_password);
    // set the PDO error mode to exception
    $db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
} catch(PDOException $e) {
    header('content-type: text/plain');
    echo "Connection failed: " . $e->getMessage();
    die;
}
