<?php
// Controleur permettant d'afficher la page d'accueil des îlots comprenant :
//      -> *** OK *** La mise en évidence de la base choisie dans le menu horizontal LR ou MP
//      -> Le menu latéral en ayant surligné ilot
//      -> *** OK *** Le titre - agrémenté de LR ou MP selon la base choisie
//      -> Le formulaire de recherche globale
//      -> Le formulaire multi-critères
//      -> Les boutons "Tout lister" et "Réinit Formulaire"
//      -> Eventuellement un historique des modifications


// Test pour savoir si on est sur la base LR ou la base MP
if(isset($_GET['ui'])) {
    $getUI = htmlentities($_GET['ui']);
    if($getUI == 'LR'){ $ui = 'LR'; }
    else { $ui = 'MP'; }
}
else {
    $ui = 'MP'; // ui par défaut
}

require($dirModels.'chxBaseLrMp_M.php');

$classCSSLienMP = classCSSLien($ui == 'MP');
$classCSSLienLR = classCSSLien($ui == 'LR');

$libelleBase = libelleBase($ui);
$titre = 'Îlots GPC - '.$libelleBase;












$nbIlot = RefGPC\RefGPC::getDB()->queryCount('SELECT iloCodeIlot FROM `tm_ilots`');



//Appel des models
require($dirModels.'rechercheGenPPros_M.php');

$input = createInput('rechercheGenPPros', 'text', 'rechercheGenPpros', 'Date, joueur, évenement etc...');
//$nbPartiePros = calculNbPProsGlobal();


// Envoi à la vue
require($dirVues.'defaut.php');