<?php
require_once 'base.php';
require_once 'includes/userInterface.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
    <?php
        session_start();
        if(isset($_SESSION['user'])){
            $context['email'] = $_SESSION['user']->email;
            $template = $twig->loadTemplate("accountInfo.phtml");
        } else {
            if (isset($_POST['username']) && isset($_POST['password'])){
                $user = new User($_POST['username'], $_POST['password']);
                if ($user->error){
                    $context['error'] = $user->error;
                } else {
                    $_SESSION['user'] = $user;
                    header("Location: /account.php");
                    exit;
                }
            }
            $template = $twig->loadTemplate("accountLogin.phtml");
        }
        $template->display($context);
     ?>
</body>
</html>
