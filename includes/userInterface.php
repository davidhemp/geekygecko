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
    $query = "INSERT INTO `users` (first_name,last_name,address_1st,address_2nd,town,county,country,email,password,phone) VALUES('$firstName', '$lastName', '$address1st', '$address2nd', '$town', '$county', '$country', '$username', '$hashed_password', '$phone')";

    if (mysqli_query($conn, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

function login($username, $password){
    $conn = db_connect();
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($username);
    $password = mysqli_real_escape_string($password);
    $query = "SELECT * FROM `users` WHERE `email` = '$username' AND `password` = '$password'";
    $result = mysqli_query($query, $conn);
    if (mysqli_num_rows($result)){
        session_start();
        // $_SESSION['auth_key'] = random_bytes(64);
        $_SESSION['username'] = $username;
        return True;
    } else {
        return False;
        exit;
    }
}

?>
