<?php
require_once 'base.php';
require_once 'includes/userInterface.php';
?>

<!DOCTYPE html>
<html lang="en">
    <?php
        if (isset($_POST['username']) && isset($_POST['password'])){
            if (!login($_POST['username'], $_POST['password'])){
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
