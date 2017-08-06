<?php
include "productInterface.php";

function basket(){
    $prefix = "basket_";
    $products = array();
    $sub_total = 0;
    foreach ($_COOKIE as $name => $value) {
        if (stripos($name, $prefix) === 0) {
            $item = array();
            $item['id'] = substr(htmlspecialchars($name), 7);
            $item['quantity'] = intval($value);
            $rtned_product = unqiueproduct($item['id']);
            if ($rtned_product){
                $item['price'] = sprintf("%.02f", $rtned_product['price']);
                $item['name']= $rtned_product['name'];
                $item['maxQuantity'] = sprintf("%.02f", $rtned_product['quantity']);
                $item['totalCost'] = sprintf("%.02f", $item['price']*$item['quantity']);
                $sub_total += $item['totalCost'];
                array_push($products, $item);
            } else {
                unset($_COOKIE[$name]);
            }
        }
    }
    if ($sub_total > 20){
        $delivery = 0;
    } else {
        $delivery = 4.99;
    }
    $context = array();
    $context['purchases'] = $products;
    $context['delivery'] = sprintf("%.02f", $delivery);
    $context['subTotal'] = sprintf("%.02f", $sub_total);
    $context['total'] = sprintf("%.02f", $sub_total + $delivery);
    return $context;
}
?>
