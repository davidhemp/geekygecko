<?php
require_once "base.php";
require_once "includes/checkout.php";
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        $context = basket($context);

        $template = $twig->loadTemplate("basket.phtml");
        $template->display($context);
     ?>
</html>
