<?php
include "base.php";
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        $template = $twig->loadTemplate("home.phtml");
        $template->display($context);
     ?>
</html>
