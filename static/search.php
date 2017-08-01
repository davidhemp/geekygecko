<?php
function product_search($search_term){
    require 'connect.php';
    $conn = db_connect();
    $query = "SELECT * FROM `products` WHERE name LIKE '$search_term' or productid LIKE '$search_term'";
    $result = mysql_query($query, $conn);

    if (!$result) {
        $message  = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    } else {
        $return_arr = array();
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            $row_array['id'] = $row['productid'];
            $row_array['name'] = $row['name'];
            $row_array['description'] = $row['description'];
            $row_array['price'] = $row['price'];
            $row_array['quantity'] = $row['quantity'];
            array_push($return_arr, $row_array);
        }
        // echo json_encode($return_arr);
    }
    mysql_close($conn);
    return $return_arr;
}
?>
