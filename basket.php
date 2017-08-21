<?php
require_once "base.php";
require_once "includes/checkout.php";
require_once "includes/userInterface.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        $context = basket($context);
        $template = $twig->loadTemplate("basket.phtml");
        $template->display($context);
     ?>
</body>
</html>
