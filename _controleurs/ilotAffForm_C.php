<?php
// Controleur permettant d'afficher la page d'accueil des îlots comprenant :
//      -> *** OK *** La mise en évidence de la base choisie dans le menu horizontal LR ou MP
//      -> Le menu latéral en ayant surligné ilot
//      -> *** OK *** Le titre - agrémenté de LR ou MP selon la base choisie
//      -> Le formulaire de recherche globale
//      -> Le formulaire multi-critères
//      -> Les boutons "Tout lister" et "Réinit Formulaire"
//      -> Eventuellement un historique des modifications

//Gestion des css et js necessaire


// Test pour savoir si on est sur la base LR ou la base MP
if(isset($_GET['ui'])) {
    $getUI = htmlentities($_GET['ui']);
    if($getUI == 'LR'){ $ui = 'LR'; }
    else { $ui = 'MP'; }
}
else {
    $ui = 'MP'; // ui par défaut
}

// Permet de définir les urls des liens du menu horizontal Midi-Pyrénées et Languedoc-Roussillon
// Principe de fonctionnement général : Si on est dans ilot, le changement de zone se fait en restant sur ilot,
// si on est sur centre, on change de zone en restant sur centre.
$lienHorizLR = WEBPATH.'LR/ilot';
$lienHorizMP = WEBPATH.'MP/ilot';

// Gestion du choix de la base LR / MP
require($dirModels.'chxBaseLrMp_M.php');
$classCSSLienMP = classCSSLien($ui == 'MP');
$classCSSLienLR = classCSSLien($ui == 'LR');
$libelleBase = libelleBase($ui);
$codeBase = codeBase($ui);
$complementTitre = 'Îlots GPC - '.$libelleBase;

// Gestion du menu latéral
// Principe général : Le menu dans lequel ont est doit être surligné
require($dirModels.'menuLateral_M.php');
classCSSMenuLateralActif('ilot');




//Affichage du formulaire
$form = new \RefGPC\_models\Form();

$selectIlotList = $form->select('ilotList', $codeBase);
$selectTypeIlot = $form->select('typeIlot', $codeBase);
$selectUsed = $form->select('used', $codeBase);
$selectCompetence = $form->select('competence', $codeBase);
$selectServiceCible = $form->select('serviceCible', $codeBase);
$selectEntreprise = $form->select('entreprise', $codeBase);
$selectSiteGeo = $form->select('siteGeo', $codeBase);
$selectDomaineAct = $form->select('domaineAct', $codeBase);












$nbIlot = RefGPC\RefGPC::getDB()->queryCount('SELECT iloCodeIlot FROM `tm_ilots`');




//$input = createInput('rechercheGenPPros', 'text', 'rechercheGenPpros', 'Date, joueur, évenement etc...');
//$nbPartiePros = calculNbPProsGlobal();


// Envoi à la vue
require($dirVues.'defaut.php');