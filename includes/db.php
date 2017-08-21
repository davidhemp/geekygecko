<?php
class DB{
    private $conn;
    public $connection_error;

    function __construct(){
        $this->connect();
    }

    private function connect(){
        $config = parse_ini_file('../../gg_config.ini');
        // Create connection
        $conn = new mysqli($config['server'],
                            $config['user'],
                            $config['pass'],
                            $config['db']);

        // // Check connection
        if ($conn->connect_error) {
            $connection_error = "Connection failed: " . $conn->connect_error;
        }
        $this->conn = $conn;
    }
    public function query($sql){
        if(!isset($this->conn)){
            $this->connect();
        }
        return $this->conn->query($sql);
    }
    public function close(){
        $this->conn->close();
    }
}
?>
