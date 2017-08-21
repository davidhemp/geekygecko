<?php
require_once "base.php";
require_once "includes/productInterface.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$search_term = '%' . htmlspecialchars($_GET["s"]) . '%';
$return_arr = Product::search($search_term);

if ($return_arr){
    if (1 < count($return_arr)){ // if more than one product show in list view
        $template = $twig->loadTemplate("searchResults.phtml");
        $context['searchResults'] = $return_arr;
    } elseif (1 == count($return_arr)){ // if one product show detailed view
        $context['product'] = $return_arr[0];
        $product_id ='basket_' . $return_arr[0]['id'];
        if (isset($_COOKIE[$product_id])){
            $context['currentQuantity'] = intval(htmlspecialchars($_COOKIE[$product_id]));
        }
        $template = $twig->loadTemplate("productInfo.phtml");
    } else {    // If no product found so "no found" view
        $template = $twig->loadTemplate("home.phtml");
        $context['error'] = "no ideas found";
    }
} else {
    $template = $twig->loadTemplate("home.phtml");
}
?>
<!-- Views -->

<!DOCTYPE html>
<html lang="en">
    <?php
        $template->display($context);
     ?>
</body>
</html>
