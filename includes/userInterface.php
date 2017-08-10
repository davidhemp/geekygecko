<?php
require_once 'db.php';

function user_add($details){
    $conn = db_connect();
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
    $sql = "INSERT INTO `users` (first_name,last_name,address_1st,address_2nd,town,county,country,email,password,phone) VALUES('$firstName', '$lastName', '$address1st', '$address2nd', '$town', '$county', '$country', '$username', '$hashed_password', '$phone')";

    if ($conn->query($sql) == TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn ->close();
}

function login($username, $password){
    $conn = db_connect();
    $sql = "SELECT * FROM `users` WHERE `email` = '$username'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1){
        $row = $result -> fetch_assoc();
        if (password_verify($password, $row["password"])){
            session_start();
            // $_SESSION['auth_key'] = random_bytes(64);
            $_SESSION['username'] = $username;
            return True;
        } else {
            return False;
            exit;
        }
    } else { // if this fails then the email/username is not unqiue somehow
        return False;
        exit;
    }
}

?>
