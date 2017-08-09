<?php
require_once "Twig/Autoloader.php";

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);

$sub_total = number_format(htmlspecialchars($_COOKIE['subTotal']), 2);

$context = array();
$context['subTotal'] = $sub_total;
$context['media'] = "/media";
$context['static'] = "/static";
?>
