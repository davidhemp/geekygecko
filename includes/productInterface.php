<?php
require_once 'db.php';

function seoUrl($string) {
    //Lower case everything
    $string = strtolower($string);
    //Make alphanumeric (removes all other characters)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    //Clean up multiple dashes or whitespaces
    $string = preg_replace("/[\s-]+/", " ", $string);
    //Convert whitespaces and underscore to dash
    $string = preg_replace("/[\s_]/", "-", $string);
    return $string;
}

function product_search($search_term){
    $conn = db_connect();
    $query = "SELECT * FROM `products` WHERE name LIKE '$search_term' or productid LIKE '$search_term' ORDER BY productid DESC";
    $result = mysqli_query($query, $conn);

    mysqli_close($conn);
    if (!$result) {
        return FALSE;
    } else {
        return extractRows($result);
    }
}

function unqiueproduct($unqiue){
    $conn = db_connect();
    $query = "SELECT * FROM `products` WHERE productid = '$unqiue'";
    $result = mysqli_query($query, $conn);
    mysqli_close($conn);

    if (!$result) {
        return FALSE;
    } elseif (mysqli_num_rows($result) > 1) {
        return FALSE;
    } else {
        return extractRows($result)[0];
    }
}

function extractRows($result){
    $return_arr = array();
    while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['id'] = $row['productid'];
        $row_array['name'] = $row['name'];
        $row_array['url'] = seoURL($row['name']);
        $row_array['description'] = $row['description'];
        $row_array['price'] = number_format($row['price'], 2);
        $row_array['quantity'] = $row['quantity'];
        array_push($return_arr, $row_array);
    }
    return $return_arr;
}
?>
