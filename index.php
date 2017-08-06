<?php
require_once "Twig/Autoloader.php";
require_once "includes/productInterface.php";
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);
?>

<!-- Pre-header load -->
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
$sub_total = number_format(htmlspecialchars($_COOKIE['subTotal']), 2);
$search_term = '%' . htmlspecialchars($_GET["s"]) . '%';
$context = array();
$context['subTotal'] = $sub_total;
if (2 < strlen($search_term)){
    $return_arr = product_search($search_term);
}
if ($return_arr){
    if (1 < count($return_arr)){ // if more than one product show in list view
        $template = $twig->loadTemplate("search-results.phtml");
        $context['searchResults'] = $return_arr;
    } elseif (1 == count($return_arr)){ // if one product show detailed view
        $context['product'] = $return_arr[0];
        $current_quantity = htmlspecialchars($_COOKIE['basket_' . $return_arr[0]['id']]);
        $context['currentQuantity'] = intval($current_quantity);
        $template = $twig->loadTemplate("product-info.phtml");
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
</html>
