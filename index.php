<?php
require_once "Twig/Autoloader.php";
require_once "static/application.php";
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);
?>

<!-- Pre-header load -->
<?php
$sub_total = htmlspecialchars($_COOKIE['subTotal']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="static/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="static/cookie.js"></script>
</head>
<body>
    <?php
        $context = array();
        $context['subTotal'] = $sub_total;
        $search_term = '%' . htmlspecialchars($_GET["s"]) . '%';
        if (2 < strlen($search_term)){
            $return_arr = product_search($search_term);
            if ($return_arr){
                if (1 < count($return_arr)){
                    $template = $twig->loadTemplate("search-results.phtml");
                    $context['searchResults'] = $return_arr;
                } elseif (1 == count($return_arr)){
                    $template = $twig->loadTemplate("product-info.phtml");
                    $context['product'] = $return_arr[0];
                } else {
                    $template = $twig->loadTemplate("home.phtml");
                    $context['error'] = "no ideas found";
                }
            }
        } else {
            $template = $twig->loadTemplate("home.phtml");
        }
        $template->display($context);
     ?>
</body>
</html>
