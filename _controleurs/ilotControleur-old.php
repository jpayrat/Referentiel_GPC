<?php
// Controleur permettant d'afficher la page d'accueil des îlots comprenant :
//      -> *** OK *** La mise en évidence de la base choisie dans le menu horizontal LR ou MP
//      -> Le menu latéral en ayant surligné ilot
//      -> *** OK *** Le titre - agrémenté de LR ou MP selon la base choisie
//      -> Le formulaire de recherche globale
//      -> Le formulaire multi-critères
//      -> Les boutons "Tout lister" et "Réinit Formulaire"
//      -> Eventuellement un historique des modifications

use \RefGPC\_models\Form;
use \RefGPC\_systemClass\RefGPC; // RefGPC::getDB()
use \RefGPC\_models\ChoixBase;

//Gestion des css et js necessaire


// Test pour savoir si on est sur la base LR ou la base MP


// Permet de définir les urls des liens du menu horizontal Midi-Pyrénées et Languedoc-Roussillon
// Principe de fonctionnement général : Si on est dans ilot, le changement de zone se fait en restant sur ilot,
// si on est sur centre, on change de zone en restant sur centre.
$lienHorizLR = WEBPATH.'LR/ilot';
$lienHorizMP = WEBPATH.'MP/ilot';

// Gestion du choix de la base LR / MP
//require($dirModels.'chxBaseLrMp_M.php'); // utilisation d'une classe

$base = new ChoixBase($ui);

$classCSSLienMP = $base->classCSSLien('MP');
$classCSSLienLR = $base->classCSSLien('LR');
$libelleBase = $base->libelle();
 



// Gestion du menu latéral
// Principe général : Le menu dans lequel ont est doit être surligné
//require($dirModels.'menuLateral_M.php');
//classCSSMenuLateralActif('ilot');
$classCSSMenu = new \RefGPC\_models\ModelVueDefaut('ilot');


//Affichage du formulaire
$form = new Form();

$selectIlotList = $form->select('ilotList', $base->code());
$selectTypeIlot = $form->select('typeIlot', $base->code());
$selectUsed = $form->select('used', $base->code());
$selectCompetence = $form->select('competence', $base->code());
$selectServiceCible = $form->select('serviceCible', $base->code());
$selectEntreprise = $form->select('entreprise', $base->code());
$selectSiteGeo = $form->select('siteGeo', $base->code());
$selectDomaineAct = $form->select('domaineAct', $base->code());


$nbIlot = RefGPC::getDB()->queryCount('SELECT iloCodeIlot FROM `tm_ilots`');


//$input = createInput('rechercheGenPPros', 'text', 'rechercheGenPpros', 'Date, joueur, évenement etc...');
//$nbPartiePros = calculNbPProsGlobal();


// Envoi à la vue
require($dirVues.'defaut.php');