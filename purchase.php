<?php
require_once "base.php";
require_once "includes/checkout.php";
require_once "includes/userInterface.php";
require_once "includes/random_compat.phar";
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        $keys = array("firstName", "lastName", "address1st", "address2nd",
                        "town", "county", "country", "postcode", "email",
                        "phone");
        $details = array();
        foreach($keys as $key){
            if (strlen($_POST[$key]) == 0 && $key !="address2nd" && $key != "phone"){
                $context['error'] = "Missing required information: " . $key;
                $template = $twig->loadTemplate("address.phtml");
                $template->display($context);
                exit;
            } else {
                $details[$key] = $_POST[$key];
            }
        }
        session_start();
        if (!$_SESSION['email']){
            if (strlen($_POST["password"]) == 0){
                $details["password"] = bin2hex(random_bytes(50));
            } else {
                $details["password"] = $_POST["password"];
            }
            user_add($details);
        }

        $details['id'] = getUserID($details["email"]);
        if($details['id']){
            $details = basket($details);
            var_dump($details);
            exit;
        }
        $context['error'] = "Sorry we are unable to process your order at this time.";
        $template = $twig->loadTemplate("home.phtml");
        $template->display($context);
     ?>
</body>
</html>
