<?php
require_once "Twig/Autoloader.php";
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem("templates");
$twig = new Twig_Environment($loader);
?>
<html>
<head>
    <link rel="stylesheet" href="static/style.css">
</head>
<body>
    <?php
        // include ('static/product.php');
        //
        $testing_arr = array();
        $testing_arr["productID"] = "CARD-KP-03";
        $testing_arr["productName"] = "Pokemon Sun and Moon: Burning Shadows Booster Box (PREORDER)";
        $testing_arr["productDescription"] = "Fiery Battles and Deep Shadows! What strange fires lurk in the shadows? Minions of Team Skull and a cavalcade of new Pokï¿½mon stand ready to battle in the dark of night and in the blazing sun! Slug it out with new titans like Necrozma-GX and Tapu Fini-GX, or battle with trusty allies from Machamp-GX and Charizard-GX to Darkrai-GX and Ho-Oh-GX. Fight for whatï¿½s right with the Pokï¿½mon TCG: Sun & Moonï¿½Burning Shadows expansion! Over 140 cards 12 new Pokï¿½mon-GX 6 new full-art Supporter cards featuring important human characters";
        $testing_arr["productPrice"] = "100";
        $testing_arr["productQuantity"] = "12";
        //
        $return_arr = array($testing_arr);
        $template = $twig->loadTemplate("product-info.phtml");
        $template->display($return_arr[0]);
     ?>
</body>
</html>
