<?php
function db_connect(){
    $config = parse_ini_file('../../gg_config.ini');
    // Create connection
    $conn = mysql_connect(  $config['server'],
                            $config['user'],
                            $config['pass']);

    // // Check connection
    if (!$conn) {
        die("Connection failed: " . mysql_connect_error());
    }

    if (!mysql_select_db($config['db'], $conn)) {
        die("Could not select database");
    }
    return $conn;
}
?>
