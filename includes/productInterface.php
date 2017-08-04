<?php
require_once 'db.php';

function product_search($search_term){
    $conn = db_connect();
    $query = "SELECT * FROM `products` WHERE name LIKE '$search_term' or productid LIKE '$search_term'";
    $result = mysql_query($query, $conn);

    mysql_close($conn);
    if (!$result) {
        return FALSE;
    } else {
        return extractRows($result);
    }
}

function unqiueproduct($unqiue){
    $conn = db_connect();
    $query = "SELECT * FROM `products` WHERE productid LIKE '$unqiue'";
    $result = mysql_query($query, $conn);
    mysql_close($conn);

    if (!$result) {
        return FALSE;
    } elseif (mysql_num_rows($result) > 1) {
        return FALSE;
    } else {
        return extractRows($result)[0];
    }
}

function extractRows($result){
    $return_arr = array();
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['id'] = $row['productid'];
        $row_array['name'] = $row['name'];
        $row_array['description'] = $row['description'];
        $row_array['price'] = $row['price'];
        $row_array['quantity'] = $row['quantity'];
        array_push($return_arr, $row_array);
    return $return_arr;
    }
}
?>
