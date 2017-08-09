<?php
include 'base.php';
require_once "includes/userInterface.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
    <?php
        $template = $twig->loadTemplate("accountLoginCreate.phtml");
        $template->display($context);
     ?>
</html>
