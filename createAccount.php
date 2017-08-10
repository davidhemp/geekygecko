<?php
require_once 'base.php';
require_once 'includes/userInterface.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        if (isset($_POST['username']) && isset($_POST['password'])){
            $keys = array("firstName", "lastName", "address1st", "address2nd",
                            "town", "county", "country", "postcode", "username",
                            "phone", "password");
            $details = array();
            foreach($keys as $key){
                if (strlen($_POST[$key]) == 0 && $key !="address2nd" && $key != "phone"){
                    $context['error'] = "Missing required information";
                    $template = $twig->loadTemplate("accountCreate.phtml");
                    $template->display($context);
                    exit;
                } else {
                    $details[$key] = $_POST[$key];
                }
            }
            user_add($details);
            // header("Location: /account.php");
            exit;
        }
        $template = $twig->loadTemplate("accountCreate.phtml");
        $template->display($context);
     ?>
</body>
</html>
