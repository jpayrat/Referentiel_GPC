<?php

namespace RefGPC\_controleurs;

use RefGPC\_models\ChoixBase;
use \RefGPC\_models\Form;
use \RefGPC\_models\ModelVueDefaut;
use RefGPC\_controleurs\baseControleur;
use \RefGPC\_systemClass\RefGPC; // RefGPC::getDB()

/**
 * recupère les données pour l'affichage des ilots et les envoie à la vue.
 * Controleur permettant d'afficher la page d'accueil des îlots comprenant :
 * -> La mise en évidence de la base choisie dans le menu horizontal LR ou MP
 * -> Le menu latéral en ayant surligné ilot
 * -> Le titre - agrémenté de LR ou MP selon la base choisie
 * -> Le formulaire de recherche globale
 * -> Le formulaire multi-critères
 * -> Les boutons "Tout lister" et "Réinit Formulaire"
 * -> Eventuellement un historique des modifications
 */

class ilotControleur extends baseControleur {

    public function affIndex($params) {
        //echo '<br />ilotControleur :: affIndex ' . '<br/>';
       // var_dump($params);
        $d = array(); // collecte des données
        $this->loadModel('ModelVueDefaut' , 'ilot');
        $d = $this->ModelVueDefaut->getData();
        //var_dump($d);
        //var_dump($this->ModelVueDefaut);
        //var_dump($params[0]);
        $param = !is_array($params[0]) ? $params[0] : $params; 
        $this->loadModel('ChoixBase' , $params);
        $d = array_merge($d, $this->ChoixBase->getData());
        //var_dump($d);
        //var_dump($this->ChoixBase);
       $base = $this->ChoixBase;
       // $base = new ChoixBase($params[0]);
        /*
        $classCSSLienMP = $base->classCSSLien('MP');
        $classCSSLienLR = $base->classCSSLien('LR');
        $libelleBase = $base->libelle();
*/
        //Affichage du formulaire
        //var_dump($base->code());
       // echo '<br /> ilotControleur new Form';
        $form = new Form($base->code());

        $d['selectIlotList'] = $form->select('ilotList');
        $d['selectTypeIlot'] = $form->select('typeIlot');
        $d['selectUsed'] = $form->select('used');
        $d['selectCompetence'] = $form->select('competence');
        $d['selectServiceCible'] = $form->select('serviceCible');
        $d['selectEntreprise'] = $form->select('entreprise');
        $d['selectSiteGeo'] = $form->select('siteGeo');
        $d['selectDomaineAct'] = $form->select('domaineAct');
        $d['nbIlot'] = RefGPC::getDB()->queryCount('SELECT iloCodeIlot FROM `tm_ilots`');
        //var_dump($d);
        $d['lienHorizLR'] = WEBPATH.'LR/ilot';
        $d['lienHorizMP'] = WEBPATH.'MP/ilot';
        
        $vue = new \RefGPC\_vues\ilotVue($d);
        $vue->affiche();
        
        //$this->render('defaut.php');
        echo '<br />plop';
        //$this->render('index');
    }

}
