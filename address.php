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
        if($_SESSION['email']){
            $address = getAddress($_SESSION['email']);
            if($address){
                $context['address'] = $address;
                $context['email'] = $_SESSION['email'];
                $context['hasAccount'] = True;
            } else {
                $context['error'] = "Could not find an address of this account";
            }
        }
        $template = $twig->loadTemplate("address.phtml");
        $template->display($context);
     ?>
</body>
</html>
