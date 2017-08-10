<?php
require_once "base.php";
require_once "includes/productInterface.php";

$search_term = '%' . htmlspecialchars($_GET["s"]) . '%';
$return_arr = product_search($search_term);

if ($return_arr){
    if (1 < count($return_arr)){ // if more than one product show in list view
        $template = $twig->loadTemplate("searchResults.phtml");
        $context['searchResults'] = $return_arr;
    } elseif (1 == count($return_arr)){ // if one product show detailed view
        $context['product'] = $return_arr[0];
        $current_quantity = htmlspecialchars($_COOKIE['basket_' . $return_arr[0]['id']]);
        $context['currentQuantity'] = intval($current_quantity);
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
