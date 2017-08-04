<?php
require_once "static/application.php";
$prefix = "basket_";
$products = array();
$subTotal = 0;
foreach ($_COOKIE as $name => $value) {
    if (stripos($name, $prefix) === 0) {
        $item = array();
        $item['id'] = substr(htmlspecialchars($name), 7);
        $item['quantity'] = intval($value);
        $return_arr = product_search("%" . $item['id'] . "%");
        if ($return_arr){
            $item['price'] = $return_arr[0]['price'];
            $item['totalCost'] = $item['price']*$item['quantity'];
            $subTotal += $item['totalCost'];
            array_push($products, $item);
        } else {
            unset($_COOKIE[$name]);
        }
    }
}
$sub_total = htmlspecialchars($_COOKIE['subTotal']);
?>
