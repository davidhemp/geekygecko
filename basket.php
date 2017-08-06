<?php
require_once "Twig/Autoloader.php";
require_once "includes/checkout.php";
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);
?>

<!-- Pre-header load -->
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        $context = basket();
        $template = $twig->loadTemplate("basket.phtml");
        $template->display($context);
     ?>
</html>
