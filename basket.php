<?php
require_once "Twig/Autoloader.php";
require_once "static/application.php";
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);
?>

<!-- Pre-header load -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "static/basket.php"
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
        $context['purchases'] = $products;
        $context['subTotal'] = $sub_total;
        $template = $twig->loadTemplate("basket.phtml");
        $template->display($context);
     ?>
</body>
</html>
