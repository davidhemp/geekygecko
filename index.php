<?php
require_once "Twig/Autoloader.php";
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);
?>
<html>
<head>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <?php
        $context = array();
        $search_term = '%' . htmlspecialchars($_GET["s"]) . '%';
        if (2 < strlen($search_term)){
            include "static/search.php";
            $return_arr = product_search($search_term);
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
        } else {
            $template = $twig->loadTemplate("home.phtml");
        }
        $template->display($context);
     ?>
</body>
</html>
