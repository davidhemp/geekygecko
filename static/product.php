<?php
require 'connect.php';

$query = "SELECT * FROM `products`";
$result = mysql_query($query, $conn);

if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $query;
    die($message);
} else {
    $return_arr = array();
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $row_array['productID'] = $row['productid'];
        $row_array['productName'] = $row['name'];
        $row_array['productDescription'] = $row['description'];
        $row_array['productPrice'] = $row['price'];
        $row_array['productQuantity'] = $row['quantity'];
        array_push($return_arr,$row_array);
    }
    // echo json_encode($return_arr);
}
mysql_close($conn);
?>
