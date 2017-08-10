<?php
function db_connect(){
    $config = parse_ini_file('../../gg_config.ini');
    // Create connection
    $conn = new mysqli($config['server'],
                        $config['user'],
                        $config['pass'],
                        $config['db']);

    // // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>
