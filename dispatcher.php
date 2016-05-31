<?php
// modif github
//encore modif github
// 2ed0090c1fc0c69706789232c2d0db91eb725281 // githubtoken
// Autoloader de classes
require("classes/Autoloader.php");
RefGPC\Autoloader::register();

// Defini les chemins -- mode local ou distant -- true : local, false : distant
if (!defined('MODE_LOCAL')) {define('MODE_LOCAL', true); }
$includePath = RefGPC\path::root();
$httpPath = RefGPC\path::http();
/*
define ('WEBPATH', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define ('PATH', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
*/

// Définition des dossiers du MVC
$dirControleurs = $includePath.'controleurs/';
$dirModels = $includePath.'models/';
$dirVues = $includePath.'vues/';

// Récupération de la page demandée par l'utilisateur
//$urlAsk = htmlentities($_SERVER['REQUEST_URI']); var_dump($_SERVER);
$pageAsk = htmlentities($_GET['p']);

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