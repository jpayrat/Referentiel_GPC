<?php
use \RefGPC\_systemClass\Autoloader;
use \RefGPC\_systemClass\Dispatch;

//phpinfo();

// Autoloader de classes
require("_systemClass/Autoloader.php");
Autoloader::register();

// Definition des chemins
define ('WEBPATH', str_replace('dispatcher.php', '', $_SERVER['SCRIPT_NAME']));
define ('PATH', str_replace('dispatcher.php', '', $_SERVER['SCRIPT_FILENAME']));

// Définition des dossiers du MVC
$dirControleurs = PATH.'_controleurs/';
$dirModels = PATH.'_models/';
$dirVues = PATH.'_vues/';

// Récupération de la page demandée par l'utilisateur
// Format de l'URL : referentielGPC.com/BaseLR-MP/Controleur/methode
$pageAsk = htmlentities($_GET['url']); // Récup sécurisé de l'url
$pageAsk = explode('/', $pageAsk); // séparation des éléments de l'url

    // Calcul de la base choisie LR ou MP
    if(preg_match('#[A-Z]{2}#', $pageAsk[0])) {
        if($pageAsk[0] == 'LR'){ $ui = 'LR'; }
        else { $ui = 'MP'; }
    }
    else {
        $ui = 'MP'; // ui par défaut
    }
    echo '<br /> Ui sélectionnée : '.$ui;

    // Calcul du controleur
    //$controllerName = $pageAsk[1].'Controleur';
    $controllerName = isset($pageAsk[1]) ? $pageAsk[1].'Controleur' : 'iloControleur'; // En attendant d'avoir une page d'accueil ...
    echo '<br /> Controleur sélectionné : '.$controllerName;

    // Calcul de la method du controleur à utiliser
    $methodName = isset($pageAsk[2]) ? $pageAsk[2] : 'affIndex';
    echo '<br /> Méthode sélectionnée : '.$methodName;
    echo '<br />';

    //Lister tout les controleur existant;
    Dispatch::addController('ilotControleur');
    Dispatch::addController('centreControleur');




$controller = Dispatch::createController($controllerName);
if (null == $controller) {
    echo '<br />erreur 404 <br> Controller inexistant ['.$controllerName.']<br> ';
}
else {
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();	// tutoriel -> index()
    }
    else {
        echo 'erreur 404<br>Methode inexistante ['.$actionName.']<br> ';
    }
}
// Opérations sur la session



// Appels des controleurs
/*switch ($pageAsk)
{
    case "ilotAffForm";
        require($dirControleurs."ilotControleur-old.php");
    break;

    case "ilotResForm";
        echo 'plop'; require($dirControleurs."rechercheFormePPros_C.php");
    break;

    default : require($dirControleurs."ilotControleur.php"); // Page index par defaut
}*/