<?php
require_once 'db.php';

function user_add($details){
    $conn = db_connect();


    $first_name = $details["firstName"];
    echo $first_name;
    $last_name = $details["lastName"];
    echo $last_name;
    $address_1st = $details["address1st"];
    echo $address_1st;
    $address_2nd = $details["address2nd"];
    echo $address_2nd;
    $town = $details["town"];
    echo $town;
    $county = $details["county"];
    echo $county;
    $country = $details["country"];
    echo $country;
    $postcode = $details['postcode'];
    echo $postcode;
    $email = $details["username"];
    echo $email;
    $password = $details["password"];
    echo $password;
    $phone = $details["phone"];
    echo $phone;//
    $query = "INSERT INTO `users` (first_name,last_name,address_1st,address_2nd,town,county,country,email,password,phone) VALUES('$first_name','$last_name','$address_1st','$address_2nd','$town','$county','$country','$email','$password','$phone')";

    $result = mysql_query($query, $conn);
    mysql_close($conn);
}

function login($username, $password){
    $conn = db_connect();
    $query = "SELECT ('first_name', 'password') FROM `users` WHERE 'username' == '$username' AND 'password' == $password";
    $result = mysql_query($query, $conn);
    if ($result){
        session_start();
        $_SESSION['auth_key'] = base64_encode(random_bytes(64));
    } else {
        $error = "Username and/or password incorrect";
    }
}

?>
