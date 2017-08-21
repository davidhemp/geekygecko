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
        session_start();
        if(isset($_SESSION["user"])){
            $context["address"] = $_SESSION["user"]->address;
            $context["email"] = $_SESSION["user"]->email;
            $context["loggedIn"] = True;
        }
        $template = $twig->loadTemplate("address.phtml");
        $template->display($context);
     ?>
</body>
</html>
