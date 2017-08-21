<?php
require_once 'db.php';
require_once 'includes/random_compat.phar';

class User{
    public $error;

    private $username;
    public $id;
    public $email;
    public $address = array();

    public function __construct($username, $password){
        $this->login($username, $password);
    }

    private function user_add($details){
        $conn = new DB();
        foreach($details as $key => $value) {
            if (strlen($value) == 0 && $key != "address2nd" && $key != "phone"){
                echo $key . " is NULL";
                exit;
            } else {
                $details[$key] =  mysqli_real_escape_string($conn, stripslashes($value));
            }
        }
        extract($details);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`
                (username,password,email,enabled,firstName,lastName,address1st,address2nd,town,county,postcode,country,phone)
                VALUES
                ('$username','$hashed_password','$email','True','$firstName', '$lastName', '$address1st', '$address2nd', '$town', '$county', '$postcode', '$country', '$phone')";

        if ($this->$conn->query($sql) == False) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $this->$conn->close();
    }

    function login($username, $password){
        $conn = new DB();
        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows == 1){
            $row = $result -> fetch_assoc();
            if ($row["enabled"]){
                if ($row["active"]){
                    if (password_verify($password, $row["password"])){
                        $this->email =$row["email"];
                        $this->username = $row["username"];
                        $this->id = $row["id"];
                        $keys = ['firstName','lastName','address1st','address2nd','town','county','country','phone'];
                        foreach($keys as $key){
                            $this->address[$key] = $row[$key];
                        }
                    } else {
                        $this->error = "Username/password incorrect.";
                    }
                } else {
                    $this->error = "Account not activated, check email for activation code.";
                }
            } else {
                $this->error = "This account has been disabled, please contact customer servies.";
            }
        } else if ($result->num_rows != 0) {
            $this->error = "Could not login, please contact customer servies if this problem persists.";
        } else {
            $this->error = "Account not found.";
        }
    }

}
?>
