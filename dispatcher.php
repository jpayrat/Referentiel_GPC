<?php
// Autoloader de classes
require("_systemClass/Autoloader.php");
RefGPC\_systemClass\Autoloader::register();

// Definition des chemins
define ('WEBPATH', str_replace('dispatcher.php', '', $_SERVER['SCRIPT_NAME']));
define ('PATH', str_replace('dispatcher.php', '', $_SERVER['SCRIPT_FILENAME']));

// Définition des dossiers du MVC
$dirControleurs = PATH.'_controleurs/';
$dirModels = PATH.'_models/';
$dirVues = PATH.'_vues/';

// Récupération de la page demandée par l'utilisateur
$pageAsk = htmlentities($_GET['url']);

// Opérations sur la session



// Appels des controleurs
switch ($pageAsk)
{
    case "ilotAffForm";
        require($dirControleurs."ilotAffForm_C.php");
    break;

    case "ilotResForm";
        echo 'plop'; require($dirControleurs."rechercheFormePPros_C.php");
    break;

    default : require($dirControleurs."ilotAffForm_C.php"); // Page index par defaut
}