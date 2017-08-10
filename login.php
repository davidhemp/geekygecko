<?php
require_once 'base.php';
require_once 'includes/userInterface.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        if (isset($_POST['email']) && isset($_POST['password'])){
            if (!login($_POST['email'], $_POST['password'])){
                $context['error'] = "Username and/or password incorrect";
            } else {
                header("Location: /account.php");
                exit;
            }
        }
        $template = $twig->loadTemplate("accountLogin.phtml");
        $template->display($context);
     ?>
</body>
</html>
