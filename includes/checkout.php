<?php
include "productInterface.php";

function basket(){
    $prefix = "basket_";
    $products = array();
    $subTotal = 0;
    foreach ($_COOKIE as $name => $value) {
        if (stripos($name, $prefix) === 0) {
            $item = array();
            $item['id'] = substr(htmlspecialchars($name), 7);
            $item['quantity'] = intval($value);
            $rtned_product = unqiueproduct($item['id']);
            if ($rtned_product){
                $item['price'] = $rtned_product['price'];
                $item['totalCost'] = $item['price']*$item['quantity'];
                $subTotal += $item['totalCost'];
                array_push($products, $item);
            } else {
                unset($_COOKIE[$name]);
            }
        }
    }
    $sub_total = htmlspecialchars($_COOKIE['subTotal']);
    $context = array();
    $context['purchases'] = $products;
    $context['subTotal'] = $sub_total;
    return $context;
}
?>
